<?php

use App\Providers\Web3Providers\Tatum;
use App\Providers\Web3ServiceProvider;
use Core\Facades\Route;

Route::get('/' , function() {

   /*  $provider = new Web3ServiceProvider(new Tatum);
    $provider->CreateWallet(); */

    return json_encode(array(
        "error" => 0,
        "message" => 'api working'
    ));
});

Route::get('/login' , function() {

   /*  $provider = new Web3ServiceProvider(new Tatum);
    $provider->CreateWallet(); */

    return json_encode(array(
        "error" => 0,
        "data" => [
            [
                "name" => "jad"
            ],
            [
                "name" => "jad"
            ],
            [
                "name" => "jad"
            ],
            [
                "name" => "jad"
            ]
        ]
    ));
});

 


?>