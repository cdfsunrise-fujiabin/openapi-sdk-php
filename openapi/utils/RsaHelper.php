<?php

namespace utils;

require __DIR__.'/../../index.php';

class RsaHelper
{
    public function rsaEncrypt($data, $pubKey) {
        $ret = openssl_public_encrypt($data, $encrypted, $pubKey);
        if ($ret) {
            return  base64_encode($encrypted);
        } else {
            return "";
        }
    }

    public function rsaDecrypt($encryptedData, $privateKeyString)
    {
        $encrypted = base64_decode($encryptedData);
        openssl_private_decrypt($encrypted, $decrypted, $privateKeyString);
        return $decrypted;
    }
}