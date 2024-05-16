$(document).ready(function () {
    $("#filter-all").click(function(){
        //alert("R");
        var params = new URLSearchParams(window.location.search);
    var bid = params.get('bid');
        $.ajax({
            type: "post",
            url: "FilterOne.php",
            data: {'all_btn': true,
            'bid': bid},
            success: function (response) {
                $("#FilterData").html(response);
            }
        });
    });
    
});
$(document).ready(function () {
    var params = new URLSearchParams(window.location.search);
    var bid = params.get('bid');
    $("#filter-pen").click(function(){
        //alert("n");
        $.ajax({
            type: "post",
            url: "FilterTwo.php",
            data: {'pen_btn': true,
            'bid': bid},
            success: function (response) {
                $("#FilterData").html(response);
            }
        });
    });
    
});
$(document).ready(function () {
    var params = new URLSearchParams(window.location.search);
    var bid = params.get('bid');
    $("#filter-dis").click(function(){
        //alert("m");
        $.ajax({
            type: "post",
            url: "FilterThree.php",
            data: {'dis_btn': true,
            'bid': bid},
            success: function (response) {
                $("#FilterData").html(response);
            }
        });
    });
    
});
$(document).ready(function () {
    var params = new URLSearchParams(window.location.search);
    var bid = params.get('bid');
    $("#filter-com").click(function(){
        //alert("p");
        $.ajax({
            type: "post",
            url: "FilterFour.php",
            data: {'com_btn': true,
            'bid': bid},
            success: function (response) {
                $("#FilterData").html(response);
            }
        });
    });
    
});