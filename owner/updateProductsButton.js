$(document).ready(function(){

    $('.updateProductsButton').click(function(e){
        e.preventDefault();
       /*console.log('hello');*/
      var pid =  $(this).closest('tr').find('.pid').text();
      /*console.log(pid);*/

      $.ajax({
        method: "POST",
        url: "updateProductsButton.php",
        data: "data",
        dataType: "dataType",
        success: function (response) {
            
        }
      });
    });
});