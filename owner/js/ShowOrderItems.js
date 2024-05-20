$(document).ready(function () {

    $('.ShowProductsButton').click(function (e) {
      e.preventDefault();
      var params = new URLSearchParams(window.location.search);
    var bid = params.get('bid');
      //console.log('hello');
      var oid = $(this).closest('tr').find('.oid').text();
      //console.log(oid);
  
      $.ajax({
        method: "POST",
        url: "ShowOrderItems.php",
        data: {
          'click_show_btn': true,
          'oid': oid,
          'bid': bid
        },
        success: function (response) {
          $('.showData').html(response);
          $('#staticBackdropShow').modal('show');
        }
      });
    });
  });