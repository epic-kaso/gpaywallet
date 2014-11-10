<div class="container">
    <div class="row">
        <div class="col-sm-10 col-sm-offset-1 login-box">

            <div class="panel panel-default">
                <div class="panel-heading">
                    <span>Profile Edit.</span>
                    <a class="btn btn-default btn-xs pull-right" href="/api/v1/user/profile">View</a>
                </div>
                <div class="panel-body">
                    <form action="/api/v1/user/profile/edit" method="post">
                        <div class="form-group">
                            <label>Email: </label>
                            <span class="form-control-static"><?= $user->email ?></span>
                        </div>

                        <div class="form-group">
                            <label>Phone: </label>
                            <input class="form-control" placeholder="Phone Number" value="<?= $user->phone ?>"
                                   name="phone"/>
                        </div>

                        <div class="form-group">
                            <label>Password: </label>
                            <input class="form-control" placeholder="Password" name="password" type="password"/>
                        </div>

                        <div class="form-group">
                            <label>Confirm Password: </label>
                            <input class="form-control" placeholder="Confirm Password" name="confirm_password"
                                   type="password"/>
                        </div>

                        <div class="form-group">
                            <input class="btn btn-primary" value="Save" type="submit"/>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>