<?php

namespace utils;

require_once(__DIR__.'/../../index.php');

class Openssl
{
    /**
     * 配置信息.
     * publicKey => string.
     * privateKey => string.
     *
     * @var mixed
     */
    protected $config;
    /**
     * 初始化.
     *
     * @param array $config
     */
    public function __construct($config)
    {
        $this->config = $config;
    }
    /**
     * 获取密钥分段加密长度.
     *
     * @param Closure $keyClosure
     *
     * @return int
     *
     * @throws Exception
     */
    protected function getEncryptBlockLen($keyClosure)
    {
        $key_info = openssl_pkey_get_details($keyClosure);
        if (!$key_info)
        {
            throw new Exception('获取密钥信息失败' . openssl_error_string());
        }
        // bits数除以8 减去padding长度，OPENSSL_PKCS1_PADDING 长度是11
        // php openssl 默认填充方式是 OPENSSL_PKCS1_PADDING
        return $key_info['bits'] / 8 - 11;
    }
    /**
     * 获取密钥分段解密长度.
     *
     * @param Closure $keyClosure
     *
     * @return int
     *
     * @throws Exception
     */
    protected function getDecryptBlockLen($keyClosure)
    {
        $key_info = openssl_pkey_get_details($keyClosure);
        if (!$key_info)
        {
            throw new Exception('获取密钥信息失败' . openssl_error_string());
        }
        // bits数除以8得到字符长度
        return $key_info['bits'] / 8;
    }
    /**
     * 数据加密.
     *
     * @param string $text 需要加密的文本
     * @param int $type 加密方式:1.公钥加密 2.私钥加密
     *
     * @return string
     *
     * @throws Exception
     */
    public function encrypt($text, $type)
    {
        //获取密钥资源
        $keyClosure = 1 == $type ? openssl_pkey_get_public($this->config['publicKey']) : openssl_pkey_get_private($this->config['privateKey']);
        if (!$keyClosure)
        {
            throw new Exception('获取密钥失败,请检查密钥是否合法');
        }
        //RSA进行加密
        $encrypt = '';
        $plainData = str_split($text, $this->getEncryptBlockLen($keyClosure));
        foreach ($plainData as $key => $encrypt_item)
        {
            $isEncrypted = (1 == $type) ? openssl_public_encrypt($encrypt_item, $encrypted, $keyClosure) : openssl_private_encrypt($encrypt_item, $encrypted, $keyClosure);
            if (!$isEncrypted)
            {
                throw new Exception('加密数据失败,请检查密钥是否合法,' . openssl_error_string());
            }
            $encrypt .= $encrypted;
        }
        $encrypt = self::base64UrlEncode($encrypt);
        //返回
        return $encrypt;
    }
    /**
     * 数据解密.
     *
     * @param string $text 需要加密的文本
     * @param int $type 加密方式:1.公钥加密 2.私钥加密
     *
     * @return string
     *
     * @throws Exception
     * @throws
     */
    public function decrypt($text, $type)
    {
        //获取密钥资源
        $keyClosure = 1 == $type ? openssl_pkey_get_public($this->config['publicKey']) : openssl_pkey_get_private($this->config['privateKey']);
        if (!$keyClosure)
        {
            throw new Exception('获取密钥失败,请检查密钥是否合法');
        }
        //RSA进行解密
        $data = self::base64UrlDecode($text);
        $data = str_split($data, $this->getDecryptBlockLen($keyClosure));
        $decrypt = '';
        foreach ($data as $key => $chunk)
        {
            $isDecrypted = (1 == $type) ? openssl_public_decrypt($chunk, $encrypted, $keyClosure) : openssl_private_decrypt($chunk, $encrypted, $keyClosure);
            if (!$isDecrypted)
            {
                throw new Exception('解密数据失败,请检查密钥是否合法,' . openssl_error_string());
            }
            $decrypt .= $encrypted;
        }
        //返回
        return $decrypt;
    }

    static function base64UrlEncode($data): string {
        return str_replace(['+', '/', '='], ['-', '_', ''], base64_encode($data));
    }

    static function base64UrlDecode($data): string {
        return base64_decode(str_replace(['-', '_'], ['+', '/'], $data));
    }
}