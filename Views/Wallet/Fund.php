

<div class="container">
    <div class="row">
        <div class="col-sm-10 col-sm-offset-1 login-box">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h4>Fund your Wallet</h4>
                </div>
                <div class="panel-body">
                    <form method="post" action="http://gpayexpress.com/gpay/gpayexpress.php">
                        <input type="hidden" name="merchantID" value="141101"/>
                        <input type="hidden" name="itemName" value="PrintRabbit Wallet Fund"/>
                        <input type="hidden" name="itemDesc" value="PrintRabbit Wallet Fund"/>
                        <input type="hidden" name="merchantTransRef" value="<?= time() ?>">
                        <input type="hidden" name="itemImageURL" value='<?= $image_url  ?>'/>
<!--                        <input type="hidden" name="successURL" value="http://localhost:8000/api/v1/user/wallet/fund/success"/>-->
<!--                        <input type="hidden" name="failURL" value="http://localhost:8000/api/v1/user/wallet/fund/failure"/>-->
                        <input type="hidden" name="successURL" value="<?= 'http://localhost:8000'.$success_url ?>"/>
                        <input type="hidden" name="failURL" value="<?= 'http://localhost:8000'.$failure_url ?>"/>
                        <div class="form-group">
                            <label>Amount: </label>
                            <input type="number" min="1" name="itemPrice" placeholder="AMOUNT" class="form-control" />
                        </div>
                        <div class="form-group">
                            <input type="submit" class="btn btn-primary" value="FUND" />
                        </div>

                        <img src="http://gpayexpress.com/wp-content/uploads/2013/04/Gpay_Express_Source-300x151.png"
                             class="img-responsive pull-right"
                             style="height: 80px"
                            />
                    </form>
                </div>

            </div>
        </div>
    </div>
</div>