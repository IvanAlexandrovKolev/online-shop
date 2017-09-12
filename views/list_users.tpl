{include file="header.tpl"}
<div class="container" style="border:1px solid black;margin-top: 15px;margin-bottom: 5px">
    <form id="search" action="users" method="get">
        <div class="form-group" style="width: 42%;padding: 5px">
            <div class="col-lg-10">
                <div class="input-group">
            <span class="input-group-btn">
 <select class="form-control" id="select" name="search_by" style="width: 130px" required>
     <option value="">Search by</option>
                <option {if isset($search_by) && $search_by == 'username'}selected {/if}
                        value="username">Username</option>
            <option {if isset($search_by) && $search_by == 'email'}selected {/if} value="email">Email</option>
            </select>
         </span>
                    <input type="text" class="form-control" style="width: 200px;"
                           name="search_text" {if isset($search_text)} value="{$search_text}" {/if} required>
                    <span class="input-group-btn">
      <input class="btn btn-default" type="submit" value="Search">
    </span>
                </div>
            </div>
        </div>
    </form>
    <br>
    <br>
    {if isset($error)}
        <div style="color: red">
            {foreach from=$error item=er}
                {$er}
                <br>
            {/foreach}
        </div>
    {/if}
    <br>
    <div style="padding: 20px;">
        {if isset($msg)}
            <div>{$msg}</div>
        {else}
            <h2>{$textline1}</h2>
            <div style="width: 60%;">
                <table class="table table-striped table-hover ">
                    <thead>
                    <tr>
                        <th>Id</th>
                        <th>Username</th>
                        <th>Email</th>
                        <th>Actions</th>
                    </tr>
                    </thead>
                    <tbody>
                    {foreach from=$all_users item=user}
                        {if $smarty.session['username']!== $user.username && $user.deleted != 1 && $user.activated == 1}
                            <tr>
                                <td>{$user.id}</td>
                                <td>{htmlspecialchars($user.username)}</td>
                                <td>{htmlspecialchars($user.email)}</td>
                                <td>
                                    <form method="POST" style="display: inline-block;">
                                        <input type="hidden" name="delete_user" value="{$user.token}">
                                        <input type="submit" value="Delete" class="btn btn-default btn-sm">
                                    </form>
                                    <form method="GET" style="display: inline-block;" >
                                        <input type="hidden" name="edit_user" value="{$user.token}">
                                        <input type="submit" value="Edit" class="btn btn-default btn-sm">
                                    </form>
                                    {if $user.admin == 0}
                                        <form method="POST" style="display: inline-block;">
                                            <input type="hidden" name="make_admin" value="{$user.token}">
                                            <input type="submit" value="Make admin" class="btn btn-default btn-sm">
                                        </form>
                                    {elseif $user.admin == 1}
                                        <form method="POST" style="display: inline-block;">
                                            <input type="hidden" name="make_user" value="{$user.token}">
                                            <input type="submit" value="Make user" class="btn btn-default btn-sm">
                                        </form>
                                    {/if}
                                </td>
                            </tr>
                        {/if}
                    {/foreach}
                    </tbody>
                </table>
            </div>
            <div id="pagination_controls">{$pagination_ctrls}</div>
        {/if}
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


