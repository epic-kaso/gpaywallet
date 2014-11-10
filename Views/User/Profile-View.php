
<div class="container">
    <div class="row">
        <div class="col-sm-10 col-sm-offset-1 login-box">

            <div class="panel panel-default">
                <div class="panel-heading">
                    <span>My Profile.</span>
                    <a class="btn btn-default btn-xs pull-right" href="/api/v1/user/profile/edit">Edit</a>
                </div>
                <div class="panel-body">
                    <div class="form-group">
                        <label>Email: </label>
                        <span class="form-control-static"><?= $user->email ?></span>
                    </div>

                    <div class="form-group">
                        <label>Phone: </label>
                        <span class="form-control-static"><?= $user->phone ?></span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>