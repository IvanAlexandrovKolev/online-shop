{include file="header.tpl"}

<div class="container text-center" style="border:1px solid black;margin-top: 15px;margin-bottom: 5px">
    <div style="width: 60%;padding-left: 5px">
        {if isset($error)}
            <div style="color: red">
                {foreach from=$error item=er}
                    {$er}
                    <br>
                {/foreach}
            </div>
        {/if}
        <form class="form-horizontal" id="login_form" method="POST">
            <fieldset>
                <legend>Register</legend>
                <input type="hidden" name="register">
                <div class="form-group">
                    <label for="inputEmail" class="col-lg-2 control-label">Username</label>
                    <div class="col-lg-10">
                        <input type="text" class="form-control" id="inputEmail" placeholder="Username" name="username"
                               required {if isset($user.username)}value="{$user.username}"{/if}>
                    </div>
                </div>
                <div class="form-group">
                    <label for="inputEmail" class="col-lg-2 control-label">Email</label>
                    <div class="col-lg-10">
                        <input type="text" class="form-control" id="inputEmail" placeholder="Email" name="email"
                               required {if isset($user.email)}value="{$user.email}"{/if}>
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
                    <label for="inputEmail" class="col-lg-2 control-label">Repeat password</label>
                    <div class="col-lg-10">
                        <input type="password" class="form-control" id="inputEmail" placeholder="Repeat password"
                               name="conf_password" required>
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-lg-10 col-lg-offset-2">
                        <button id = "register" type="submit" class="btn btn-default" style="width: 100%;">Register
                        </button>
                    </div>
                </div>
            </fieldset>
        </form>
    </div>
</div>
<script>
    $('#errorBox').show();
    setTimeout(function() {
        $('#errorBox').fadeOut();
    }, 3000);
    $('#infoBox').show();
    setTimeout(function() {
        $('#infoBox').fadeOut();
    }, 3000);
</script>
