$(document).ready(function () {

  $('.updateProductsButton').click(function (e) {
    e.preventDefault();
    // console.log('hello');
    //Find hidden element by id taht starts with pid
    var pid = $(this).closest('tr').find('[id^="pid"]').val();
    // console.log(pid);
    var formData = new FormData();
    formData.append('click_Update_btn', 'true');
    formData.append('pid', pid.toString());
    $.ajax({
      method: "POST",
      url: "UpdateProducts.php",
      data: formData,
      processData: false,
      contentType: false,
      success: function (response) {
       console.log(response);
        $.each(response, function (key, value) {
        $('#mpid').val(value['pid']);
        $('#mname').val(value['pname']);
        $('#mdetails').val(value['Details']);
        $('#mprice').val(value['sellPrice']);
        $('#mqunatity').val(value['pquantity']);
        $('#mcategory').val(value['category']);
        });
       $('#update').modal('show');
     },
     error: function(XMLHttpRequest, textStatus, errorThrown) {
      console.log(errorThrown);
     }
    });
  });
});