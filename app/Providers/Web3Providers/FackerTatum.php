<?php

namespace App\Providers\Web3Providers;

use App\Providers\Web3Providers\Exceptions\WalletException;
use App\Providers\Web3Providers\web3Abstract;
use App\Providers\Web3Providers\web3Interface;
use stdClass;

class FackerTatum  extends web3Abstract implements web3Interface
{

    private string $privateKey;
    private string $address;
    private string $hexAddress;
    private string $tokenID;

    private string $mainnetApiKey = 't-65968d126ba239001c188aee-535261d8abb645cca5f14b42';
    private string $testnetApiKey = 't-65968d126ba239001c188aee-dbb72e1caffc4e17b675f92b';

    /**
     * Create New Tron Wallet,
     *
     * @return object
     */
    public function CreateWallet(): object
    {
        $response = (object) array(
            "mnemonic" => str_shuffle("diagram thumb cave spare west drop sting bounce ramp surge whip thing tomorrow tone lend mystery sting display door combine divorce peace negative laundry"),
            "xpub" => str_shuffle("xpub6FCrwDZgDPpMe2eQ2zBjjvVAHFswTRKP9pkKMVjEgnPuTdezSBMgpzSuDjRHWxaPomoYXfeD2u1jzqZW4pfRpWWxQZPAthJpUGBwHnC7UGj"),
        );


        return ($response);
    }

    /**
     * Generate Tron Address from Wallet Public Key.
     *
     * @param string $xpub wallet public key
     * @param int $index address index number start from 1-32 Max
     *
     * @return string return Address
     */
    public function GenerateAddress(string $xpub, int $index): string
    {


        $response = (object) array(
            "address" => 'T' . str_shuffle("StLnTXiYxZJrr6u1UJusF6kedaRqc5UK8"),
        );


        return ($response)->address;
    }

    /**
     * Generate Private key for Tron Address.
     *
     * @param int $index address index number start from 1-32 Max
     * @param string $mnemonic wallet mnemonic for privatekey generator
     *
     * @return string return privateKey
     */
    public function GeneratePrivateKey(int $index, string $mnemonic): string
    {
        $response = (object) array(
            "key" => str_shuffle("8fb26dc9b4a98044c6d1fd649a6b9f3e7d8e16b8d1bce8c6c71d5f75d88e7b3b"),
        );


        return ($response)->key;
    }


    /**
     * Get Transactions Records for Tron Address .
     *
     * @param string $address get Transactions for Address
     *
     * @return object return Transactions
     */
    public function GetTransactions(string $address): object
    {

        $Transactions = json_decode(file_get_contents(app()->basePath . '/app/Providers/web3Providers/FackerTatumTransication.json'));

        if(!is_object($Transactions)) return (object) [];
        if(!property_exists($Transactions , $address)) return (object) [];

        $response = (object) $Transactions->{$address};

        return ($response);
    }


    public function GetAccount(string $address): object
    {


        $response = $this->httpRequest(
            array(
                "url" => "https://api.tatum.io/v3/tron/account/{$address}",
                "method" => "GET",
                "headers" => array(
                    "Content-Type: application/json",
                    "x-api-key: {$this->mainnetApiKey}"
                )
            )
        );

        return (object) ($response);
    }



    public function send(string $privateKey, string $toAddress, int|string $amount): bool
    {

        $response = (object) array(
            "error" => 0,
            "status" => 'in-progress'
        );


        return (!$response->error);
    }

    public function Exchange(string $currency): object
    {

        $response = $this->httpRequest(
            array(
                "url" => "https://api.tatum.io/v3/tatum/rate/{$currency}?basePair=USD",
                "method" => "GET",
                "headers" => array(
                    "Content-Type: application/json",
                    "x-api-key: {$this->mainnetApiKey}"
                )
            )
        );

        return (object) ($response);
    }


    public function getBalance(string $address): object
    {
        return new stdClass;
    }
}
