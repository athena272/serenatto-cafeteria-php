var price = $('#price').maskMoney({
    prefix: 'R$ ',
    allowNegative: false,
    thousands: '.',
    decimal: ',',
    affixesStay: true
});

// Força a aplicação da máscara no valor atual
price.maskMoney('mask');
