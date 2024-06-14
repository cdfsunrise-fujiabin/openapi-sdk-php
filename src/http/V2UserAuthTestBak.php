<?php

namespace OpenApi;

require_once(__DIR__.'/../../index.php');
require_once(__DIR__.'/../http/V2UserAuth.php');
require_once(__DIR__.'/../utils/SignHelper.php');

use utils\RsaHelper;
use PHPUnit\Framework\TestCase;

class V2UserAuthTestBak extends TestCase {
    public function testCall() {
        $t = new V2UserAuth();
        $rawParams = [
			"appid" => "202310078407",
			"password" => RsaHelper::rsaEncrypt("123456", "-----BEGIN RSA PUBLIC KEY-----\nMIIBIjANBgkqhkiG9w0BAQEFAAOCAQ8AMIIBCgKCAQEA0XAbluGzEsRhZ82X20bI\nvUPxtTLiBJQiDfJtpLF4YjmxB04cU9LHAIGsxnK/VDcnlIlOutneJarxWwVq5sEe\nVp9bMG+KtNPPdXFj+tMb4hloKwFAVXiyxLoDrgRW5DDes8MUI+6kiIGX4hi5KSRP\nmKFVtMOLD142+kuRaCEYvz4gz85cRiOa09jJ8JEvU+8DieysJJrEvVVaexGjJD3o\nhFslRLfoG06NbvaSwdqL1+z98pdp4JMjx47BccUTEXB1jVVOmU3zyNVP33v4iVyW\nq5O47ccKVMuvxN5dlGsXEOoSuesWxQblF2TjNt1Vd8D73l7por4Gm7Gf4Mw05Tyl\nJwIDAQAB\n-----END RSA PUBLIC KEY-----"),
        ];
        $ret = $t->call("http://lefox-marketing-openapi-gateway-dev.cdfsunrise.com", $rawParams);
        print_r($ret);
        $this->assertNotEquals("", $ret->requestId);
    }
}