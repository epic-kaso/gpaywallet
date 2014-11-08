<div class="container">
    <div class="row">
        <div class="col-sm-4 col-sm-offset-4 login-box">
            <img src="/Public/images/logo.png" class="img-rounded img-responsive tiny-logo text-center" />
            <h4>Login to GPay Wallet Account</h4>

            <form action="/api/v1/merchant/register" method="post">

                <div class="form-group">
                    <input type="text" name="merchant_id" placeholder="MERCHANT ID" class="form-control" />
                </div>

                <div class="form-group">
                    <input class="form-control" type="password" name="password" placeholder="PASSWORD"/>
                </div>

                <div class="form-group">
                    <input class="form-control" type="password" name="password_confirmation" placeholder="PASSWORD CONFIRMATION"/>
                </div>

                <div class="form-group">
                    <input class="btn btn-primary" value="REGISTER" type="submit"/>
                </div>
            </form>
        </div>
    </div>
</div>