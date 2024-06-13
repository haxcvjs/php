<?php

namespace App\Providers;

use App\Providers\Contracts\Web3ServiceProviderInterFace;
use App\Providers\Web3Providers\web3Abstract;
use App\Providers\Web3Providers\web3Interface;
use stdClass;

class Web3ServiceProvider implements Web3ServiceProviderInterFace
{

    public function __construct(public web3Abstract $Web3Provider)
    {
        
    }


    /**
     * Create New Tron Wallet,
     *
     * @return object
     */
    public function CreateWallet(): object
    {
        return $this->Web3Provider->CreateWallet();
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
        return $this->Web3Provider->GenerateAddress($xpub , $index);
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
        return $this->Web3Provider->GeneratePrivateKey($index , $mnemonic);
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
        return $this->Web3Provider->GetTransactions($address);
    }
    
    /**
     * Get Transactions Records for Tron Address .
     *
     * @param string $address get Transactions for Address
     *
     * @return object return Transactions
     */
    public function GetAccount(string $address): object
    {
        return $this->Web3Provider->GetAccount($address);
    }



    public function send(string $fromAddres, string $toAddress, int|string $amount): bool
    {
        return $this->Web3Provider->send( $fromAddres,  $toAddress, $amount);
    }


    public function getBalance(string $address): object
    {
        return new stdClass;
    }
    
    public function Exchange(string $currency): object
    {
        return $this->Web3Provider->Exchange($currency);
    }
}
