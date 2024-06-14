<?php

namespace OpenApi;

require_once(__DIR__.'/../../index.php');
require_once(__DIR__.'/../utils/RsaHelper.php');

use GuzzleHttp\Client;
use GuzzleHttp\Exception\GuzzleException;
use utils\RsaHelper;

class V1QueryGoodsCategory
{
    /**
        V1QueryGoodsCategory
         *Description: 开放平台商品分类查询
         * @param: body OpenDataReq OpenDataReq 必填项
         * @throws GuzzleException
     */
    public function call($host, $authToken, $body)
    {
        $client = new Client(['headers' => ['Authorization' => $authToken]]);
        
        $response = $client->request('Post', $host . sprintf("/v1/query/goodsCategory"), [
            'json' => $body
        ]);
        
        return json_decode($response->getBody()->getContents());
    }
}