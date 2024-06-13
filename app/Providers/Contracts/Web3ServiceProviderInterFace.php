<?php

namespace App\Providers\Contracts;

interface Web3ServiceProviderInterFace {
    
    public function CreateWallet(): object;

    public function GenerateAddress(string $xpub, int $index): string;

    public function GeneratePrivateKey(int $index, string $mnemonic): string;

    public function GetTransactions(string $address): object;


    public function getBalance(string $address): object;


    public function send(string $fromAddres, string $toAddress, int|string $amount): bool;

}