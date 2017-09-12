{include file="header.tpl"}
<div class="container text-center" style="border:1px solid black;margin-top: 15px;margin-bottom: 5px">
    <div style="width: 60%;padding-left: 5px">
        <form class="form-horizontal" id="login_form" method="POST">
            <fieldset>
                <legend>Login</legend>
                <div class="form-group">
                    <label for="inputEmail" class="col-lg-2 control-label">Username</label>
                    <div class="col-lg-10">
                        <input type="text" class="form-control" id="inputEmail" placeholder="Username" name="username"
                               required>
                    </div>
                </div>
                <div class="form-group">
                    <label for="textArea" class="col-lg-2 control-label">Password</label>
                    <div class="col-lg-10">
                        <input type="password" class="form-control" id="inputEmail" placeholder="Password"
                               name="password" required>
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-lg-10 col-lg-offset-2">
                        <button type="submit" class="btn btn-default" style="width: 100%;">Login
                        </button>
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-lg-10 col-lg-offset-2">
                        <a href="/Register/forgot_password" class="btn btn-default" style="width: 100%;">Forgot
                            password?</a>
                    </div>
                </div>
                <a href="fblogin.php">Facebook Login Button</a>
                {if isset($error)}
                    <div style="color: red">
                        {foreach from=$error item=er}
                            {$er}
                            <br>
                        {/foreach}
                    </div>
                {/if}
            </fieldset>
        </form >
    </div>
</div>
    <script>
        $('#errorBox').show();
        setTimeout(function () {
            $('#errorBox').fadeOut();
        }, 3000);
        $('#infoBox').show();
        setTimeout(function () {
            $('#infoBox').fadeOut();
        }, 3000);
    </script>