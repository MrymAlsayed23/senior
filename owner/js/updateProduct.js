$(document).ready(function () {

  $('.updateProductsButton').click(function () {
    //e.preventDefault();
    // console.log('hello');
    var pid = $(this).closest('tr').find('.pid').text();
    // console.log(pid);
    $.ajax({
      method: "POST",
      url: "UpdateProducts.php",
      data: {
        'click_Update_btn': true,
        'pid': pid,
      },
      dataType: 'JSON',
      success: function (response) {
       console.log(response);
        $.each(response, function (key, value) {
        $('#mpid').val(value['pid']);
        $('#mname').val(value['pname']);
        $('#mdetails').val(value['Details']);
        $('#mprice').val(value['sellPrice']);
        $('#mqunatity').val(value['pqunatity']);
        $('#mcategory').val(value['category']);
        });
       $('#update').modal('show');

     }
    });
  });
});