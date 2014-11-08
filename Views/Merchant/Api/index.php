<?php include_once './Views/Merchant/Common/Navbar.php'; ?>

<div class="container" style="padding-top: 100px;">
    <div class="row">
        <div class="col-sm-4">
            <div class="list-group">
                <a class="list-group-item" href="/api/v1/merchant/apps/generate-button">Generate Button</a>
                <a class="list-group-item" href="/api/v1/merchant/apps/api-doc">Api Documentation </a>
            </div>
        </div>

        <div class="col-sm-8">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h2>Generate Transaction Button to Use For GpayWallet</h2>
                </div>

                <div class="panel-body">
                    <form method="post" action="/api/v1/merchant/apps/generate-button">
                        <?php if(isset($apps) && empty($apps)){ ?>
                            <span class="label label-warning"><p>You need to create at least one wallet app.</p></span>
                        <?php
                        }?>
                        <div class="form-group">
                            <label>Select Wallet App to use: </label>
                            <select class="form-control" name="wallet_app_id">
                                <?php if(isset($apps) && !empty($apps)){
                                    foreach($apps as $app){ ?>
                                        <option value="<?= $app->hashcode ?>"><?= $app->name ?></option>
                                <?php
                                    }
                                } ?>
                            </select>
                        </div>

                        <div class="form-group">
                            <label>Select Transaction Type: </label>
                            <select class="form-control" name="wallet_transaction_type">
                                <option value="credit">CREDIT</option>
                                <option value="debit">DEBIT</option>
                            </select>
                        </div>

                        <div class="form-group">
                            <label>Transaction Name: </label>
                            <input class="form-control" type="text" name="wallet_transaction_name"/>
                        </div>

                        <div class="form-group">
                            <label>Transaction Amount: </label>
                            <input class="form-control" type="text" name="wallet_transaction_amount"/>
                        </div>

                        <div class="form-group">
                            <label>Button Text: </label>
                            <input class="form-control" type="text" name="button_text"/>
                        </div>

                        <div class="form-group">
                            <input type="submit" class="btn btn-primary" value="GENERATE BUTTON" />
                        </div>
                    </form>
                </div>

            </div>
        </div>
    </div>
</div>




<!--<form method="post" action="http://gpayexpress.com/gpay/gpayexpress.php">-->
<!--    <input type="hidden" name="merchantID" value="140201"/>-->
<!--    <input type="hidden" name="itemName" value="PrintRabbit Wallet Fund"/>-->
<!--    <input type="hidden" name="itemDesc" value="PrintRabbit Wallet Fund"/>-->
<!--    <input type="hidden" name="merchantTransRef" value="--><?//= time() ?><!--">-->
<!--    <input type="hidden" name="itemImageURL" value='--><?//= $image_url  ?><!--'/>-->
<!--    <input type="hidden" name="successURL" value="--><?//= $success_url ?><!--"/>-->
<!--    <input type="hidden" name="failURL" value="--><?//= $failure_url ?><!--"/>-->
<!--    <div class="form-group">-->
<!--        <label>Amount: </label>-->
<!--        <input type="number" min="1" name="itemPrice" placeholder="AMOUNT" class="form-control" />-->
<!--    </div>-->
<!--    <div class="form-group">-->
<!--        <input type="submit" class="btn btn-primary" value="FUND" />-->
<!--    </div>-->
<!---->
<!--    <img src="http://gpayexpress.com/wp-content/uploads/2013/04/Gpay_Express_Source-300x151.png"-->
<!--         class="img-responsive pull-right"-->
<!--         style="height: 80px"-->
<!--        />-->
<!--</form>-->