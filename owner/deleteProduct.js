$(document).ready(function () {

    $('.DeleteProductButton').click(function (e) {
      e.preventDefault();
      /*console.log('hello');*/
      var pid = $(this).closest('tr').find('.pid').text();
      /*console.log(pid);*/
  
      $.ajax({
        method: "POST",
        url: "DeleteProductsButton.php",
        data: {
          'click_delete_btn': true,
          'pid': pid,
        },
        success: function (response) {
          $('.showMsg').html(response);
          $('#delete').modal('show');
  
        }
      });
    });
  });