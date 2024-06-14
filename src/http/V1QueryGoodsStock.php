<?php

namespace OpenApi;

require_once(__DIR__.'/../../index.php');
require_once(__DIR__.'/../utils/RsaHelper.php');

use GuzzleHttp\Client;
use GuzzleHttp\Exception\GuzzleException;
use utils\RsaHelper;

class V1QueryGoodsStock
{
    /**
        V1QueryGoodsStock
         *Description: 开放平台查询商品库存
         * @param: body OpenDataReq OpenDataReq 必填项
         * @throws GuzzleException
     */
    public function call($host, $authToken, $body)
    {
        $client = new Client(['headers' => ['Authorization' => $authToken]]);
        
        $response = $client->request('Post', $host . sprintf("/v1/query/goodsStock"), [
            'json' => $body
        ]);
        
        return json_decode($response->getBody()->getContents());
    }
}