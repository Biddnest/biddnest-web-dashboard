<?php
/*
 * Copyright (c) 2021. This Project was built and maintained by Diginnovators Private Limited.
 */

namespace App;


use App\Enums\CommonEnums;
use App\Models\Settings;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\ClientException;

class RazorpayX
{
    private $key;
    private $secret;
    private $client;
    private $url;
    public function __construct($key, $secret){
        $this->key = $key;
        $this->secret = $secret;
        $this->client = new client();

    }

    public function contact(){
        return $this->url = "https://api.razorpay.com/v1/contacts";
    }

    public function fund_account(){
        return $this->url = "https://api.razorpay.com/v1/fund_accounts";
    }

    public function payout(){
        return $this->url = "https://api.razorpay.com/v1/payouts";
    }

    public function create($data){
        try{

        $response = $this->client->request('POST', $this->url, ['auth' => [$this->key, $this->secret], 'json'=>$data
        ]);
        }
        catch(ClientException $e){
            return $e->getMessage();
        }
        return json_decode($response,true);
    }

    public function fetch($payment_id){
        $response =$this->client->request('GET', self::payment().$payment_id, ['auth' => [$this->key, $this->secret]]);
        return json_decode($response->getBody(), true);
    }
}
