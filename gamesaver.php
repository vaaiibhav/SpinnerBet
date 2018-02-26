<?php
/**
 * Created by  Vaaiibhav
 * Date: 28-Nov-17
 * Time: 3:30 PM
 */

$hoster = 'localhost';
$userer = 'vaibhav_spinner';
$passer = 'rpAXGBTn';
$dbaser = 'vaibhav_spinner';

$conn = mysqli_connect($hoster,$userer,$passer,$dbaser);
if(mysqli_connect_errno()){
    echo "Failed to connect to MySQL: " . mysqli_connect_error();
}

if($_REQUEST = $_POST) {

    $gmeid = $_POST["gmeid"];
    $uname = $_POST["uname"];
    $bet1 = $_POST["bet1"];
    $bet2 = $_POST["bet2"];
    $bet3 = $_POST["bet3"];
    $bet4 = $_POST["bet4"];
    $bet5 = $_POST["bet5"];
    $bet6 = $_POST["bet6"];
    $bet7 = $_POST["bet7"];
    $bet8 = $_POST["bet8"];
    $bet9 = $_POST["bet9"];
    $bet0 = $_POST["bet0"];


    $result=mysqli_query($conn,"INSERT INTO gamedata (gmeid,urname,bet1,bet2,bet3,bet4,bet5,bet6,bet7,bet8,bet9,bet0)
                                                VALUES ('$gmeid','$uname','$bet1','$bet2','$bet3','$bet4','$bet5','$bet6','$bet7','$bet8','$bet9','$bet0' )");

    if ($result){
        echo "datasuccess";
    }
}
?>