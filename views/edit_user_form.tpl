{include file="header.tpl"}
<div class="container" style="border:1px solid black;margin-top: 15px;margin-bottom: 5px">
    {if isset($error)}
        <div style="color: red">
            {foreach from=$error item=er}
                {$er}
                <br>
            {/foreach}
        </div>
    {/if}
    <form class="form-horizontal" enctype="multipart/form-data" id="edit_form" method="POST">
        <div style="width: 60%;padding-left: 5%">
            <fieldset>
                <legend>Edit user ID: {$user.id}</legend>
                <div class="form-group">
                    <label for="inputEmail" class="col-lg-2 control-label">Username</label>
                    <div class="col-lg-10">
                        <input type="text" class="form-control" id="inputEmail" placeholder="Name" name="username"
                               {if isset($user.username)}value="{$user.username}" {/if} >
                    </div>
                </div>
                <div class="form-group">
                    <label for="inputEmail" class="col-lg-2 control-label">Password</label>
                    <div class="col-lg-10">
                        <input type="password" class="form-control" id="inputEmail" placeholder="Password" name="password">
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-lg-10 col-lg-offset-2">
                        <button type="submit" class="btn btn-default">Edit</button>
                    </div>
                </div>
            </fieldset>
        </div>
    </form>
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