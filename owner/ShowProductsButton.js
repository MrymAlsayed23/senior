$(document).ready(function(){

    $('.ShowProductsButton').click(function(e){
        e.preventDefault();
       /*console.log('hello');*/
      var pid =  $(this).closest('tr').find('.pid').text();
      /*console.log(pid);*/

      $.ajax({
        method: "POST",
        url: "ShowProductsButton.php",
        data: {
            'click_show_btn': true,
             'pid' : pid,
        },
        success: function (response) {
               $('.showProducts').html(response);
               $('#staticBackdropShow').modal('show');
            
        }
      });
    });
});