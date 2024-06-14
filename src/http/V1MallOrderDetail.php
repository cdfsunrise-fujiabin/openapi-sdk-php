<?php

namespace OpenApi;

require_once(__DIR__.'/../../index.php');
require_once(__DIR__.'/../utils/RsaHelper.php');

use GuzzleHttp\Client;
use GuzzleHttp\Exception\GuzzleException;
use utils\RsaHelper;

class V1MallOrderDetail
{
    /**
        V1MallOrderDetail
         *Description: 【商户入驻】- 查询订单详情
         * @param: body BaseRequest BaseRequest 必填项
         * @throws GuzzleException
     */
    public function call($host, $authToken, $body)
    {
        $client = new Client(['headers' => ['Authorization' => $authToken]]);
        
        $response = $client->request('Post', $host . sprintf("/v1/mall/order/detail"), [
            'json' => $body
        ]);
        
        return json_decode($response->getBody()->getContents());
    }
}