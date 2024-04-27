$(document).ready(function () {
    $("#filter-all").click(function(){
        //alert("R");
        $.ajax({
            type: "post",
            url: "FilterOne.php",
            data: {'all_btn': true},
            success: function (response) {
                $("#FilterData").html(response);
            }
        });
    });
    
});
$(document).ready(function () {
    $("#filter-pen").click(function(){
        //alert("n");
        $.ajax({
            type: "post",
            url: "FilterTwo.php",
            data: {'pen_btn': true},
            success: function (response) {
                $("#FilterData").html(response);
            }
        });
    });
    
});
$(document).ready(function () {
    $("#filter-dis").click(function(){
        //alert("m");
        $.ajax({
            type: "post",
            url: "FilterThree.php",
            data: {'dis_btn': true},
            success: function (response) {
                $("#FilterData").html(response);
            }
        });
    });
    
});
$(document).ready(function () {
    $("#filter-com").click(function(){
        //alert("p");
        $.ajax({
            type: "post",
            url: "FilterFour.php",
            data: {'com_btn': true},
            success: function (response) {
                $("#FilterData").html(response);
            }
        });
    });
    
});