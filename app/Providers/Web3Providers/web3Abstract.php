<?php


namespace App\Providers\Web3Providers;

use App\Providers\Web3Providers\Exceptions\WalletException;

abstract class web3Abstract
{

    public abstract function CreateWallet(): object;

    public abstract function GenerateAddress(string $xpub, int $index): string;

    public abstract function GeneratePrivateKey(int $index, string $mnemonic): string;

    public abstract function GetTransactions( string $address ): object;

    public abstract function GetAccount( string $address ): object;

    public abstract function Exchange(string $currency): object;


    public abstract function send(string $fromAddres, string $toAddress, int|string $amount): bool;

    public function validateResponse($response): object
    {


        $response =  json_decode($response);

        if (!is_object($response)) {
            return (object) [
                'error' => 1,
                'message' => __("Error in Response type should be JSON format")
            ];
        }

        return (object) $response;
    }

    public function httpRequest(array $options = [])
    {

        $curl = curl_init();
         

        curl_setopt($curl, CURLOPT_URL, $options['url']);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curl, CURLOPT_CUSTOMREQUEST, $options['method']);
        
        if (isset($options['headers'])) {
            curl_setopt($curl, CURLOPT_HTTPHEADER, $options['headers'] );
        }

        if (isset($options['payload'])) {
            $payload = $options['payload'];
            curl_setopt($curl,CURLOPT_POSTFIELDS,  is_array($payload) ? json_encode($payload) : $payload );
        }

        
         

        $response = curl_exec($curl);
        $error = curl_error($curl);
        curl_close($curl);

        if ($error) {

           $response = json_encode([
            'error' => 1,
            'message' => $error
           ]);
        }

         
        return $response;
    }
}
