<?php

namespace OpenApi;

require_once(__DIR__.'/../../index.php');
require_once(__DIR__.'/../utils/RsaHelper.php');

use GuzzleHttp\Client;
use GuzzleHttp\Exception\GuzzleException;
use utils\RsaHelper;

class V2UserAuth
{
    /**
        V2UserAuth
         *Description: 
         * @param: body OpenAuthReq OpenAuthReq 必填项
         * @throws GuzzleException
     */
    public function call($host, $body)
    {
        $client = new Client();
        
        $response = $client->request('Post', $host . sprintf("/v2/user/auth"), [
            'json' => $body
        ]);
        
        return json_decode($response->getBody()->getContents());
    }
}