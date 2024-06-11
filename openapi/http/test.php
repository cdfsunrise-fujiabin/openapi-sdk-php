<?php

namespace OpenApi;

require __DIR__.'/../../index.php';
include __DIR__.'/../utils/RsaHelper.php';

use GuzzleHttp\Client;
use GuzzleHttp\Exception\GuzzleException;
use GuzzleHttp\Psr7\Request;
use utils\RsaHelper;

class test
{
    /**
     * @throws GuzzleException
     */
    public function call($host)
    {
        $client = new Client();
        $response = $client->request('GET', $host);
        return $response->getBody();

//        echo $response->getStatusCode(); // 200
//        echo $response->getHeaderLine('content-type'); // 'application/json; charset=utf8'
//        echo $response->getBody(); // '{"id": 1420053, "name": "guzzle", ...}'

        // Send an asynchronous request.
//        $request = new Request('GET', 'http://httpbin.org');
//        $promise = $client->sendAsync($request)->then(function ($response) {
//            return $response->getBody();
//        });
//        $promise->wait();
    }
}

$t = new test();
try {
    echo $t->call('https://api.github.com/repos/guzzle/guzzle');

    $rsa = new RsaHelper();
    $encryptedData = $rsa->rsaEncrypt("需要加密的信息", "-----BEGIN RSA PUBLIC KEY-----
MIIBIjANBgkqhkiG9w0BAQEFAAOCAQ8AMIIBCgKCAQEA0XAbluGzEsRhZ82X20bI
vUPxtTLiBJQiDfJtpLF4YjmxB04cU9LHAIGsxnK/VDcnlIlOutneJarxWwVq5sEe
Vp9bMG+KtNPPdXFj+tMb4hloKwFAVXiyxLoDrgRW5DDes8MUI+6kiIGX4hi5KSRP
mKFVtMOLD142+kuRaCEYvz4gz85cRiOa09jJ8JEvU+8DieysJJrEvVVaexGjJD3o
hFslRLfoG06NbvaSwdqL1+z98pdp4JMjx47BccUTEXB1jVVOmU3zyNVP33v4iVyW
q5O47ccKVMuvxN5dlGsXEOoSuesWxQblF2TjNt1Vd8D73l7por4Gm7Gf4Mw05Tyl
JwIDAQAB
-----END RSA PUBLIC KEY-----");

    echo $rsa->rsaDecrypt($encryptedData, $privateKeyString = "-----BEGIN RSA PRIVATE KEY-----
MIIEpAIBAAKCAQEA0XAbluGzEsRhZ82X20bIvUPxtTLiBJQiDfJtpLF4YjmxB04c
U9LHAIGsxnK/VDcnlIlOutneJarxWwVq5sEeVp9bMG+KtNPPdXFj+tMb4hloKwFA
VXiyxLoDrgRW5DDes8MUI+6kiIGX4hi5KSRPmKFVtMOLD142+kuRaCEYvz4gz85c
RiOa09jJ8JEvU+8DieysJJrEvVVaexGjJD3ohFslRLfoG06NbvaSwdqL1+z98pdp
4JMjx47BccUTEXB1jVVOmU3zyNVP33v4iVyWq5O47ccKVMuvxN5dlGsXEOoSuesW
xQblF2TjNt1Vd8D73l7por4Gm7Gf4Mw05TylJwIDAQABAoIBAQC/4XE1dATHXepL
2v2U5S4G0NgDBeIzBbCJjKFNcVb0zxxUsAid949g9G1hx0Fpm7qEiKP75p1zb0D+
/mCplyb/f7JhFuBCuYfpdoB+DaoPJO3d8KCLbjCCslWquckN+YQft8uc/Af8FJcd
iz8g5WaTVMSb/0dJRi0iddd7Sk9M7atcsakPOHAHdAdIH9LuFBSpaz4S3iyOXT09
wxUDnGrrZlw7yvJ/ffEiDz6eCoE1dPIExF0eXfb7SBPSeg+FdCE3kQUkCqOs+1GN
ba4x4Up+Jnb6QpMdbqhpB2KOH+7XlewlTa9NIhgqK+nwWc3Z0N1BvkJZihLt70rJ
jJVw1pCBAoGBAOGFE7JGyjCSctCvrgSZOs8DlOe6820b3N38GHa+xw7BGcUt6kFG
8XLUQle9aucyjROp3gQyXVwjy4BMcVsKwQmtWhCczOTzXaN1ZeJproLIsxC8/+Yn
l/HIJBhji5cMgGbgv26bWO2ZPsF/PgVQ8z4aKB8PuOdETV9Y9n2rZOdnAoGBAO2+
mel7rr3cb48zIwOmQ536ktQ1e6sXyE+yvrdMLeBtcdqq0FYluWvVqfTketWFGk0Z
SAhTXFak+Svx3InDhI5zKQaqbSGLUJUaICISf8Td6jcou/+36UDVoqxHUaIAEbSi
eTAlrtBffS5vO0eGDdCD5kbhd/k8ySW4wQDOOHxBAoGAOn7RIBHaigTCgTzAT3ML
XPzZ182XLHrorC+ijNJpQXt22r1RIMNtB1LlLmr0WqmzDCGoc8A4lRi3xTyOvoWo
koEDdoGlZ9F0PVzLI5Iz8LpsL/BGFAW7FLzMGANiBrj4aTbskJz80QxJydjeVnSr
0zTnqT7jwCDoTM3/iZM2ZgsCgYBSgN16qCBI5PGV+UICZzV54lYH7JOBGVy7Q6Vp
iLc29eQX5UUtUCQbpuc3A/8Yj/tDnC1iLkOSEegidul4qXAb2xz2ojgC9wy84Xcb
O945HGXGRI2RPWplxH2SWaGbnXiHfgaeTcVvrGONtK4WsQ+kN9G28VGoHY8UVxwr
QmVZwQKBgQCuSfMGabm7xObf49mj5HV4gEv0NJ4tVaMPnAOZWfJ64NREp0HCOhfk
2gsSsPjpfFqYsMBTZKZnPSTCFMZZkmhzBabZuZmoxK+qHiw6/r1duRVfMTIfu6+R
RzD0oLsZ+hrLQoIqkrOQ+eTvKWsV6xaHODn+1dGdN3c1LFXkPpSM7w==
-----END RSA PRIVATE KEY-----
");
} catch (GuzzleException $e) {
}