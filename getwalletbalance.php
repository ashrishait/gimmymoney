<?php
@$userid=$_POST['userid'];
include("include/connection.php");
$walletbalc = wallet($con,'amount',$userid);
echo number_format($walletbalc['amount'], 2); 
?>
