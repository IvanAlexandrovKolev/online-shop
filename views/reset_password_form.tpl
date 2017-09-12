{include file="header.tpl"}

<div class="container text-center" style="border:1px solid black;margin-top: 15px;margin-bottom: 5px">
    {if isset($error)}
        <div style="color: red">
            {foreach from=$error item=er}
                {$er}
                <br>
            {/foreach}
        </div>
    {/if}
    <div style="width: 60%;padding-left: 5px">
        <form class="form-horizontal"  method="POST" action="{$php_file}">
            <fieldset>
                <legend>{$label}</legend>
                {if isset($smarty.session.fb_username) && isset($smarty.session.fb_email)}
                    <div class="form-group">
                        <div class="col-lg-10">
                            <p>Username: {$smarty.session.fb_username}</p>
                            <p>Email: {$smarty.session.fb_email}</p>
                        </div>
                    </div>
                {/if}
                <div class="form-group">
                    <label for="inputEmail" class="col-lg-2 control-label">Password</label>
                    <div class="col-lg-10">
                        <input type="password" class="form-control" id="inputEmail"
                               placeholder="Enter your new password here" name="pass"
                               required>
                    </div>
                </div>
                <div class="form-group">
                    <label for="inputEmail" class="col-lg-2 control-label">Repeat password</label>
                    <div class="col-lg-10">
                        <input type="password" class="form-control" id="inputEmail"
                               placeholder="Repeat your new password here" name="conf_pass"
                               required>
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-lg-10 col-lg-offset-2">
                        <button type="submit" class="btn btn-default" style="width: 100%;">{$label}
                        </button>
                    </div>
                </div>

            </fieldset>
        </form>
    </div>
</div>

