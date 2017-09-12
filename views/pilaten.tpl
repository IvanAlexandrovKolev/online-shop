{include file="header.tpl"}
{if isset($error)}
    <div style="color: red">
        {foreach from=$error item=er}
            {$er}
            <br>
        {/foreach}
    </div>
{/if}

<div class="form" id="order">
    <div class="divide"></div>
    <div class="what-text white-text align-center">
        <span>Поръчайте тук:</span>
    </div>

    <form action="" method="post" class="f-padding">
        <input type="hidden" value="1" name="save">
        <div class="col-md-12">
            <label for="a1">Име и Фамилия</label>
            <input type="text" id="a1" name="name" {if isset($data["name"])}value="{$data["name"]}"{/if}>
        </div>
        <div class="col-md-12">
            <label for="a2">Телефон</label>
            <input type="text" id="a2" name="mobile" {if isset($data["mobile"])}value="{$data["mobile"]}"{/if}>
        </div>

        <div class="col-md-12">
            <label for="email">Email</label>
            <input type="email" id="email" name="email" {if isset($data["email"])}value="{$data["email"]}"{/if}>
        </div>

        <div class="col-md-12 no-padding">
            <input type="radio" id="1" name="quantity" value="1" class="checkbox checkbox-custom" checked="checked">
            <label for="1" class="checkbox-label checkbox-custom-label">1 БРОЙ маска за лице ( <strong>1.99 лв.</strong> )</label>
        </div>

        <div class="col-md-12 no-padding">
            <input type="radio" id="2" name="quantity" value="5" class="checkbox checkbox-custom">
            <label for="2" class="checkbox-label checkbox-custom-label">5 БРОЯ маска за лице ( <strong>8.99 лв.</strong> )</label>
        </div>

        <div class="col-md-12 no-padding">
            <input type="radio" id="3" name="quantity" value="10" class="checkbox checkbox-custom">
            <label for="3" class="checkbox-label checkbox-custom-label">10 БРОЯ маска за лице ( <strong>16.99 лв.</strong> )</label>
        </div>
        <div class="col-md-12 no-padding">
            <input type="radio" id="4" name="quantity" value="15" class="checkbox checkbox-custom">
            <label for="4" class="checkbox-label checkbox-custom-label">60 гр. Тубичка маска за лице ( <strong>39.99 лв.</strong> )</label>
        </div>
        <div class="col-md-12">
            <div class="divider"></div>
            <div class="center-o">
                <input type="submit" value="boton" class="order-button2">
            </div>
        </div>
    </form>
</div>