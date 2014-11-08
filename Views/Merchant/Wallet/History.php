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
                    <h4>Transactions History.</h4>
                </div>
                <table class="table table-striped">
                    <thead>
                    <tr>
                        <td>S/N</td>
                        <td>Application</td>
                        <td>Transaction type</td>
                        <td>Amount (N)</td>
                    </tr>
                    </thead>

                    <tbody>
                    <tr>
                        <td>1</td>
                        <td>Supergeeks Nigeria</td>
                        <td><span class="label label-warning">DEBIT</span></td>
                        <td>100</td>
                    </tr>
                    <tr>
                        <td>1</td>
                        <td>Supergeeks Nigeria</td>
                        <td><span class="label label-warning">DEBIT</span></td>
                        <td>100</td>
                    </tr>
                    <tr>
                        <td>1</td>
                        <td>Supergeeks Nigeria</td>
                        <td><span class="label label-warning">DEBIT</span></td>
                        <td>100</td>
                    </tr>
                    <tr>
                        <td>1</td>
                        <td>Supergeeks Nigeria</td>
                        <td><span class="label label-warning">DEBIT</span></td>
                        <td>100</td>
                    </tr>
                    <tr>
                        <td>1</td>
                        <td>Supergeeks Nigeria</td>
                        <td><span class="label label-warning">DEBIT</span></td>
                        <td>100</td>
                    </tr>
                    </tbody>
                </table>
            </div>

            <div>
                <ul class="pagination">
                    <li><a href="#">< PREVIOUS</a></li>
                    <li><a href="#">NEXT ></a></li>
                </ul>
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