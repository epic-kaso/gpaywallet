<?php include_once './Views/Merchant/Common/Navbar.php'; ?>

<div class="container">
    <div class="row">
        <div class="col-sm-8 login-box">

            <div class="panel" style="
                border: #f2f2f2 solid 1px;
            ">
                <div class="panel-body">
                    <h4>Wallet Balance: <strong class="pull-right">N <?= $merchant->wallet ?></strong></h4>
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
                        <td>Transaction type</td>
                        <td>Transaction Status</td>
                        <td>Amount (N)</td>
                    </tr>
                    </thead>

                    <tbody>

                    <?php if (isset($history) && !empty($history)) {
                        $index = 1;
                        foreach ($history as $h) {
                            ?>
                            <tr>
                                <td><?= $index ?></td>
                                <td><span
                                        class="label label-<?= $h->transaction_type == 'credit' ? 'success' : 'warning' ?>">
                                    <?= $h->transaction_type ?>
                                </span>
                                </td>
                                <td><?= $h->transaction_status ?></td>
                                <td><?= $h->transaction_amount ?></td>
                                <td><?= \Carbon\Carbon::createFromTimestamp($h->created_at->getTimestamp())->diffForHumans() ?></td>
                            </tr>
                            <?php
                            $index++;
                        }
                    } else { ?>
                        <tr>
                            <td class="text-center" colspan="5">
                                <p>You currently have no transaction History</p>
                            </td>
                        </tr>
                    <?php } ?>
                    </tbody>
                </table>
            </div>

            <?php if (isset($history) && !empty($history)) { ?>
            <div>
                <ul class="pagination">
                    <li><a href="#">< PREVIOUS</a></li>
                    <li><a href="#">NEXT ></a></li>
                </ul>
            </div>
            <?php
            }
            ?>
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