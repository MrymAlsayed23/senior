<?php

require('../connection.php');
require('vendor/autoload.php');
$barcode = 'Images/'.time().".png";
$barImage = time().".png";
$color = [255,0,0];
if(isset($_REQUEST['$save']) || isset($_REQUEST['$saveAnother'])){
    require('../connection.php');
    $barText = $_REQUEST['barText'];
    $db->beginTransaction();
    $stmt = $db->prepare("insert into barcode set barText='$barText', barImage='$barImage' ");
}
$generator = new Picqer\Barcode\BarcodeGeneratorPNG();
file_put_contents($barcode, $generator->getBarcode('081231723897', $generator::TYPE_CODE_128, 3, 50, $color));
echo "<center> <img src='".$barcode."'> </center>";
?>