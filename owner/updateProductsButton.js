$(document).ready(function(){

  $('.updateProductsButton').click(function(e){
      e.preventDefault();
     /*console.log('hello');*/
    var pid =  $(this).closest('tr').find('.pid').val();
    /*console.log(pid);*/

    $.ajax({
      method: "POST",
      url: "UpdateProductsButton.php",
      data: {
          'click_Update_btn': true,
           'pid' : pid,
      },
      success: function (response) {
        console.log(response);
        $.each(response, function (key, value) { 
          $('#name').val(value['name']);
          $('#brand').val(value['brand']);
          $('#details').val(value['details']);
          $('#price').val(value['price']);
          $('#qunatity').val(value['qunatity']);
          $('#category').val(value['category']);
           
        });
            /*$('#staticBackdropUpdate').modal('show');*/
          
      }
    });
  });
});