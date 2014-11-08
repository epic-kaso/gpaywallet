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
            <ul class="list-group">
                <li class="list-group-item">
                    <h1>POST REQUEST TO <code>/api/v1/transaction</code></h1>
                    <p>Use the params below as POST params when making request.</p>
                </li>
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