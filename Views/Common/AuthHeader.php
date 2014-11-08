<html>
<head>
    <title>
        GPAY WALLET
    </title>
    <link href="/Public/styles/bootstrap.min.css" rel="stylesheet">
    <link href="/Public/styles/wallet.css" rel="stylesheet">
</head>
<body>

<?php if(!empty($_SESSION['error'])) { ?>
    <div class="alert alert-danger text-center">
        <p><?= $_SESSION['error']  ?></p>
    </div>
<?php } ?>
<?php if(!empty($error)) { ?>
    <div class="alert alert-danger text-center">
        <p><?= $error ?></p>
    </div>
<?php } ?>

<?php if(!empty($message)) { ?>
<div class="alert alert-danger text-center">
    <p><?= $message ?></p>
</div>
<?php } ?>