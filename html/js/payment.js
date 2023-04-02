var card = new Card({
    form: 'form',
    container: '.card-wrapper',
    formSelectors: {
        numberInput: 'input#cardnumber',
        expiryInput: 'input#expiry',
        cvcInput: 'input#cvc',
        nameInput: 'input#name'
    },
    messages: {
        validDate: 'valid\ndate',
        monthYear: 'mm/yyyy',
    },
    placeholders: {
        number: '•••• •••• •••• ••••',
        name: 'Ad Soyad',
        expiry: 'AA/YYYY',
        cvc: '•••'
    },
    width: 370,
    masks: {
        cardNumber: '•'
    },
    debug: true
});

$('#price').keyup(function () {
    if ($('#price').val() == "") {
        $('.result').hide();
    } else {
        if ($('#price').val() != price) {
            $('.result').show();
            price = $('#price').val();
            installment = $('#installment').val();
            $('#total').html(calculatePrice(price, installment));
        }
    }
});

$("#installment").change(function () {
    $('#total').html(calculatePrice(price, $(this).val()));
});

function calculatePrice(price, installment) {
    var total = price * 1.31;
    var xyz = $('#total');
    var min = 300;
    total = precisionRound(total * 1.18, 1).toFixed(2);
    if (parseFloat(total) >= min) {
        xyz.removeClass('text-danger');
        xyz.addClass('text-success');
        $('#alert').attr('style', 'display:none');
    } else {
        $('#alert').show().attr('style', 'display:block').html('Minimum Ödeme Tutarı ' + min + ' TL dir.');
        xyz.removeClass('text-success');
        xyz.addClass('text-danger');
    }
    return "₺" + total;
}

function precisionRound(number, precision) {
    var factor = Math.pow(10, precision);
    return Math.round(number * factor) / factor;
}