$(document).ready(function () {

  $('.updateProductsButton').click(function (e) {
    e.preventDefault();
    /*console.log('hello');*/
    var pid = $(this).closest('tr').find('.pid').text();
    /*console.log(pid);*/

    $.ajax({
      method: "POST",
      url: "UpdateProductsButton.php",
      data: {
        'click_Update_btn': true,
        'pid': pid,
      },
      success: function (response) {
        /*console.log(response);*/
        $.each(response, function (key, value) {
          $('#pid').val(value['pid']);
          $('#name').val(value['pname']);
          $('#brand').val(value['BrandName']);
          $('#details').val(value['Details']);
          $('#price').val(value['SellPrice']);
          $('#qunatity').val(value['pqunatity']);
          $('#category').val(value['category']);

        });
        $('#staticBackdropUpdate').modal('show');

      }
    });
  });
});