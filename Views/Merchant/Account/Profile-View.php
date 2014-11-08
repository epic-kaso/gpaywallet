<?php include_once './Views/Merchant/Common/Navbar.php'; ?>

<div class="container">
    <div class="row">
        <div class="col-sm-10 col-sm-offset-1 login-box">

            <div class="panel panel-default">
                <div class="panel-heading">
                    <span>My Profile.</span>
                    <a class="btn btn-default btn-xs pull-right" href="/api/v1/merchant/profile/edit">Edit</a>
                </div>
                <div class="panel-body">
                    <div class="form-group">
                        <label>Merchant ID: </label>
                        <span class="form-control-static"><?= $merchant->merchant_id ?></span>
                    </div>

                    <div class="form-group">
                        <label>Phone: </label>
                        <span class="form-control-static"><?= $merchant->phone ?></span>
                    </div>
                    <div class="form-group">
                        <label>Bank: </label>
                        <span class="form-control-static"><?= $merchant->bank_name ?></span>
                    </div>
                    <div class="form-group">
                        <label>Bank Account Name: </label>
                        <span class="form-control-static"><?= $merchant->bank_account_name ?></span>
                    </div>
                    <div class="form-group">
                        <label>Bank Account Number: </label>
                        <span class="form-control-static"><?= $merchant->bank_account_number ?></span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>