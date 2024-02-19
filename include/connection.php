<?php
$con = @mysqli_connect('localhost', 'u242272646_slctclr', 'dwIcFDi?Zj1', 'u242272646_ClRSlct');
if (!$con) {
    echo "Error: " . mysqli_connect_error();
	exit();
}
date_default_timezone_set("Asia/Calcutta"); 
function encryptor($action, $string) {
    $output = false;

    $encrypt_method = "AES-256-CBC";
    //pls set your unique hashing key
    $secret_key = 'muni';
    $secret_iv = 'muni123';

    // hash
    $key = hash('sha256', $secret_key);

    // iv - encrypt method AES-256-CBC expects 16 bytes - else you will get a warning
    $iv = substr(hash('sha256', $secret_iv), 0, 16);

    //do the encyption given text/string/number
    if( $action == 'encrypt' ) {
        $output = openssl_encrypt($string, $encrypt_method, $key, 0, $iv);
        $output = base64_encode($output);
    }
    else if( $action == 'decrypt' ){
    	//decrypt the given text/string/number
        $output = openssl_decrypt(base64_decode($string), $encrypt_method, $key, 0, $iv);
    }

    return $output;
}
function refcode() {
  $characters = '123456789';
        $charactersLength = strlen($characters);
        $randomString = '';
            for ($i = 0; $i < 5; $i++) {
                $randomString .= $characters[rand(0, $charactersLength - 1)];
            }
        return $pin=$randomString;
}
function generateOTP() {
  $characters = '123456789';
        $charactersLength = strlen($characters);
        $randomString = '';
            for ($i = 0; $i < 4; $i++) {
                $randomString .= $characters[rand(0, $charactersLength - 1)];
            }
        return $pin=$randomString;
}

function user($a,$field,$id)
{
$selectruser=mysqli_query($a,"select `$field` from `tbl_user` where `id`='".$id."'");
$userresult=mysqli_fetch_array($selectruser);
return $userresult["$field"];
	}
function wallet($a,$field,$id)
{
	$selectwallet=mysqli_query($a,"select `$field` from `tbl_wallet` where `userid`='".$id."'");
$walletResult=mysqli_fetch_array($selectwallet);
return $walletResult ?? null;
	}
function bonus($a,$field,$id)
{
	$selectwallet=mysqli_query($a,"select `$field` from `tbl_bonus` where `userid`='".$id."'");
    $walletResult=mysqli_fetch_array($selectwallet);
    return $walletResult["$field"]??null;
}	
function gameid($a)
{
$selectruser=mysqli_query($a,"select `gameid` from `tbl_gameid` order by id desc limit 1");
$userresult=mysqli_fetch_array($selectruser);
return $userresult["gameid"]??null;
	}

function content($a,$page) {
	$sql_page="select `$page` from `content` where `id`='1'";
	$query_page=mysqli_query($a,$sql_page);
	$page_result=mysqli_fetch_array($query_page);	
       return  $page_result["$page"];
} 
function minamountsetting($a,$page) {
	$sql_page="select `$page` from `tbl_paymentsetting` where `id`='1'";
	$query_page=mysqli_query($a,$sql_page);
	$page_result=mysqli_fetch_array($query_page);	
       return  $page_result["$page"];
} 
function truncate($mytext) {  
//Number of characters to show  
$chars = 610;  
$mytext = substr($mytext,0,$chars);  
$mytext = substr($mytext,0,strrpos($mytext,' '));  
return $mytext;  
}
function truncate2($mytext) {  
//Number of characters to show  
$chars = 220;  
$mytext = substr($mytext,0,$chars);  
$mytext = substr($mytext,0,strrpos($mytext,' '));  
return $mytext;  
}
function setting($a,$page) {
	$sql_page="select `$page` from `site_setting` where `id`='1'";
	$query_page=mysqli_query($a,$sql_page);
	$page_result=mysqli_fetch_array($query_page);	
       return  $page_result["$page"];
}


function winner($con,$periodid,$tab,$column)
{
$query=mysqli_query($con,"SELECT 
( SUM(amount)-SUM(amount)/100*2)as tradeamountwithtax,
 SUM(amount)as tradeamount,
    SUM(CASE
        WHEN type = 'button' THEN amount
    END) button,
    SUM(CASE
        WHEN value = 'Green' THEN amount
    END) as green,
    
    (SUM(CASE
        WHEN value = 'Green' THEN amount
    END)-(SUM(CASE
        WHEN value = 'Green' THEN amount
    END)/100*2))*2 as greenwinamount,
	
	(SUM(CASE
        WHEN value = 'Green' THEN amount
    END)-(SUM(CASE
        WHEN value = 'Green' THEN amount
    END)/100*2))*1.5 as greenwinamountwithviolet,
    
    SUM(CASE
        WHEN value = 'Violet' THEN amount
    END) violet,
    
    (SUM(CASE
        WHEN value = 'Violet' THEN amount
    END)-(SUM(CASE
        WHEN value = 'Violet' THEN amount
    END)/100*2))*4.5 as violetwinamount,
    
    SUM(CASE
        WHEN value = 'Red' THEN amount
    END) red,
    
    (SUM(CASE
        WHEN value = 'Red' THEN amount
    END)-(SUM(CASE
        WHEN value = 'Red' THEN amount
    END)/100*2))*2 as redwinamount,
	(SUM(CASE
        WHEN value = 'Red' THEN amount
    END)-(SUM(CASE
        WHEN value = 'Red' THEN amount
    END)/100*2))*1.5 as redwinamountwithviolet,
    
    SUM(CASE
        WHEN type = 'number' THEN amount
    END) number,
    SUM(CASE
        WHEN value = '0' THEN amount
    END) `zero`,
    (SUM(CASE
        WHEN value = '0' THEN amount
    END)-(SUM(CASE
        WHEN value = '0' THEN amount
    END)/100*2))*9 as zerowinamount,
    
    SUM(CASE
        WHEN value = '1' THEN amount
    END) `one`,
    (SUM(CASE
        WHEN value = '1' THEN amount
    END)-(SUM(CASE
        WHEN value = '1' THEN amount
    END)/100*2))*9 as onewinamount,
    
    SUM(CASE
        WHEN value = '2' THEN amount
    END) `two`,
    (SUM(CASE
        WHEN value = '2' THEN amount
    END)-(SUM(CASE
        WHEN value = '2' THEN amount
    END)/100*2))*9 as twowinamount,
    
    SUM(CASE
        WHEN value = '3' THEN amount
    END) `three`,
    (SUM(CASE
        WHEN value = '3' THEN amount
    END)-(SUM(CASE
        WHEN value = '3' THEN amount
    END)/100*2))*9 as threewinamount,
    
    SUM(CASE
        WHEN value = '4' THEN amount
    END) `four`,
    (SUM(CASE
        WHEN value = '4' THEN amount
    END)-(SUM(CASE
        WHEN value = '4' THEN amount
    END)/100*2))*9 as fourwinamount,
    
    SUM(CASE
        WHEN value = '5' THEN amount
    END) `five`,
    (SUM(CASE
        WHEN value = '5' THEN amount
    END)-(SUM(CASE
        WHEN value = '5' THEN amount
    END)/100*2))*9 as fivewinamount,
    
    SUM(CASE
        WHEN value = '6' THEN amount
    END) `six`,
    (SUM(CASE
        WHEN value = '6' THEN amount
    END)-(SUM(CASE
        WHEN value = '6' THEN amount
    END)/100*2))*9 as sixwinamount,
    
    SUM(CASE
        WHEN value = '7' THEN amount
    END) `seven`,
    (SUM(CASE
        WHEN value = '7' THEN amount
    END)-(SUM(CASE
        WHEN value = '7' THEN amount
    END)/100*2))*9 as sevenwinamount,
    
    SUM(CASE
        WHEN value = '8' THEN amount
    END) `eight`,
    (SUM(CASE
        WHEN value = '8' THEN amount
    END)-(SUM(CASE
        WHEN value = '8' THEN amount
    END)/100*2))*9 as eightwinamount,
    
    SUM(CASE
        WHEN value = '9' THEN amount
    END) `nine`,
    (SUM(CASE
        WHEN value = '9' THEN amount
    END)-(SUM(CASE
        WHEN value = '9' THEN amount
    END)/100*2))*9 as ninewinamount
	    
FROM
    `tbl_betting` where `periodid`='$periodid' and `tab`='$tab'");
$result=mysqli_fetch_array($query);	
return $result["$column"];
	
	}
$numbermappings = array("zero", "one","two","three", "four","five","six","seven","eight","nine");

function userpromocode($a,$userid,$code,$tradeamount,$periodid)
{
$today = date("Y-m-d H:i:s");
$commissionQuery=mysqli_query($a,"select * from `tbl_paymentsetting` where `id`='1'");
$commissionResult=mysqli_fetch_array($commissionQuery);
$level1commission=$commissionResult['level1'];
$level2commission=$commissionResult['level2'];
$level3commission=$commissionResult['level3'];
$level4commission=$commissionResult['level4'];
$level5commission=$commissionResult['level5'];

$level1=($tradeamount*$level1commission/100);
$level2=($tradeamount*$level2commission/100);
$level3=($tradeamount*$level3commission/100);
$level4=($tradeamount*$level4commission/100);
$level5=($tradeamount*$level5commission/100);

$userlevel1Query=mysqli_query($a,"select `code`,(select `id` from `tbl_user` where `owncode`='$code')level1id,(select `code` from `tbl_user` where `owncode`='$code')level1code from `tbl_user` where `id`='".$userid."'");
$userlevel1Result=mysqli_fetch_array($userlevel1Query);	
$level1id=$userlevel1Result['level1id'];
$level1code=$userlevel1Result['level1code'];
//===============================================================================================


$userlevel2Query=mysqli_query($a,"select `code`,(select `id` from `tbl_user` where `owncode`='$level1code')level2id,(select `code` from `tbl_user` where `owncode`='$level1code')level2code from `tbl_user` where `id`='".$level1id."'");
$userlevel2Result=mysqli_fetch_array($userlevel2Query); 
$level2id=$userlevel2Result['level2id']??null;
$level2code=$userlevel2Result['level2code']??null;
//===============================================================================================


$userlevel3Query=mysqli_query($a,"select `code`,(select `id` from `tbl_user` where `owncode`='$level2code')level3id,(select `code` from `tbl_user` where `owncode`='$level2code')level3code from `tbl_user` where `id`='".$level2id."'");
$userlevel3Result=mysqli_fetch_array($userlevel3Query); 
$level3id=$userlevel3Result['level3id']??null;
$level3code=$userlevel3Result['level3code']??null;
//===============================================================================================


$userlevel4Query=mysqli_query($a,"select `code`,(select `id` from `tbl_user` where `owncode`='$level3code')level3id,(select `code` from `tbl_user` where `owncode`='$level3code')level3code from `tbl_user` where `id`='".$level3id."'");
$userlevel4Result=mysqli_fetch_array($userlevel4Query); 
$level4id=$userlevel4Result['level4id']??null;
$level4code=$userlevel4Result['level4code']??null;
//===============================================================================================


$userlevel5Query=mysqli_query($a,"select `id` from `tbl_user` where `owncode`='".$level4code."'");
$userlevel5Result=mysqli_fetch_array($userlevel5Query);	
$level5id=$userlevel5Result['id']??null;
//=================================================================================================


$sql= mysqli_query($a,"INSERT INTO `tbl_bonussummery`(`userid`,`periodid`,`level1id`,`level2id`,`level3id`,`level4id`,`level5id`,`level1amount`,`level2amount`,`level3amount`,`level4amount`,`level5amount`,`tradeamount`,`createdate`) VALUES ('".$userid."','".$periodid."','".$level1id."','".$level2id."','".$level3id."','".$level4id."','".$level5id."','".$level1."','".$level2."','".$level3."','".$level4."','".$level5."','".$tradeamount."','".$today."')");
$level1balance=bonus($a,'level1',$level1id);
$finallevel1balance=$level1balance+$level1;
$bonusbalance1=bonus($a,'amount',$level1id);
$finalbonusbalance1=$bonusbalance1+$level1;

$level2balance=bonus($a,'level2',$level2id);
$finallevel2balance=$level2balance+$level2;
$bonusbalance2=bonus($a,'amount',$level2id);
$finalbonusbalance2=$bonusbalance2+$level2;

$level3balance=bonus($a,'level3',$level3id);
$finallevel3balance=$level3balance+$level3;
$bonusbalance3=bonus($a,'amount',$level3id);
$finalbonusbalance3=$bonusbalance3+$level3;

$level4balance=bonus($a,'level4',$level4id);
$finallevel4balance=$level4balance+$level4;
$bonusbalance4=bonus($a,'amount',$level4id);
$finalbonusbalance4=$bonusbalance4+$level4;


$level5balance=bonus($a,'level5',$level5id);
$finallevel5balance=$level5balance+$level5;
$bonusbalance5=bonus($a,'amount',$level5id);
$finalbonusbalance5=$bonusbalance5+$level5;


$sqlbonuslevel1= mysqli_query($a,"UPDATE `tbl_bonus` SET `amount` = '".$finalbonusbalance1."',`level1` = '".$finallevel1balance."' WHERE `userid`= '".$level1id."'");

$sqlbonuslevel2= mysqli_query($a,"UPDATE `tbl_bonus` SET `amount` = '".$finalbonusbalance2."',`level2` = '".$finallevel2balance."' WHERE `userid`= '".$level2id."'");	

$sqlbonuslevel3= mysqli_query($a,"UPDATE `tbl_bonus` SET `amount` = '".$finalbonusbalance3."',`level3` = '".$finallevel3balance."' WHERE `userid`= '".$level3id."'");

$sqlbonuslevel4= mysqli_query($a,"UPDATE `tbl_bonus` SET `amount` = '".$finalbonusbalance4."',`level4` = '".$finallevel4balance."' WHERE `userid`= '".$level4id."'");

$sqlbonuslevel5= mysqli_query($a,"UPDATE `tbl_bonus` SET `amount` = '".$finalbonusbalance5."',`level5` = '".$finallevel5balance."' WHERE `userid`= '".$level5id."'");
	
	}
function invitebonus($a,$userid,$refcode)
{
 $chksummery=mysqli_query($a,"select * from `tbl_walletsummery` where `userid`='$userid' and `actiontype`='recharge'");   
 $chksummeryRow=mysqli_num_rows($chksummery);   
  if($chksummeryRow=='1')
  {
   $userQuery=mysqli_query($a,"select `id` from `tbl_user` where `owncode`='$refcode'"); 
   $userResult=mysqli_fetch_array($userQuery);
    $refuserid=$userResult['id'];
    $selectwallet=mysqli_query($a,"select `amount` from `tbl_bonus` where `userid`='".$refuserid."'");
$walletResult=mysqli_fetch_array($selectwallet);
$availableBalance=$walletResult['amount'];

$sqlbonus=mysqli_query($con,"select `bonusamount` from `tbl_paymentsetting` where `id`='1'");
$bonusResult=mysqli_fetch_array($sqlbonus);
$bonusAmount=$bonusResult['bonusamount'];
$finalbonusbalance=$availableBalance+$bonusAmount;
$today = date("Y-m-d H:i:s");

$sqlbonuslevel1= mysqli_query($a,"UPDATE `tbl_bonus` SET `amount` = '".$finalbonusbalance."',`level1` = '".$finalbonusbalance."' WHERE `userid`= '".$refuserid."'");
$sql= mysqli_query($a,"INSERT INTO `tbl_bonussummery`(`userid`,`periodid`,`level1id`,`level2id`,`level1amount`,`level2amount`,`tradeamount`,`createdate`) VALUES ('".$userid."','0','".$refuserid."','0','110','0','0','".$today."')");
  }
}

function getBaseUrl() 
{
	// output: /myproject/index.php
	$currentPath = $_SERVER['PHP_SELF']; 
	
	// output: Array ( [dirname] => /myproject [basename] => index.php [extension] => php [filename] => index ) 
	$pathInfo = pathinfo($currentPath); 
	
	// output: localhost
	$hostName = $_SERVER['HTTP_HOST']; 
	
	// output: http://
	$protocol = strtolower(substr($_SERVER["SERVER_PROTOCOL"],0,5))=='https://'?'https://':'http://';
	
	// return: http://localhost/myproject/
	return $protocol.$hostName.$pathInfo['dirname'].'/';
} 
?>

<!--Start of Tawk.to Script-->
<script type="text/javascript">
var Tawk_API=Tawk_API||{}, Tawk_LoadStart=new Date();
(function(){
var s1=document.createElement("script"),s0=document.getElementsByTagName("script")[0];
s1.async=true;
s1.src='https://embed.tawk.to/65d33ece9131ed19d96e91cd/1hn0iqmlr';
s1.charset='UTF-8';
s1.setAttribute('crossorigin','*');
s0.parentNode.insertBefore(s1,s0);
})();
</script>
<!--End of Tawk.to Script-->