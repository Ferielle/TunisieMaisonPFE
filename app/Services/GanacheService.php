<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;

class GanacheService
{
    protected $rpcUrl;

    public function __construct()
    {
        $this->rpcUrl = config('ganache.rpc_url', 'http://127.0.0.1:7545');
    }

    // Send Ether directly to the contract
    public function sendEtherToContract($from, $contractAddress, $value)
    {
        $response = Http::post($this->rpcUrl, [
            'jsonrpc' => '2.0',
            'method'  => 'eth_sendTransaction',
            'params'  => [
                [
                    'from'  => $from,              // Sender's wallet address
                    'to'    => $contractAddress,   // Contract address
                    'value' => $value              // Value in hexadecimal
                ]
            ],
            'id' => 1
        ]);

        return $response->json();

   }
   public function getBalance($contractAddress)
{
    $response = Http::post($this->rpcUrl, [
        'jsonrpc' => '2.0',
        'method'  => 'eth_getBalance',
        'params'  => [$contractAddress, 'latest'],
        'id'      => 1
    ]);

    return $response->json('result');
}

}
