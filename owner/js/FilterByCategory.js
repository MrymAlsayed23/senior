$(document).ready(function () {
    $("#FilterByCategory").on("change", function(){
        var value = $(this).val();
        //alert(value);
        $.ajax({
            method: "POST",
            url: "FilterByCategory.php",
            data: {value: value},
            success: function (response) {
                $("#showData").html(response);
            }
        });
    });
});