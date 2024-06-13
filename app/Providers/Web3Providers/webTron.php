<?php

namespace App\Providers\Web3Providers;

use App\Providers\Web3Providers\Exceptions\WalletException;
use App\Providers\Web3Providers\web3Abstract;
use App\Providers\Web3Providers\web3Interface;
use stdClass;

class webTron  extends web3Abstract implements web3Interface
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
        $response = $this->httpRequest(
            array(
                "url" => "https://api.tatum.io/v3/tron/wallet",
                "method" => "GET",
                "headers" => array(
                    "Content-Type: application/json",
                    "x-api-key: {$this->testnetApiKey}"
                )
            )
        );

        return $this->validateResponse($response);
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


        $response = $this->httpRequest(
            array(
                "url" => "https://api.tatum.io/v3/tron/address/{$xpub}/{$index}",
                "method" => "GET",
                "url" => array(
                    "Content-Type: application/json",
                    "x-api-key: {$this->testnetApiKey}"
                )
            )
        );

        return $this->validateResponse($response)->address;
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
        $response = $this->httpRequest(
            array(
                "url" => "https://api.tatum.io/v3/tron/wallet/priv",
                "method" => "POST",
                "payload" => array(
                    "index" => $index,
                    "mnemonic" => $mnemonic
                ),
                "url" => array(
                    "Content-Type: application/json",
                    "x-api-key: {$this->testnetApiKey}"
                )
            )
        );

        return $this->validateResponse($response)->key;
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


        $response = $this->httpRequest(
            array(
                "url" => "https://api.tatum.io/v3/tron/transaction/account/{$address}/trc20",
                "method" => "GET",
                "headers" => array(
                    "Content-Type: application/json",
                    "x-api-key: {$this->testnetApiKey}"
                )
            )
        );

        return $this->validateResponse($response);
    }

    public function GetAccount(string $address): object
    {


        $response = $this->httpRequest(
            array(
                "url" => "https://api.tatum.io/v3/tron/account/{$address}",
                "method" => "GET",
                "headers" => array(
                    "Content-Type: application/json",
                    "x-api-key: {$this->testnetApiKey}"
                )
            )
        );

        return $this->validateResponse($response);
    }

    public function Exchange(string $currency): object
    {
        
        $response = $this->httpRequest(
            array(
                "url" => "https://api.tatum.io/v3/tatum/rate/{$currency}",
                "method" => "GET",
                "headers" => array(
                    "Content-Type: application/json",
                    "x-api-key: {$this->mainnetApiKey}"
                )
            )
        );

        return $this->validateResponse($response);
    }



    public function send(string $fromAddres, string $toAddress, int|string $amount): bool
    {
        return true;
    }


    public function getBalance(string $address): object
    {
        return new stdClass;
    }
}
