$(document).ready(function () {

    $('.DeleteProductButton').click(function (e) {
      e.preventDefault();
      /*console.log('hello');*/
      var pid = $(this).closest('tr').find('.pid').text();
      var params = new URLSearchParams(window.location.search);
    var bid = params.get('bid');
      console.log(bid);
  
      $.ajax({
        method: "POST",
        url: "DeleteProductsButton.php",
        data: {
          'click_delete_btn': true,
          'pid': pid,
          'bid' :bid,
        },
        success: function (response) {
          $('.showMsg').html(response);
          $('#delete').modal('show');
  
        }
      });
    });
  });