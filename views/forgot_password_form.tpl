

{include file="header.tpl"}
<div class="container text-center" style="border:1px solid black;margin-top: 15px;margin-bottom: 5px">
    <div style="width: 60%;padding-left: 5px">
        <form class="form-horizontal" action="reset_password"  method="POST" >
            <fieldset>
                <legend>Forgot password</legend>
                <div class="form-group">
                    <label for="inputEmail" class="col-lg-2 control-label">Username</label>
                    <div class="col-lg-10">
                        <input type="text" class="form-control" id="inputEmail" placeholder="Enter your username here" name="username"
                               required>
                    </div>
                </div>
                <div class="form-group">
                    <label for="inputEmail" class="col-lg-2 control-label">Email</label>
                    <div class="col-lg-10">
                        <input type="text" class="form-control" id="inputEmail" placeholder="Enter your email address here" name="email"
                               required {if isset($smarty.session['email'])}value="{$smarty.session['email']}"{/if}>
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-lg-10 col-lg-offset-2">
                        <button type="submit" class="btn btn-default" style="width: 100%;">Send
                        </button>
                    </div>
                </div>
                {if isset($error)}
                    <div style="color: red">
                        {foreach from=$error item=er}
                            {$er}
                            <br>
                        {/foreach}
                    </div>
                {/if}
            </fieldset>
        </form>
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