<?php include_once './Views/Merchant/Common/Navbar.php'; ?>

<div class="container">
    <div class="row">
        <div class="col-sm-10 col-sm-offset-1 login-box">

            <div class="panel panel-default">
                <div class="panel-heading">
                    <span>Profile Edit.</span>
                    <a class="btn btn-default btn-xs pull-right" href="/api/v1/merchant/profile">View</a>
                </div>
                <div class="panel-body">
                <form action="/api/v1/merchant/profile/edit" method="post">
                <div class="form-group">
                    <label>Merchant ID: </label>
                    <span class="form-control-static"><?= $merchant->merchant_id ?></span>
                </div>

                <div class="form-group">
                    <label>Phone: </label>
                    <input class="form-control" placeholder="Phone Number" value="<?= $merchant->phone ?>" name="phone"/>
                </div>

                <div class="form-group">
                    <label>Password: </label>
                    <input class="form-control" placeholder="Password" name="password" type="password"/>
                </div>

                <div class="form-group">
                    <label>Confirm Password: </label>
                    <input class="form-control" placeholder="Confirm Password" name="password_confirmation" type="password"/>
                </div>

                    <div class="form-group">
                        <label>Bank: </label>
                        <select class="form-control" name="bank_name">
                            <optgroup label="SELECT BANK">
                                <option
                                    <?= $merchant->bank_name == 'ACCESS BANK' ? 'selected="selected"' : '' ?>
                                    >ACCESS BANK</option>
                                <option
                                    <?= $merchant->bank_name == 'KEYSTONE BANK' ? 'selected="selected"' : '' ?>
                                    >KEYSTONE BANK</option>
                                <option
                                    <?= $merchant->bank_name == 'DIAMOND BANK' ? 'selected="selected"' : '' ?>
                                    >DIAMOND BANK</option>
                                <option
                                    <?= $merchant->bank_name == 'ENTERPRISE BANK' ? 'selected="selected"' : '' ?>
                                    >ENTERPRISE BANK</option>
                                <option
                                    <?= $merchant->bank_name == 'ECO BANK' ? 'selected="selected"' : '' ?>
                                    >ECO BANK</option>
                                <option
                                    <?= $merchant->bank_name == 'FIDELITY BANK' ? 'selected="selected"' : '' ?>
                                    >FIDELITY BANK</option>
                                <option
                                    <?= $merchant->bank_name == 'FIRST BANK' ? 'selected="selected"' : '' ?>
                                    >FIRST BANK</option>
                                <option
                                    <?= $merchant->bank_name == 'FCMB BANK' ? 'selected="selected"' : '' ?>
                                    >FCMB BANK</option>
                                <option
                                    <?= $merchant->bank_name == 'GT BANK' ? 'selected="selected"' : '' ?>
                                    >GT BANK</option>
                                <option
                                    <?= $merchant->bank_name == 'SKYE BANK' ? 'selected="selected"' : '' ?>
                                    >SKYE BANK</option>
                                <option
                                    <?= $merchant->bank_name == 'UNION BANK' ? 'selected="selected"' : '' ?>
                                    >UNION BANK</option>
                                <option
                                    <?= $merchant->bank_name == 'UBA BANK' ? 'selected="selected"' : '' ?>
                                    >UBA BANK</option>
                                <option
                                    <?= $merchant->bank_name == 'ZENITH BANK' ? 'selected="selected"' : '' ?>
                                    >ZENITH BANK</option>
                            </optgroup>
                        </select>
                    </div>

                    <div class="form-group">
                        <label>Bank Account Name: </label>
                        <input class="form-control" type="text" value="<?= $merchant->bank_account_name ?>" name="bank_account_name" placeholder="Bank Account Name"/>
                    </div>

                    <div class="form-group">
                        <label>Bank Account Number: </label>
                        <input class="form-control" type="number" value="<?= $merchant->bank_account_number ?>" min="0000000000" name="bank_account_number" placeholder="ACCOUNT NUMBER"/>
                    </div>

                <div class="form-group">
                    <input class="btn btn-primary" value="Save" type="submit" />
                </div>
                </form>
                </div>
            </div>
        </div>
    </div>
</div>