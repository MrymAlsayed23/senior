$(document).ready(function () {

    $('.ShowMessageModal').click(function (e) {
      e.preventDefault();
      /*console.log('hello');*/
      var uid = $(this).closest('tr').find('.uid').text();
      /*console.log(pid);*/
  
      $.ajax({
        method: "POST",
        url: "messageModal.php",
        data: {
          'click_show_btn': true,
          'uid': uid,
        },
        success: function (response) {
          $('#staticBackdropShow').modal('show');
        }
      });
    });
  });