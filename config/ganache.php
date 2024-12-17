<?php

// return [
//     'rpc_url' => env('GANACHE_RPC_URL', 'http://127.0.0.1:7545'),
// ];
namespace App\Services;

use Illuminate\Support\Facades\Http;

class GanacheService
{
    protected $ganacheUrl;

    public function __construct()
    {
        // Default Ganache RPC URL
        $this->ganacheUrl = 'http://127.0.0.1:7545';
    }

    public function sendEtherToContract($from, $contractAddress, $value)
    {
        // RPC payload for sending a transaction
        $payload = [
            'jsonrpc' => '2.0',
            'method' => 'eth_sendTransaction',
            'params' => [
                [
                    'from' => $from,
                    'to' => $contractAddress,
                    'value' => $value,
                    'gas' => '0x5208', // Optional: Gas limit
                ]
            ],
            'id' => 1
        ];

        // Send request to Ganache
        $response = Http::post($this->ganacheUrl, $payload);

        if ($response->failed()) {
            throw new \Exception('Ganache RPC Error: ' . $response->body());
        }

        $responseData = $response->json();

        if (isset($responseData['error'])) {
            throw new \Exception('Ganache Error: ' . $responseData['error']['message']);
        }

        // Return transaction hash
        return $responseData['result'];
    }
}
