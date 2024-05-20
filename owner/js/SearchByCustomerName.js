$(document).ready(function () {
    $("#live_search").on("keyup",function () { 
        var input = $(this).val();
        //alert(input);
            $.ajax({
                method: "POST",
                url: "SearchByCustomerName.php",
                data: {input:input},
                success: function (response) {
                    $("#showData").html(response); 
                }
            });
    });    
});