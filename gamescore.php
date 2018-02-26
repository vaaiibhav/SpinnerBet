<?php
/**
 * Created by  Vaaiibhav
 * Date: 22-Dec-17
 * Time: 12:19 PM
 */

$hoster = 'localhost';
$userer = 'vaibhav_spinner';
$passer = 'rpAXGBTn';
$dbaser = 'spingametest';

$conn = mysqli_connect($hoster,$userer,$passer,$dbaser);
if(mysqli_connect_errno()){
    echo "Failed to connect to MySQL: " . mysqli_connect_error();
}

if($_REQUEST = $_POST) {
  $bet1=0;
  $bet2 =0;
  $bet3=0 ;
  $bet4=0;
  $bet5= 0;
  $bet6=0;
   $bet7=0;
   $bet8=0;
   $bet9=0 ;
     $bet0 =0;

    $gmeid = $_POST["gmeid"];
    $querry = "SELECT SUM(bet1),SUM(bet2), SUM(bet3),SUM(bet4),SUM(bet5), SUM(bet6), SUM(bet7),
    SUM(bet8), SUM(bet9), SUM(bet0)  FROM gamedata WHERE gmeid = '$gmeid'  ";
    $result = mysqli_query($conn, $querry);
    while ($row = $result->fetch_assoc()){


        $bet1 =$row['SUM(bet1)'];

        $bet2 += $row['SUM(bet2)'];
        $bet3 += $row['SUM(bet3)'];
        $bet4 += $row['SUM(bet4)'];
        $bet5 += $row['SUM(bet5)'];
        $bet6 += $row['SUM(bet6)'];
        $bet7 += $row['SUM(bet7)'];
        $bet8 += $row['SUM(bet8)'];
        $bet9 += $row['SUM(bet9)'];
        $bet0 += $row['SUM(bet0)'];



    }
      // echo 'bet1:'.$bet1.":";
      // echo 'bet2'.$bet2.":";
      // echo 'bet3'.$bet3.":";
      // echo 'bet4'.$bet4.":";
      // echo 'bet5'.$bet5.":";
      // echo 'bet6'.$bet6.":";
      // echo 'bet7'.$bet7.":";
      // echo 'bet8'.$bet8.":";
      // echo 'bet9'.$bet9.":";
      // echo 'bet0'.$bet0.":";

    $a = array($bet0,$bet1,$bet2,$bet3,$bet4,$bet5,$bet6, $bet7, $bet8, $bet9);
     $print_key =(array_keys($a, min($a)));// array_search(min($a),$a);   print_r(array_keys($a, min($a)));
      print ($print_key[0]);
      
            $querry = ("INSERT INTO winningtbl (gmeid , winningno) VALUES ('$gmeid','$winningno')");
          $result = mysqli_query($conn, $querry);

    // print_r ($key_min);
}
