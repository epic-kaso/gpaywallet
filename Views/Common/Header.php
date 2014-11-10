<?php include_once 'AuthHeader.php'; ?>
<div class="navbar navbar-gpay navbar-fixed-top">
    <div class="container">
        <div class="navbar-header">
            <img src="/Public/images/logo.png" class="navbar-brand" />
        </div>
        <ul class="nav navbar-nav">
            <li><a href="/api/v1/user/wallet/balance">WALLET BALANCE</a></li>
            <li><a href="/api/v1/user/wallet/history">TRANSACTION HISTORY</a></li>
            <li><a href="/api/v1/user/wallet/fund">FUND WALLET</a></li>
            <li><a href="/api/v1/user/wallet/apps">APPS</a></li>
        </ul>


        <ul class="nav navbar-nav pull-right">
            <li><a href="/api/v1/user/profile">PROFILE</a></li>
            <li><a href="/logout">LOGOUT</a></li>
        </ul>
    </div>
</div>
