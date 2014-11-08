<?php include_once './Views/Merchant/Common/Navbar.php'; ?>

<div class="container">
    <div class="row">
        <div class="col-sm-8 login-box">
            <h4>CREATE WALLET APP</h4>

            <form action="/api/v1/merchant/apps/create" method="post">

                <div class="form-group">
                    <input type="text" name="app_name" placeholder="APP NAME" class="form-control" />
                </div>

                <div class="form-group">
                    <input type="text" name="app_url" placeholder="APP WEBSITE" class="form-control" />
                </div>

                <div class="form-group">
                    <textarea class="form-control" name="app_description" placeholder="APP DESCRIPTION"></textarea>
                </div>

                <div class="form-group">
                    <input class="btn btn-primary" value="CREATE" type="submit"/>
                </div>
            </form>
        </div>

        <div class="col-sm-4 login-box">
            <div class="list-group">
                <a href="/api/v1/merchant/apps" class="list-group-item">All Apps</a>
            </div>
        </div>
    </div>
</div>