<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

$MERCHANT_KEY = "FrU8XuAG";

// Merchant Salt as provided by Payu
$SALT = "4lPfUCnjwj";

// End point - change to https://secure.payu.in for LIVE mode
$PAYU_BASE_URL = "https://secure.payu.in";

$action = '';

$surl = "http://localhost/KOC/payments/success.php";
$furl = "http://localhost/KOC/payments/failure.php";
$home = "http://localhost/KOC/";

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "koc2016regitration";
