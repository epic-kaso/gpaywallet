
<div class="container">
    <div class="row">
        <div class="col-sm-10 col-sm-offset-1 login-box">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h4>Your Wallet Apps</h4>
                </div>
                <table class="table table-striped">
                    <thead>
                    <tr>
                        <td>S/N</td>
                        <td>ID</td>
                        <td>Name</td>
                        <td>Active</td>
                        <td>Created</td>
                        <td>..</td>
                    </tr>
                    </thead>

                    <tbody>

                    <?php if (isset($walletapps) && !empty($walletapps)) {
                        $index = 1;
                        foreach ($walletapps as $h) {
                            ?>
                            <tr>
                                <td><?= $index ?></td>
                                <td><?= $h->token ?></td>
                                <td><?= WalletApp::find_by_id($h->wallet_app_id)->name ?></td>
                                <td><span class="label label-<?= $h->authorized == TRUE ? 'success' : 'warning' ?>">
                                    <?= $h->authorized == TRUE ? 'Yes' : 'No' ?>
                                </span>
                                </td>
                                <td><?= \Carbon\Carbon::createFromTimestamp($h->created_at->getTimestamp())->diffForHumans() ?></td>
                                <td>
                                    <form action="/api/v1/user/wallet/apps/modify/<?= $h->id ?>" method="post">
                                        <input type="submit" class="btn btn-xs btn-default" value="change"/>
                                    </form>
                                </td>
                            </tr>
                            <?php
                            $index++;
                        }
                    } ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>