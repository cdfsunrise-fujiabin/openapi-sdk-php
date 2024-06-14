<?php

namespace utils;

require_once(__DIR__.'/../../index.php');

class RsaHelper
{
//    public static function rsaEncrypt($data, $pubKey): string {
//        $ret = openssl_public_encrypt($data, $encrypted, $pubKey);
//        if ($ret) {
//            return  self::base64UrlEncode($encrypted);
//        } else {
//            return "";
//        }
//    }

    public static function rsaEncrypt($data, $publicKey, $chunkSize = 245): string {
        $encryptedChunks = [];

        for ($i = 0; $i < strlen($data); $i += $chunkSize) {
            $chunk = substr($data, $i, $chunkSize);
            openssl_public_encrypt($chunk, $encryptedChunk, $publicKey);
            $encryptedChunks[] = $encryptedChunk;
        }

        $ret = implode('', $encryptedChunks);
        return self::base64UrlEncode($ret);
    }

//    public static function rsaDecrypt($encryptedData, $privateKeyStr): string
//    {
//        $privateKeyResource = openssl_pkey_get_private($privateKeyStr);
//        $ret = openssl_private_decrypt($encryptedData, $decrypted, $privateKeyResource);
//        if ($ret) {
//            return $decrypted;
//        } else {
//            echo "解密失败: " . openssl_error_string();
//            return "";
//        }
//    }

    public static function rsaDecrypt($encryptedData, $privateKeyStr): string
    {
        $privateKeyResource = openssl_pkey_get_private($privateKeyStr);
        $ret = openssl_private_decrypt($encryptedData, $decrypted, $privateKeyResource);
        if ($ret) {
            return $decrypted;
        } else {
            echo "解密失败: " . openssl_error_string();
            return "";
        }
    }

    static function base64UrlEncode($data): string {
        return str_replace(['+', '/', '='], ['-', '_', ''], base64_encode($data));
    }

    static function base64UrlDecode($data): string {
        return base64_decode(str_replace(['-', '_'], ['+', '/'], $data));
    }
}

