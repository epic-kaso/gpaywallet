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
                <div class="panel-body">
                    <h4>Output</h4><hr/>
                    <?= $response ?>
                    <h4>Code</h4><hr/>
                    <textarea readonly="readonly" class="form-control" style="height: 300px"><?= $response ?></textarea>
                </div>

            </div>

            <ul class="list-group">
                <li class="list-group-item">
                    <p>
                        <strong>wallet_app_id</strong> - the Application Id of the wallet app you intend to use
                    </p>
                </li>
                <li class="list-group-item">
                    <p>
                        <strong>wallet_transaction_type</strong> - The type of transaction you are performing, whether it's a DEBIT or a CREDIT transaction
                    </p>
                </li>
                <li class="list-group-item">
                    <p>
                        <strong>wallet_transaction_name</strong> (optional) - The name to give hte transaction, for identification purposes
                    </p>
                </li>

                <li class="list-group-item">
                    <p>
                        <strong>wallet_transaction_amount</strong> - The amount ,in Naira, of the transaction
                    </p>
                </li>

                <li class="list-group-item">
                    <p>
                        <strong>wallet_user_token</strong> (optional) - This token is used to identify a logged in user, so as to avoid multiple logins
                    </p>
                </li>

                <li class="list-group-item">
                    <p>
                        <strong>wallet_user_email</strong> (optional) - This email is used to identify a gpay express user, so as to make login easy
                    </p>
                </li>

                <li class="list-group-item">
                    <p>
                        <strong>wallet_success_url</strong> (optional) - This url will be called on successful transaction
                    </p>
                </li>

                <li class="list-group-item">
                    <p>
                        <strong>wallet_failure_url</strong> (optional) - This url will be called on failed transaction
                    </p>
                </li>
            </ul>
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