<?php include_once './Views/Merchant/Common/Navbar.php'; ?>

<div class="container" style="padding-top: 100px">

    <div class="row">
        <div class="col-sm-12">
            <div class="form-group">
                <div class="btn-group">
                    <a href="/" class="btn btn-default">CREATE APP</a>
                    <a href="/" class="btn btn-default">ALL APPS</a>
                    <a href="/" class="btn btn-default">WITHDRAW FUNDS</a>
                    <a href="/" class="btn btn-default" disabled="disabled">LODGE A DISPUTE</a>
                    <a href="/" class="btn btn-default" disabled="disabled">CONTACT ADMIN</a>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-sm-6">
            <ul class="list-group">
                <li class="list-group-item">
                    <h4>EARNINGS TODAY</h4>
                    <span>N</span><span class="amount">1000.00</span>
                </li>

                <li class="list-group-item">
                    <h4>EARNINGS WEEK</h4>
                    <span>N</span><span class="amount">1000.00</span>
                </li>

                <li class="list-group-item">
                    <h4>EARNINGS MONTH</h4>
                    <span>N</span><span class="amount">1000.00</span>
                </li>
            </ul>
        </div>
        <div class="col-sm-6">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h3>Wallet Apps</h3>
                </div>
                <?php if(isset($apps) && !empty($apps)){?>

                    <table class="table table-striped">
                        <thead>
                        <tr>
                            <td>S/N</td>
                            <td>App Name</td>
                            <td>App ID</td>
                            <td>Status</td>
                        </tr>
                        </thead>

                        <tbody>

                    <?php $index = 1; foreach($apps as $app){ ?>
                            <tr>
                                <td><?= $index ?></td>
                                <td><a href="<?= $base_app_url.$app->hashcode ?>"><?= $app->name ?></a></td>
                                <td><?= $app->hashcode ?></td>
                                <td><span class="label label-success">ACTIVE</span></td>
                            </tr>
                    <?php $index++; } ?>

                        </tbody>
                    </table>
                <?php }else{ ?>
                    <table class="table table-striped">
                        <tbody>
                            <tr>
                                <td class="text-center" colspan="5">
                                    <p>You currently have no wallet apps</p>
                                    <a href="/merchant/apps/create" class="btn btn-info btn-lg">Create Wallet App</a>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                <?php } ?>

            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-sm-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h4>Recent Transactions.</h4>
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
                    </tbody>
                </table>
            </div>
        </div>

    </div>
</div>