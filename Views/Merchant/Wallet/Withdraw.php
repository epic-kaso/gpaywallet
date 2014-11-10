<?php include_once './Views/Merchant/Common/Navbar.php'; ?>

<div class="container">
    <div class="row">
        <div class="col-sm-8 login-box">

            <div class="panel" style="
                border: #f2f2f2 solid 1px;
            ">
                <div class="panel-body">
                    <h4>Wallet Balance:  <strong class="pull-right">N 0.00</strong></h4>
                </div>
            </div>

            <div class="panel panel-default">
                <div class="panel-heading">
                    <h4>Fund Withdrawal Request.</h4>
                </div>
                <div class="panel-body">
                    <form>
                        <div class="form-group">
                            <label>Amount: </label>
                            <input placeholder="AMOUNT" class="form-control" type="number" name="amount"/>
                        </div>

                        <div class="form-group">
                            <input value="Submit" class="btn btn-primary" type="submit"/>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <div class="col-sm-4 login-box">
            <div class="list-group">
                <a href="/api/v1/merchant/wallet/withdraw-funds" class="list-group-item">Withdraw Funds</a>
                <a href="/api/v1/merchant/wallet/balance" class="list-group-item">Balance</a>
                <a href="/api/v1/merchant/wallet/history" class="list-group-item">History</a>
            </div>
        </div>
    </div>
</div>