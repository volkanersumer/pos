<?php

require '_config.php';

require '../../template/_header.php';

if ($request->getMethod() !== 'POST') {
    echo new \Symfony\Component\HttpFoundation\RedirectResponse($baseUrl);
    exit();
}

$orderId = date('Ymd') . strtoupper(substr(uniqid(sha1(time())),0,4));
$amount = (double) 1;

$order = [
    'id'            => $orderId,
    'name'          => 'John Doe', // optional
    'email'         => 'mail@customer.com', // optional
    'user_id'       => '12', // optional
    'amount'        => $amount,
    'installment'   => '1',
    'currency'      => 'TRY',
    'ip'            => $ip,
    'transaction'   => 'pay', // pay => S, pre => preauth
];

$pos->prepare($order);

$card = new \Mews\Pos\Entity\Card\CreditCardGarantiPos(
    $request->get('number'),
    $request->get('year'),
    $request->get('month'),
    $request->get('cvv')
);

$payment = $pos->payment($card);

$response = $payment->getResponse();
?>

<div class="result">
    <h3 class="text-center text-<?php echo $payment->isSuccess() ? 'success' : 'danger'; ?>">
        <?php echo $payment->isSuccess() ? 'Payment is successful!' : 'Payment is not successful!'; ?>
    </h3>
    <hr>
    <dl class="row">
        <dt class="col-sm-3">Response:</dt>
        <dd class="col-sm-9"><?php echo $response->response; ?></dd>
    </dl>
    <hr>
    <dl class="row">
        <dt class="col-sm-3">Status:</dt>
        <dd class="col-sm-9"><?php echo $response->status; ?></dd>
    </dl>
    <hr>
    <dl class="row">
        <dt class="col-sm-3">Transaction:</dt>
        <dd class="col-sm-9"><?php echo $response->transaction; ?></dd>
    </dl>
    <hr>
    <dl class="row">
        <dt class="col-sm-3">Transaction Type:</dt>
        <dd class="col-sm-9"><?php echo $response->transaction_type; ?></dd>
    </dl>
    <hr>
    <dl class="row">
        <dt class="col-sm-3">Order ID:</dt>
        <dd class="col-sm-9"><?php echo $response->order_id ? $response->order_id : '-'; ?></dd>
    </dl>
    <hr>
    <dl class="row">
        <dt class="col-sm-3">Group ID:</dt>
        <dd class="col-sm-9"><?php echo $response->group_id ? $response->group_id : '-'; ?></dd>
    </dl>
    <hr>
    <dl class="row">
        <dt class="col-sm-3">AuthCode:</dt>
        <dd class="col-sm-9"><?php echo $response->auth_code ? $response->auth_code : '-'; ?></dd>
    </dl>
    <hr>
    <dl class="row">
        <dt class="col-sm-3">HostRefNum:</dt>
        <dd class="col-sm-9"><?php echo $response->host_ref_num ? $response->host_ref_num : '-'; ?></dd>
    </dl>
    <hr>
    <dl class="row">
        <dt class="col-sm-3">RetrefNum:</dt>
        <dd class="col-sm-9"><?php echo $response->ret_ref_num ? $response->ret_ref_num : '-'; ?></dd>
    </dl>
    <hr>
    <dl class="row">
        <dt class="col-sm-3">HashData:</dt>
        <dd class="col-sm-9"><?php echo $response->hash_data ? $response->hash_data : '-'; ?></dd>
    </dl>
    <hr>
    <dl class="row">
        <dt class="col-sm-3">ProcReturnCode:</dt>
        <dd class="col-sm-9"><?php echo $response->code; ?></dd>
    </dl>
    <hr>
    <dl class="row">
        <dt class="col-sm-3">Error Code:</dt>
        <dd class="col-sm-9"><?php echo $response->error_code ? $response->error_code : '-'; ?></dd>
    </dl>
    <hr>
    <dl class="row">
        <dt class="col-sm-3">Error Message:</dt>
        <dd class="col-sm-9"><?php echo $response->error_message ? $response->error_message : '-'; ?></dd>
    </dl>
    <hr>
    <dl class="row">
        <dt class="col-sm-12">All Data Dump:</dt>
        <dd class="col-sm-12">
            <pre><?php dump($response); ?></pre>
        </dd>
    </dl>
    <hr>
    <div class="text-right">
        <a href="index.php" class="btn btn-lg btn-info">&lt; Click to payment form</a>
    </div>
</div>

<?php require '../../template/_footer.php'; ?>
