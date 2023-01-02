/*!
* Start Bootstrap - Bare v5.0.7 (https://startbootstrap.com/template/bare)
* Copyright 2013-2021 Start Bootstrap
* Licensed under MIT (https://github.com/StartBootstrap/startbootstrap-bare/blob/master/LICENSE)
*/
// This file is intentionally blank
// Use this file to add JavaScript to your project

// ---FORM_STYLES SCRIPTS--- //
/*
$(document).ready(function(){

    //-- Click on terms and conditions
    $(".term").click(function(){
        var ctrl = $(this).find("i");
        if (ctrl.hasClass("fa-check-square-o")){
            ctrl.attr("class","fa fa-square-o");
        }else{
            ctrl.attr("class", "fa fa-check-square-o");
        }
    }) 

    $("input").blur(function(){
        if ($(this).val() != ""){
            $(this).parent().css({"color":"black"});
            $(this).css({"border-bottom":"1px solid silver","color":"gray"});                 
        }
    })
    
    //--- CONTINUE ---
    $("form > p > a").click(function(){
        //-- Detect terms and conditions
        var term = false;
        if ($(".term > i").hasClass('fa-check-square-o')){
            term = true;
        }
        
        //-- only example
        var user = {};
        user.name = $("input[name='name']").val();
        user.id = $("input[name='id']").val();
        user.phone = $("input[name='phone']").val();
        user.email = $("input[name='email']").val();
        user.term = term;

        //-- Validator            
        $("input").each(function(e, valor){
            var error = false;
            if ($(this).val() == ""){
                error = true;
            }
            if (error === true){
                //-- with errors
                $(this).parent().css({"color":"red"});
                $(this).css({"border-bottom":"1px solid red"});
            }else{
                //-- without errors
                $(this).parent().css({"color":"black"});
                $(this).css({"border-bottom":"1px solid silver","color":"gray"}); 
            }
        })

        //-- msg example
        $("body").append(JSON.stringify(user) + "<br>");
    })
})
*/
// ---END FORM_STYLE SCRIPTS--- //

// ---START CART SCRIPTS--- //

function showHide(id)
{
    var x = document.getElementById(id)
    if (x.style.visibility === "hidden")
    {
        x.style.visibility = "visible"
    }
    else
    {
        x.style.visibility = "hidden"
    }
}

if (document.readyState == 'loading')
{
    document.addEventListener('DOMContentLoaded', ready)
}
else
{
    ready()
}

function ready()
{
    var removeCartItemButtons = document.getElementsByClassName('btn-remove')
    for (var i = 0; i < removeCartItemButtons.length; i++)
    {
        var button = removeCartItemButtons[i]
        button.addEventListener('click', removeCartItem)
    }

    var quantityInputs = document.getElementsByClassName('cart-quantity-input')
    for (var i = 0; i < quantityInputs.length; i++)
    {
        var input = quantityInputs[i]
        input.addEventListener('change', quantityChanged)
    }

    var addToCartButtons = document.getElementsByClassName('add-to-cart')
    for (var i = 0; i < addToCartButtons.length; i++)
    {
        var button = addToCartButtons[i]
        button.addEventListener('click', addToCartClicked)
    }

    document.getElementsByClassName('btn-purchase')[0].addEventListener('click', purchaseClicked)
}

function purchaseClicked()
{
    alert('Thank you for your order')
    var cartItems = document.getElementsByClassName('cart-items')[0]
    while (cartItems.hasChildNodes())
    {
        cartItems.removeChild(cartItems.firstChild)
    }
    updateCartTotal()
}

function removeCartItem(event)
{
    var buttonClicked = event.target
    buttonClicked.parentElement.parentElement.remove()
    updateCartTotal()
}

function quantityChanged(event)
{
    var input = event.target
    if (isNaN(input.value) || input.value <= 0)
    {
        input.value = 1
    }
    updateCartTotal()
}

function addToCartClicked(event)
{
    var button = event.target
    var shopItem = button.parentElement.parentElement.parentElement
    var quantityInput = shopItem.getElementsByClassName('card-quantity-input')[0]
    var title = shopItem.getElementsByClassName('card-title')[0].innerText
    var price = shopItem.getElementsByClassName('card-price')[0].innerHTML.replace('€', '')
    var quantity = quantityInput.value
    if (isNaN(quantity) || quantity <= 0) {
        quantity = 1
    }
    console.log(quantity)
    addItemToCart(title, price, quantity)
    updateCartTotal()
}

function addItemToCart(title, price, quantity)
{
    var cartRow = document.createElement('div')
    cartRow.classList.add('cart-row')
    var cartItems = document.getElementsByClassName('cart-items')[0]
    var cartItemNames = cartItems.getElementsByClassName('cart-item-title')
    for (var i = 0; i < cartItemNames.length; i++)
    {
        if (cartItemNames[i].textContent == title)
        {
            alert('This item is already added to the cart')
            return
        }
    }
    var cartRowContents = `
        <div class="cart-item cart-column">
            <span class="cart-item-title">${title}</span>
        </div>
        <span class="cart-price-el cart-column">€${price}</span>
        <div class="cart-quantity cart-column">
            <input class="cart-quantity-input" type="number" value="${quantity}">
        </div>
        <div class="cart-action cart-column">
            <button class="btn-remove btn btn-danger" type="button">X</button>
        </div>`
    cartRow.innerHTML = cartRowContents
    cartItems.append(cartRow)
    cartRow.getElementsByClassName('btn-remove')[0].addEventListener('click', removeCartItem)
    cartRow.getElementsByClassName('cart-quantity-input')[0].addEventListener('change', quantityChanged)
}

function updateCartTotal()
{
    var cartItemContainer = document.getElementsByClassName('cart-items')[0]
    var cartRows = cartItemContainer.getElementsByClassName('cart-row')
    var total = 0
    var totalQuantity = 0;
    for (var i = 0; i < cartRows.length; i++)
    {
        var cartRow = cartRows[i]
        var priceElement = cartRow.getElementsByClassName('cart-price-el')[0]
        var quantityElement = cartRow.getElementsByClassName('cart-quantity-input')[0]
        var price = parseFloat(priceElement.textContent.replace('€', ''))
        var quantity = quantityElement.value
        total = total + (price * quantity)
        totalQuantity = totalQuantity + parseFloat(quantity)
    }
    total = Math.round(total * 100) / 100
    var totalBoxes = document.getElementsByClassName('cart-total-price');
    for (let i = 0; i < totalBoxes.length; i++) {
        totalBoxes[i].textContent = '€' + total
    }
    let minicartTotalCountBoxes = document.getElementsByClassName('minicart-count');
    for (let i = 0; i < minicartTotalCountBoxes.length; i++) {
        if (totalQuantity > 0) {
            minicartTotalCountBoxes[i].classList.remove('d-none')
        } else {
            minicartTotalCountBoxes[i].classList.add('d-none')
        }
        minicartTotalCountBoxes[i].textContent = totalQuantity
    }
}

// ---END CART SCRIPTS--- //