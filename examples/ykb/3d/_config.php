<?php

require '../../_main_config.php';

$path = '/ykb/3d/';
$baseUrl = $hostUrl . $path;

$success_url = $baseUrl . 'response.php';
$fail_url = $baseUrl . 'response.php';

$request = \Symfony\Component\HttpFoundation\Request::createFromGlobals();
$ip = $request->getClientIp();

$account = [
    'bank'              => 'yapikredi',
    'model'             => '3d',
    'client_id'         => 'XXXXXX',
    'terminal_id'       => 'XXXXXX',
    'posnet_id'         => 'XXXXXX',
    'username'          => 'XXXXXX',
    'password'          => 'XXXXXX',
    'store_key'         => '10,10,10,10,10,10,10,10',
    'promotion_code'    => '',
    'env'               => 'test',
];

try {
    $pos = new \Mews\Pos\Pos($account);
} catch (\Mews\Pos\Exceptions\BankNotFoundException $e) {
    dump($e->getCode(), $e->getMessage());
} catch (\Mews\Pos\Exceptions\BankClassNullException $e) {
    dump($e->getCode(), $e->getMessage());
}

$templateTitle = '3D Model Payment';
