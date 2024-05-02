$(document).ready(function () {

    $('.ShowProductsButton').click(function (e) {
      e.preventDefault();
      //console.log('hello');
      var oid = $(this).closest('tr').find('.oid').text();
      //console.log(oid);
  
      $.ajax({
        method: "POST",
        url: "ShowOrderItems.php",
        data: {
          'click_show_btn': true,
          'oid': oid,
        },
        success: function (response) {
          $('.showData').html(response);
          $('#staticBackdropShow').modal('show');
        }
      });
    });
  });