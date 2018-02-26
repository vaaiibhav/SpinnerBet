<?php
/**
 * Created by PhpStorm.
 * User: Vaaiibhav
 * Date: 12-Oct-17
 * Time: 12:01 PM
 */

$hoster = 'localhost';
$userer = 'vaibhav_spinner';
$passer = 'rpAXGBTn';
$dbaser = 'spingametest';

$conn = mysqli_connect($hoster,$userer,$passer,$dbaser);
if(mysqli_connect_errno()){
    echo "Failed to connect to MySQL: " . mysqli_connect_error();
}

if($_REQUEST = $_POST){


   $postFunction =  $_POST['functionMethod'];
    if($postFunction == 'getCoinRate'){
        $querry = "SELECT * FROM coinTrade";
        $result = mysqli_query($conn, $querry);

        if(mysqli_num_rows($result)>0){
            $row= mysqli_fetch_assoc($result);
            echo json_encode(array("coinbuy" =>$row["buyRate"], "coinSell" => $row["sellRate"], "coinrate" => $row["coinrate"]));
        }
    }

    if($postFunction == 'getuserCoin') {
        $userEmail=$_POST['uEmail'];
        $querry = "SELECT * FROM userinfo WHERE uEmail = '$userEmail'";
        $result = mysqli_query($conn, $querry);
        if (mysqli_num_rows($result) > 0) {

            $row = mysqli_fetch_assoc($result);
            echo json_encode(array("uEmail" => $row["uEmail"], "uPass" => $row["uPass"], "uCoin" => $row["uCoins"]));


        }
    }
    if($postFunction == 'getuserLogin') {
        $userEmail=$_POST['uEmail'];
        $userPass = $_POST['uPass'];
        $loginType = $_POST['loginType'];
        $querry = "SELECT * FROM userinfo WHERE uEmail = '$userEmail' AND uPass = '$userPass' ";
        $result = mysqli_query($conn, $querry);
        if (mysqli_num_rows($result) > 0) {

            $row = mysqli_fetch_assoc($result);
            $status =$row['ustatus'];
            if($status ='active'){
                echo 'logSuccess';
            }else{
                echo 'logFail';
            }
            //echo json_encode(array("uEmail" => $row["uEmail"], "uPass" => $row["uPass"], "uCoin" => $row["uCoins"],"uStatus" => $row["ustatus"] ));
        }
    }
    if($postFunction == 'getuserReg'){
      $userEmail=$_POST['uEmail'];
      $userPass = $_POST['uPass'];
      $uPaytm =  $_POST['uPaytm'];
      $loginType ='emaillogin';
      $querry = "INSERT INTO userinfo(uEmail, uPass, uCoins,upaytmid, ustatus,isparlour )
                VALUES('$userEmail' ,'$userPass' , 500 , '$uPaytm','active','0')";
      $result = mysqli_query($conn, $querry);
      if ($result) {
          echo 'regSuccess';
      }else{
          echo 'regFail';
      }
    }
    if($postFunction == 'getsocialLogin') {
        $userEmail=$_POST['uEmail'];

        if($_POST['ulogWith']){
        $userlogWith=$_POST['ulogWith'];}
        $querry = "SELECT * FROM userinfo WHERE uEmail = '$userEmail'  ";
        $result = mysqli_query($conn, $querry);
        if (mysqli_num_rows($result) > 0) {

            $row = mysqli_fetch_assoc($result);
            $status =$row['ustatus'];
            if($status ='active'){
                echo 'logSuccess';
            }else{
                echo 'logFail';
            }
            //echo json_encode(array("uEmail" => $row["uEmail"], "uPass" => $row["uPass"], "uCoin" => $row["uCoins"],"uStatus" => $row["ustatus"] ));
        }
    }


}

?>
