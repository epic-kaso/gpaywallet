<div class="container">
    <div class="row">
        <div class="col-sm-6 login-box">
            <h3>Authorize <?= $wallet_app->name ?> App for Transaction</h3>
            <p>
                The App <strong><?= $wallet_app->name ?></strong> is trying to use your wallet account to perform a transaction,
                login to authorize this transaction or cancel request to terminate transaction.
            </p>
            <div>
                <h4><?= $wallet_app->name ?></h4>
                <p><?= $wallet_app->app_url ?></p>
                <p><strong>Merchant ID</strong> -<?= $wallet_app->merchant->merchant_id ?></p>
                <p><?= $wallet_app->description ?></p>

            </div>
        </div>
        <div class="col-sm-6 login-box">
            <img src="/Public/images/logo.png" class="img-rounded img-responsive tiny-logo text-center" />
            <h4>Login to GPay Wallet Account</h4>

            <form method="post">
                <div class="form-group">
                    <input type="text" name="email" placeholder="EMAIL ADDRESS" class="form-control" />
                </div>

                <div class="form-group">
                    <input class="form-control" type="password" name="password" placeholder="PASSWORD"/>
                </div>

                <div class="form-group">
                    <input class="btn btn-primary" value="LOGIN" type="submit"/>
                </div>
            </form>
        </div>
    </div>
</div>