<?php
/*
 * Copyright (c) 2021. This Project was built and maintained by Diginnovators Private Limited.
 */

namespace App;


use App\Enums\CommonEnums;
use App\Models\Settings;
use GuzzleHttp\Client;

class Razorpay
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

    public function order(){
        return $this->url = "https://api.razorpay.com/v1/orders/";
    }

    public function create($receipt, $amount, $meta){

//        $request_url = ;
        $response = $this->client->request('POST', $this->url, ['auth' => [$this->key, $this->secret], 'json'=>[
            'receipt' => $receipt,
            'amount' => $amount*100,
            'currency' => 'INR',
            'notes'=>$meta,
            'payment_capture'=>CommonEnums::$YES
        ]]);
        return json_decode($response,true);
    }

    public function payment(){
        return $this->url = "https://api.razorpay.com/v1/payments/";
    }

    public function fetch($id){
        $response = $this->client->request('GET', $this->url.$payment_id, ['auth' => [$this->key, $this->secret]]);
        return json_decode($response,true);
    }
}
