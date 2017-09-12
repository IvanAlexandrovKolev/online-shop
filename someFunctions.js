


function updatePrice() {
    let promocode = $('input[name=promocode]').val();
    if(promocode.length > 0){
        let data = {
            promo: promocode
        };
        $.ajax({
            method: "POST",
            data: data,
            url: "http://ivan.urandeals.com",
            success: validatePromocode
        });
    }
    function validatePromocode(promo) {
        console.log(promo)
        if(promo == 1){
            let currentPrice = $('#total_price').text();
            currentPrice = currentPrice - 0.2*currentPrice;
            currentPrice = Math.round(currentPrice * 100) / 100
            $('#total_price').text(currentPrice);
            $('#promocode_no').hide();
            $('#promocode_yes').show();
        }
    }
}

$("#categories").on('change',function(){
    let category_id = $(this).val();
    console.log(category_id);
    let data = {
        function: "fillSubcats",
        category_id: category_id,
    };
    $.ajax({
        method: "POST",
        url: "http://ivan.urandeals.com/index.php",
        data: data,
        success: fillSelect,
    });
});
function fillSelect(data) {
    let select = $('#subcategories');
    select.empty();

    if(data.length > 0){
        console.log(data);
        let subs = JSON.parse(data);
        //let subs = data;
        for(let subcategory of subs){
            let option = `<option value="${subcategory.id}">${subcategory.subcategory}</option>`;
            select.append(option);
        }
    }
    else {
        let option = `<option>No subcategories yet.</option>`;
        select.append(option);
    }
}

$("#categories_search").on('change',function(){
    let category_id = $(this).val();
    let category = $(this).find(":selected").text();
    if(category == "All categories"){
        $.ajax({
        method: "POST",
            url: "http://ivan.urandeals.com/index.php",
        });
        $('#subcategories_search select').val("none");
        $('#subcategories_search').hide();
    }else {
        let data = {
            function: "fillSubcats",
            category_id: category_id,
        };
        $.ajax({
            method: "POST",
            url: "http://ivan.urandeals.com/index.php",
            data: data,
            success: fillSelectSearch,
        });
    }
});
function fillSelectSearch(data) {
    let select = $('#subcategories_search');
    select.show();
    $('#search_but').show();
    select.empty();

    if(data.length > 0){
        let subs = JSON.parse(data);
        let option = `<option value="none">Select subcategory</option>`;
        select.append(option);
        for(let subcategory of subs){
            option = `<option value="${subcategory.id}">${subcategory.subcategory}</option>`;
            select.append(option);
        }
    }
    else {
        let option = `<option>No subcategories yet.</option>`;
        select.append(option);
    }
}

$(".quantity").on('change',function(){
    let prodId = $(this)[0].id;
    let quantity = $(this).val();
    let data = {
        update_quantity: true,
        prod_id: prodId,
        quantity: quantity
    };
    $.ajax({
        method: "POST",
        url: "http://ivan.urandeals.com/ajax.php",
        data: data,
        success: changePriceText
    });
});
function changePriceText(tot) {
    if(isNumber(tot)){
        $('#total_price').text(tot);
    }
}


function showInfo(message) {
    $('#infoBox').text(message);
    $('#infoBox').show();
    setTimeout(function() {
        $('#infoBox').fadeOut();
    }, 3000);
}
function showError(message) {
    $('#errorBox').text(message);
    $('#errorBox').show();
    setTimeout(function() {
        $('#errorBox').fadeOut();
    }, 3000);
}
function isNumber(n) {
    return !isNaN(parseFloat(n)) && isFinite(n);
}


