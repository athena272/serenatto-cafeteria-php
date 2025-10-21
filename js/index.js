var preco = $('#preco').maskMoney()
var price = $('#price').maskMoney({
    prefix: 'R$ ',
    allowNegative: false,
    thousands: '.',
    decimal: ',',
    affixesStay: true
});