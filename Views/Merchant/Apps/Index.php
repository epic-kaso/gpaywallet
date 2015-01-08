<?php include_once './Views/Merchant/Common/Navbar.php'; ?>

<div class="container">
    <div class="row">
        <div class="col-sm-8 login-box">
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

        <div class="col-sm-4 login-box">
            <div class="list-group">
                <a  href="/api/v1/merchant/apps" class="list-group-item">All Apps</a>
                <a  href="/api/v1/merchant/apps/create" class="list-group-item">Create App</a>
            </div>
        </div>
    </div>
</div>