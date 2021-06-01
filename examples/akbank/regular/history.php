<?php

require '_config.php';

$templateTitle = 'History Order';

require '../../template/_header.php';

// History Order
$query = $pos->history([
    'order_id' => '201810297189',
]);

$response = $query->getResponse();
?>

    <div class="result">
        <h3 class="text-center text-<?= $response->proc_return_code === '00' ? 'success' : 'danger'; ?>">
            <?= $response->proc_return_code === '00' ? 'History Order is successful!' : 'History Order is not successful!'; ?>
        </h3>
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

<?php require '../../template/_footer.php';
