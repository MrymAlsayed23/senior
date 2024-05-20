$(document).ready(function () {
    $("#date1").on("change", function(){
        var input1 = $(this).val();
        alert(input1);
        /*$.ajax({
            method: "POST",
            url: "FilterOrdersByDate.php",
            data: {'input_btn': true,
                  input1: input1},
            success: function (response) {
                $("#FilterData").html(response);
            }
        });*/
    });
    
});