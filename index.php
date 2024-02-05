<?php

require_once 'vendor/autoload.php';

use App\Http\Postcode;


$postcode = new Postcode();

$postcode->setPostCode('39401828');

var_dump($postcode->search());