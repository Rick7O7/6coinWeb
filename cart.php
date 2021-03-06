<?php


?>
<style>
    @import url("https://fonts.googleapis.com/css2?family=Inconsolata&amp;family=Open+Sans&amp;display=swap");
    *, *::before, *::after {
        box-sizing: border-box;
    }
    html, body {
        min-height: 100%;
        font-family: 'Open Sans', sans-serif;
    }
    body {
        background: linear-gradient(50deg, #f3c680, rgba(161, 227, 226, 1));
    }
    /*-------------------- Buttons --------------------*/
    .btn {
        display: block;
        background: #bded7d;
        color: #fff;
        text-decoration: none;
        margin: 20px 0;
        padding: 15px 15px;
        border-radius: 5px;
        position: relative;
    }
    .btn::after {
        content: '';
        position: absolute;
        z-index: 1;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        transition: all 0.2s ease-in-out;
        box-shadow: inset 0 3px 0 rgba(0, 0, 0, 0), 0 3px 3px rgba(0, 0, 0, .2);
        border-radius: 5px;
    }
    .btn:hover::after {
        background: rgba(0, 0, 0, 0.1);
        box-shadow: inset 0 3px 0 rgba(0, 0, 0, 0.2);
    }
    /*-------------------- Form --------------------*/
    .form fieldset {
        border: none;
        padding: 0;
        padding: 10px 0;
        position: relative;
        clear: both;
    }
    .form fieldset.fieldset-expiration {
        float: left;
        width: 60%;
    }
    .form fieldset.fieldset-expiration .select {
        width: 84px;
        margin-right: 12px;
        float: left;
    }
    .form fieldset.fieldset-ccv {
        clear: none;
        float: right;
        width: 86px;
    }
    .form fieldset label {
        display: block;
        text-transform: uppercase;
        font-size: 11px;
        color: rgba(0, 0, 0, .6);
        margin-bottom: 5px;
        font-weight: bold;
        font-family: Inconsolata;
    }
    .form fieldset input, .form fieldset .select {
        width: 100%;
        height: 38px;
        color: #333;
        padding: 10px;
        border-radius: 5px;
        font-size: 15px;
        outline: none !important;
        border: 1px solid rgba(0, 0, 0, 0.3);
        box-shadow: inset 0 1px 4px rgba(0, 0, 0, 0.2);
    }
    .form fieldset input.input-cart-number, .form fieldset .select.input-cart-number {
        width: 82px;
        display: inline-block;
        margin-right: 8px;
    }
    .form fieldset input.input-cart-number:last-child, .form fieldset .select.input-cart-number:last-child {
        margin-right: 0;
    }
    .form fieldset .select {
        position: relative;
    }
    .form fieldset .select::after {
        content: '';
        border-top: 8px solid #222;
        border-left: 4px solid transparent;
        border-right: 4px solid transparent;
        position: absolute;
        z-index: 2;
        top: 14px;
        right: 10px;
        pointer-events: none;
    }
    .form fieldset .select select {
        appearance: none;
        position: absolute;
        padding: 0;
        border: none;
        width: 100%;
        outline: none !important;
        top: 6px;
        left: 6px;
        background: none;
    }
    .form fieldset .select select :-moz-focusring {
        color: transparent;
        text-shadow: 0 0 0 #000;
    }
    .form button {
        width: 100%;
        outline: none !important;
        background: linear-gradient(180deg, #49a09b, #3d8291);
        text-transform: uppercase;
        font-weight: bold;
        border: none;
        box-shadow: none;
        text-shadow: 0 1px 2px rgba(0, 0, 0, 0.2);
        margin-top: 90px;
    }
    .form button .fa {
        margin-right: 6px;
    }
    /*-------------------- Checkout --------------------*/
    .checkout {
        margin: 150px auto 30px;
        position: relative;
        width: 460px;
        background: white;
        border-radius: 15px;
        padding: 160px 45px 30px;
        box-shadow: 0 10px 40px rgba(0, 0, 0, .1);
    }
    /*-------------------- Credit Card --------------------*/
    .credit-card-box {
        perspective: 1000;
        width: 400px;
        height: 280px;
        position: absolute;
        top: -112px;
        left: 50%;
        transform: translateX(-50%);
    }
    .credit-card-box:hover .flip, .credit-card-box.hover .flip {
        transform: rotateY(180deg);
    }
    .credit-card-box .front, .credit-card-box .back {
        width: 400px;
        height: 250px;
        border-radius: 15px;
        backface-visibility: hidden;
        background: linear-gradient(135deg, #bd6772, #53223f);
        position: absolute;
        color: #fff;
        font-family: Inconsolata;
        top: 0;
        left: 0;
        text-shadow: 0 1px 1px rgba(0, 0, 0, 0.3);
        box-shadow: 0 1px 6px rgba(0, 0, 0, 0.3);
    }
    .credit-card-box .front::before, .credit-card-box .back::before {
        content: '';
        position: absolute;
        width: 100%;
        height: 100%;
        top: 0;
        left: 0;
        background: url('http://cdn.flaticon.com/svg/44/44386.svg') no-repeat center;
        background-size: cover;
        opacity: 0.05;
    }
    .credit-card-box .flip {
        transition: 0.6s;
        transform-style: preserve-3d;
        position: relative;
    }
    .credit-card-box .logo {
        position: absolute;
        top: 9px;
        right: 20px;
        width: 60px;
    }
    .credit-card-box .logo svg {
        width: 100%;
        height: auto;
        fill: #fff;
    }
    .credit-card-box .front {
        z-index: 2;
        transform: rotateY(0deg);
    }
    .credit-card-box .back {
        transform: rotateY(180deg);
    }
    .credit-card-box .back .logo {
        top: 185px;
    }
    .credit-card-box .chip {
        position: absolute;
        width: 60px;
        height: 45px;
        top: 20px;
        left: 20px;
        background: linear-gradient(135deg, #ddccf0 0%, #d1e9f5 44%, #f8ece7 100%);
        border-radius: 8px;
    }
    .credit-card-box .chip::before {
        content: '';
        position: absolute;
        top: 0;
        bottom: 0;
        left: 0;
        right: 0;
        margin: auto;
        border: 4px solid rgba(128, 128, 128, .1);
        width: 80%;
        height: 70%;
        border-radius: 5px;
    }
    .credit-card-box .strip {
        background: linear-gradient(135deg, #404040, #1a1a1a);
        position: absolute;
        width: 100%;
        height: 50px;
        top: 30px;
        left: 0;
    }
    .credit-card-box .number {
        position: absolute;
        margin: 0 auto;
        top: 103px;
        left: 19px;
        font-size: 38px;
    }
    .credit-card-box label {
        font-size: 10px;
        letter-spacing: 1px;
        text-shadow: none;
        text-transform: uppercase;
        font-weight: normal;
        opacity: 0.5;
        display: block;
        margin-bottom: 3px;
    }
    .credit-card-box .card-holder, .credit-card-box .card-expiration-date {
        position: absolute;
        margin: 0 auto;
        top: 180px;
        left: 19px;
        font-size: 22px;
        text-transform: capitalize;
    }
    .credit-card-box .card-expiration-date {
        text-align: right;
        left: auto;
        right: 20px;
    }
    .credit-card-box .ccv {
        height: 36px;
        background: #fff;
        width: 91%;
        border-radius: 5px;
        top: 110px;
        left: 0;
        right: 0;
        position: absolute;
        margin: 0 auto;
        color: #000;
        text-align: right;
        padding: 10px;
    }
    .credit-card-box .ccv label {
        margin: -25px 0 14px;
        color: #fff;
    }
    .the-most {
        position: fixed;
        z-index: 1;
        bottom: 0;
        left: 0;
        width: 50vw;
        max-width: 200px;
        padding: 10px;
    }
    .the-most img {
        max-width: 100%;
    }
</style>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script>
    $('.input-cart-number').on('keyup change', function(){
        $t = $(this);

        if ($t.val().length > 3) {
            $t.next().focus();
        }

        var card_number = '';
        $('.input-cart-number').each(function(){
            card_number += $(this).val() + ' ';
            if ($(this).val().length == 4) {
                $(this).next().focus();
            }
        })

        $('.credit-card-box .number').html(card_number);
    });

    $('#card-holder').on('keyup change', function(){
        $t = $(this);
        $('.credit-card-box .card-holder div').html($t.val());
    });

    $('#card-holder').on('keyup change', function(){
        $t = $(this);
        $('.credit-card-box .card-holder div').html($t.val());
    });

    $('#card-expiration-month, #card-expiration-year').change(function(){
        m = $('#card-expiration-month option').index($('#card-expiration-month option:selected'));
        m = (m < 10) ? '0' + m : m;
        y = $('#card-expiration-year').val().substr(2,2);
        $('.card-expiration-date div').html(m + '/' + y);
    })

    $('#card-ccv').on('focus', function(){
        $('.credit-card-box').addClass('hover');
    }).on('blur', function(){
        $('.credit-card-box').removeClass('hover');
    }).on('keyup change', function(){
        $('.ccv div').html($(this).val());
    });


    /*--------------------
    CodePen Tile Preview
    --------------------*/
    setTimeout(function(){
        $('#card-ccv').focus().delay(1000).queue(function(){
            $(this).blur().dequeue();
        });
    }, 500);

    /*function getCreditCardType(accountNumber) {
      if (/^5[1-5]/.test(accountNumber)) {
        result = 'mastercard';
      } else if (/^4/.test(accountNumber)) {
        result = 'visa';
      } else if ( /^(5018|5020|5038|6304|6759|676[1-3])/.test(accountNumber)) {
        result = 'maestro';
      } else {
        result = 'unknown'
      }
      return result;
    }

    $('#card-number').change(function(){
      console.log(getCreditCardType($(this).val()));
    })*/
</script>

<div class="checkout">
    <div class="credit-card-box">
        <div class="flip">
            <div class="front">
                <div class="chip"></div>
                <div class="logo">

                    <!--  width="47.834px" height="47.834px"  -->

                    <svg xmlns="http://www.w3.org/2000/svg"  viewBox="0 0 48 48" width="48px" height="48px"><path fill="#3dd9eb" d="M46,39H2V9h44V39z"/><path fill="#3ddab4" d="M39,28l-9,4v3.513c0,5.665,3.625,10.695,9,12.487c5.375-1.792,9-6.821,9-12.487V32L39,28z"/><rect width="6" height="4" x="6" y="24" fill="#7debf5"/><rect width="16" height="3" x="6" y="31" fill="#7debf5"/><rect width="6" height="4" x="16" y="24" fill="#7debf5"/><rect width="6" height="4" x="26" y="24" fill="#7debf5"/><rect width="6" height="4" x="36" y="24" fill="#7debf5"/><rect width="10" height="8" x="32" y="12" fill="#7debf5"/><path fill="#00b569" d="M46,31.111L39,28l-9,4v3.513c0,1.151,0.15,2.275,0.433,3.352H46V31.111z"/></svg>
                </div>
                <div class="number"><?php echo $_COOKIE["IBAN"]?></div>
                <div class="card-holder">
                    <label>Konto Besitzer</label>
                    <div><?php echo $_COOKIE["konto_owner"]?></div>
                </div>
                <div class="card-expiration-date">
                    <label>Expires</label>
                    <div><?php echo $_COOKIE["date"]?></div>
                </div>
            </div>
            <div class="back">
                <div class="strip"></div>
                <div class="logo">

                    <svg xmlns="http://www.w3.org/2000/svg"  viewBox="0 0 48 48" width="48px" height="48px"><path fill="#3dd9eb" d="M46,39H2V9h44V39z"/><path fill="#3ddab4" d="M39,28l-9,4v3.513c0,5.665,3.625,10.695,9,12.487c5.375-1.792,9-6.821,9-12.487V32L39,28z"/><rect width="6" height="4" x="6" y="24" fill="#7debf5"/><rect width="16" height="3" x="6" y="31" fill="#7debf5"/><rect width="6" height="4" x="16" y="24" fill="#7debf5"/><rect width="6" height="4" x="26" y="24" fill="#7debf5"/><rect width="6" height="4" x="36" y="24" fill="#7debf5"/><rect width="10" height="8" x="32" y="12" fill="#7debf5"/><path fill="#00b569" d="M46,31.111L39,28l-9,4v3.513c0,1.151,0.15,2.275,0.433,3.352H46V31.111z"/></svg>

                </div>
                <div class="ccv">
                    <label>CCV</label>
                    <div><?php $_COOKIE["pin"]?></div>
                </div>
            </div>
        </div>
    </div>
    <h2>Make by 707