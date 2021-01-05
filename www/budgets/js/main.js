const updateValues = function(){
  if ( parseInt($('#quantity').val()) > 0 ){
    quantity = $('#quantity').val();
  }

  // update IVA value
  base_iva = $('input[name=IVA]:checked').val();

  // Subtotal
  sub_total = 0;
  sub_total = amount * quantity;
  $('#sub_total').val(sub_total.toFixed(2));

  // IVA
  iva = 0;
  iva = (sub_total * quantity) * base_iva;

  // Total
  total = 0;
  total = (sub_total + iva);
  $('#total').val(total.toFixed(2));
}

$(document).ready(function(){
    // Calculate values when the quantity for new and update bills
    $('#quantity').change(updateValues);
    $('input[name=IVA]').change(updateValues);
})
