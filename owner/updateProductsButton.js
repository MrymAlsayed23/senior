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
            /*$('#staticBackdropUpdate').modal('show');*/
          
      }
    });
  });
});