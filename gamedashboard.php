<?php 
   ob_start();
   session_start();
   if($_SESSION['frontuserid']=="")
   {header("location:login.php");exit();}?>
<!doctype html>
<html lang="en">
   <head>
      <meta charset="utf-8" />
      <meta http-equiv="X-UA-Compatible" content="IE=edge">
      <?php include 'head.php';?>
      <link rel="stylesheet" href="assets/css/style.css">
      <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet"/>
      <link href="assets/css/dataTables.bootstrap.min.css" rel="stylesheet"/>
      <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0">
      <style>
         .btn {
         border-radius: 10px 10px 10px 10px;
         border: 2px solid white;
         transition: 0.5s;
         }
         .appHeader1 {
         background-color: #fff !important;
         border-color: #fff !important;
         }
         .appContent3 {
         background-color: #2196f3 !important;
         border-color: #2196f3 !important;
         padding:10px;
         border-radius:3px;
         font-size:16px;
         }
         .user-block img {
         width: 40px;
         height: 40px;
         float: left;
         margin-right:10px;
         background:#333;
         }
         .img-circle {
         border-radius: 50%;
         }
         .reaload {
         box-shadow:none;
         }
         .ion-md-refresh {
         font-size:30px !important;
         }
         .responsive {
         height:300px;
         overflow-x: auto;
         }
         .vcard {
         box-shadow:none;
         }
         h5{ color:#888; font-size:20px; font-weight:normal;}
         h5 span{ color:#333; font-size:20px;}
         .divsize4 .btn{padding: 0 10px; width:100px;}
         .left-addon input {
         padding-left: 20px;
         }
         .error {
         top: 45px;
         }
         .containerrecord{border-bottom: solid 2px #565EFF;}
         .recordlink{
         font-size: 30px;
         color: #333;
         border-bottom: solid 2px #565EFF ;
         }
         .recordlink .title{font-size: 14px;
         font-weight: 500;}
         #alert h4{font-size: 1rem;}
         #alert p{font-size: 13px; margin-top:30px;}
         #alert .modal-content{border-radius:3px}
         #alert .modal-dialog{padding:30px; margin-top:200px;}
         #payment .modal-dialog{padding:10px;margin-top:60px;}
         #loader .modal-dialog{padding:30px; margin-top:200px;}
         .btn-lg {
         height: 42px;
         padding: 0px 24px;
         font-size: 15px;
         }
         .vg{
         background: linear-gradient(137.11deg, #7400AB -9.13%, #7400AB 49.79%, #1DCC70 49.8%, #1DCC70 107.5%) !important;
         }
         .rv{
         background: linear-gradient(137.11deg, #7400AB -9.13%, #7400AB 49.79%, #ff2d55 49.8%, #ff2d55 107.5%) !important;
         }
         .btn-blue{
         background-color:#2196f3;
         }
         .btn {
         border-radius: 3px 3px 3px 3px; 
         border: 0px solid white;
         transition: 0.5s;
         color:#d9d5db;
         }
         .btn-blue{
         background-color:#2196f3;
         color:#d9d5db;
         }
         .center_notes[data-v-5f666fee] {
         width: 101%;
         display: flex;
         flex-direction: row;
         flex-wrap: wrap;
         padding: 0 8px;
         box-sizing: border-box;
         }
      </style>
   </head>
   <body>
      <?php
         include("include/connection.php");
         $userid=$_SESSION['frontuserid'];
         $selectruser=mysqli_query($con,"select * from `tbl_user` where `id`='".$userid."'");
         $userresult=mysqli_fetch_array($selectruser);
         $selectwallet=mysqli_query($con,"select * from `tbl_wallet` where `userid`='".$userid."'");
         $walletResult=mysqli_fetch_array($selectwallet);
      ?>
      <!-- Page loading -->
      <!-- App Header -->
      <div class="vcard" >
         <!-- <div class="appContent3 text-white" style="background-color:#00A36C !important"> -->
         <div class="appContent3 text-white" style="background: #009688 !important">
            <div class="row">
               <div class="col-12">
                  <?php $walletamt =  wallet($con,'amount',$userid); 
                     // print_r($walletamt);
                     // $numericFormatted = number_format($walletamt[0], 2);
                     // echo "Numeric Index: $numericFormatted\n";
                     
                     // $associativeFormatted = number_format($walletamt['amount'], 2);
                     // echo "Associative Index: $associativeFormatted\n";
                     ?>
                  <div class="col-12 mb-1" style="font-size:18px;">Available balance: ₹ <span id="balance"><?php echo number_format($walletamt['amount'], 2); ?></span></div>
                  <div class="col-12">
                     <div> <a href="recharge.php" class="btn btn-blue btn-blue m-0">Recharge</a> <a  data-toggle="modal" href="#rule" data-backdrop="static" data-keyboard="false" class="btn btn-blue btn-blue" style="background-color:#f5f5f5 !important ; color: black;">Read Rule</a> <a href="javascript:void(0);" onClick="reloadbtn(<?php echo $userid;?>);" class="reaload text-white pull-right mt-1" onclick="getResultbyCategory(parity,parity)"> <i class="icon ion-md-refresh"></i></a> </div>
                  </div>
               </div>
            </div>
         </div>
      </div>
      <!-- searchBox --> 
      <!-- * searchBox --> 
      <!-- * App Header --> 
      <!-- App Capsule -->
      <div class="mb-5">
         <div class="long mb-3">
            <!-- listview -->
            <ul class="nav nav-tabs size4" id="myTab3" role="tablist" style="justify-content: space-evenly !important;">
               <li class="nav-item">
                  <a class="nav-link" id="home-tab3" data-toggle="tab" href="#parity" role="tab" onClick="tabname('parity');getResultbyCategory('parity','parity');">Parity</a> 
                          </li>
               <li class="nav-item"> 
                  <a class="nav-link active" id="profile-tab3" data-toggle="tab" href="#sapre" role="tab" onClick="tabname('sapre');getResultbyCategory('sapre','sapre');">Sapre</a>
               </li>
               <li class="nav-item"> 
                  <a class="nav-link" id="contact-tab3" data-toggle="tab" href="#bcone" role="tab" onClick="tabname('bcone');getResultbyCategory('bcone','bcone');">Bcone</a> 
               </li>
               <li class="nav-item"> 
                  <a class="nav-link" id="contact-tab3" data-toggle="tab" href="#emerd" role="tab" onClick="tabname('emerd');getResultbyCategory('emerd','emerd');">Emerd</a> 
               </li>
            </ul>
            <!--=====================game area============================-->
            <div class="appContent1 bg-light mt-n1">
               <div class="layout">
                  <div class="gameidtimer">
                     <h5 class="mb-2"><i class="icon ion-md-trophy"></i> Period</h5>
                     <h5>
                        <span class="showload">
                           <div class="spinnner-border text-danger" role="status">
                           </div>
                        </span>
                        <span id="gameid" class="none"><?php echo sprintf("%03d",gameid($con));?></span>
                        <!-- date('dmY').sprintf("%03d",1) -->
                        <input type="hidden" id="futureid" name="futureid" value="<?php echo sprintf("%03d",gameid($con));?>">
                     </h5>
                  </div>
                  <div class="gameidtimer text-right">
                     <h5 class="mb-2">Count Down</h5>
                     <h5 id="demo"></h5>
                  </div>
               </div>
               <!-- 
                  <div class="bg-light  layout text-center mt-2">
                  <div class="divsize4">
                  <button type="button"  class="btn btn-lg btn-success gbutton none" onClick="betbutton('#1DCC70','button','Green');" style="float:left;">Join Green</button>
                  </div>
                  <div class="divsize4">
                  <button type="button" class="btn btn-lg btn-violet gbutton none" onClick="betbutton('#9c27b0','button','Violet');">Join Violet</button>
                  </div>
                  <div class="divsize4">
                  <button type="button" class="btn btn-lg btn-danger gbutton none" onClick="betbutton('#ff2d55','button','Red');" style="float:right;background-color: red;">Join Red</button>
                  </div>
                  </div> -->
               <!--  <div class="container-fluid">
                  <div class="layout text-center bg-light d-flex justify-content-center    col-xl-12 col-md-12 col-sm-12">
                  <div class="col-sm-2">
                  <button type="button" class="btn btn-lg gbutton none btn-blue" onClick="betbutton('#18FFFF','button','0');" style="background: linear-gradient(to right bottom, rgb(156, 39, 176) 50%, rgb(244, 67, 54) 50%); ">0</button>
                  </div>
                  <div class="col-sm-2">
                  <button type="numbutton" class="btn btn-lg btn-blue gbutton none" onClick="betbutton('#18FFFF','button','1');" style="background-color:green;">1</button>
                  </div>
                  
                  <div class="col-sm-2">
                  <button type="button" class="btn btn-lg btn-blue gbutton none" onClick="betbutton('#18FFFF','button','2');" style="background-color:red;">2</button>
                  </div>
                  
                  <div class="col-sm-2">
                  <button type="button" class="btn btn-lg btn-blue gbutton none" onClick="betbutton('#18FFFF','button','3');" style="background-color:green;">3</button>
                  </div>
                  
                  <div class="col-sm-2">
                  <button type="button" class="btn btn-lg btn-blue gbutton none" onClick="betbutton('#18FFFF','button','4');" style="background-color:red;">4</button>
                  </div>
                  </div>
                  <div class="layout   text-center bg-light  justify-content-center    col-xl-12 col-md-12 col-sm-12">
                  
                  <div class="col-sm-2">
                  <button type="button" class="btn btn-lg btn-blue gbutton none" onClick="betbutton('#18FFFF','button','5');"  style="background: linear-gradient(to right bottom, rgb(156, 39, 176) 50%, rgb(76, 175, 80) 50%); ">5 </button>
                  </div>
                  
                  <div class="col-sm-2">
                  <button type="button" class="btn btn-lg btn-blue gbutton none" onClick="betbutton('#18FFFF','button','6');" style="background-color:red;"> 6</button>
                  </div>
                  
                  <div class="col-sm-2">
                  <button type="button" class="btn btn-lg btn-blue gbutton none" onClick="betbutton('#18FFFF','button','7');" style="background-color:green;">7 </button>
                  </div>
                  <div class="col-sm-2">
                  <button type="button" class="btn btn-lg btn-blue gbutton none" onClick="betbutton('#18FFFF','button','8');" style="background-color:red;"> 8</button>
                  </div>
                  <div class="col-sm-2">
                  <button type="button" class="btn btn-lg btn-blue gbutton none" onClick="betbutton('#18FFFF','button','9');" style="background-color:green;">9 </button>
                  </div>
                  </div>
                  </div> -->
               <div class="bg-light  layout text-center mt-2">
                  <div class="divsize4">
                     <button type="button"  class="btn btn-lg btn-success gbutton none" onClick="betbutton('#1DCC70','button','Green');" >Join Green</button>
                  </div>
                  <div class="divsize4">
                     <button type="button" class="btn btn-lg btn-violet gbutton none" onClick="betbutton('#9c27b0','button','Violet');">Join Violet</button>
                  </div>
                  <div class="divsize4">
                     <button type="button" class="btn btn-lg btn-danger gbutton none" onClick="betbutton('#ff2d55','button','Red');" style="background-color: red;">Join Red</button>
                  </div>
               </div>
               <div cla="container-fluid  ">
                  <div class="layout text-center bg-light  d-flex justify-content-center">
                     <div class="divsize2">
                        <button type="button" class="btn btn-lg gbutton none btn-blue" onClick="betbutton('#18FFFF','button','0');" style="background: linear-gradient(to right bottom, rgb(156, 39, 176) 50%, rgb(244, 67, 54) 50%); ">0</button>
                     </div>
                     <div class="divsize2">
                        <button type="numbutton" class="btn btn-lg btn-blue gbutton none" onClick="betbutton('#18FFFF','button','1');" style="background-color:green;">1</button>
                     </div>
                     <div class="divsize2">
                        <button type="button" class="btn btn-lg btn-blue gbutton none" onClick="betbutton('#18FFFF','button','2');" style="background-color:red;">2</button>
                     </div>
                     <div class="divsize2">
                        <button type="button" class="btn btn-lg btn-blue gbutton none" onClick="betbutton('#18FFFF','button','3');" style="background-color:green;">3</button>
                     </div>
                     <div class="divsize2">
                        <button type="button" class="btn btn-lg btn-blue gbutton none" onClick="betbutton('#18FFFF','button','4');" style="background-color:red;">4</button>
                     </div>
                  </div>
                  <div class="layout text-center bg-light d-flex justify-content-center">
                     <div class="divsize2">
                        <button type="button" class="btn btn-lg btn-blue gbutton none" onClick="betbutton('#18FFFF','button','5');" style="background: linear-gradient(to right bottom, rgb(156, 39, 176) 50%, rgb(76, 175, 80) 50%); ">5 </button>
                     </div>
                     <div class="divsize2">
                        <button type="button" class="btn btn-lg btn-blue gbutton none" onClick="betbutton('#18FFFF','button','6');" style="background-color:red;"> 6</button>
                     </div>
                     <div class="divsize2">
                        <button type="button" class="btn btn-lg btn-blue gbutton none" onClick="betbutton('#18FFFF','button','7');" style="background-color:green;">7 </button>
                     </div>
                     <div class="divsize2">
                        <button type="button" class="btn btn-lg btn-blue gbutton none" onClick="betbutton('#18FFFF','button','8');" style="background-color:red;"> 8</button>
                     </div>
                     <div class="divsize2">
                        <button type="button" class="btn btn-lg btn-blue gbutton none" onClick="betbutton('#18FFFF','button','9');" style="background-color:green;">9 </button>
                     </div>
                  </div>
               </div>
               <div class="bg-light layout text-center mt-2">
                  <div class="divsize4 mx-auto">
                     <button type="button"  class="btn btn-lg btn-success gbutton none" onClick="betbutton('#1DCC70','button','Big');" >Big</button>
                  </div>
                  <div class="divsize4 mx-auto">
                     <button type="button" class="btn btn-lg btn-violet gbutton none" onClick="betbutton('#9c27b0','button','Small');">Small</button>
                  </div>
               </div>
            </div>
            <!-- =====================game area end============================ -->
            <div class="mt-1 pb-5">
               <div class="tab-content" id="myTabContent">
                  <!--=========================tab-1========================================-->
                  <div class="tab-pane fade" id="parity" role="tabpanel"></div>
                  <!--=========================tab-1 end========================================-->
                  <!--=========================tab-2========================================-->
                  <div class="tab-pane fade active show" id="sapre" role="tabpanel"></div>
                  <!--=========================tab-2 end========================================-->
                  <!--=========================tab-3========================================-->
                  <div class="tab-pane fade" id="bcone" role="tabpanel"></div>
                  <!--=========================tab-3 end========================================-->
                  <!--=========================tab-4========================================-->
                  <div class="tab-pane fade" id="emerd" role="tabpanel"></div>
                  <!--=========================tab-4 end========================================-->
               </div>
            </div>
         </div>
      </div>
      <!-- appCapsule -->
      <?php include("include/footer.php");?>
      <div id="rule" class="modal fade" role="dialog">
         <div class="modal-dialog" role="document">
            <div class="modal-content ">
               <div class="modal-header"> </div>
               <div class="modal-body responsive"> <?php echo content($con,"rule");?> </div>
               <div class="modal-footer"> 
                  <a type="button" class="pull-left" data-dismiss="modal"><strong>CLOSE</strong></a> 
               </div>
            </div>
         </div>
      </div>
      <div id="payment" class="modal fade" role="dialog">
         <div class="modal-dialog" role="document">
            <div class="modal-content ">
               <div class="modal-header paymentheader" id="paymenttitle">
                  <h4 class="modal-title" id="chn"></h4>
               </div>
               <form action="#" method="post" id="bettingForm" autocomplete="off">
                  <div class="modal-body mt-1" id="loadform">
                     <div class="row">
                        <div class="col-12">
                           <p class="mb-1">Contract Money</p>
                           <div class="btn-group btn-group-toggle mb-2" data-toggle="buttons">
                              <label class="btn btn-secondary active" onClick="contract(10);">
                              <input class="contract" type="radio" name="contract" id="hoursofoperation" value="10" checked >
                              10 </label>
                              <label class="btn btn-secondary" onClick="contract(100);">
                              <input type="radio" class="contract" name="contract" id="hoursofoperation" value="100">
                              100 </label>
                              <label class="btn btn-secondary" onClick="contract(1000);">
                              <input type="radio" class="contract" name="contract" id="hoursofoperation" value="1000">
                              1000 </label>
                              <label class="btn btn-secondary" onClick="contract(10000);">
                              <input type="radio" class="contract" name="contract" id="hoursofoperation" value="10000" >
                              10000 </label>
                           </div>
                           <input type="hidden" id="contractmoney" name="contractmoney" value="100">   
                           <p class="mb-1">Contract Count</p>
                           <div class="def-number-input number-input safari_only">
                              <button type="button" onClick="this.parentNode.querySelector('input[type=number]').stepDown(); addvalue();" class="minus"></button>
                              <input class="quantity" min="1" name="amount" id="amount" value="1" type="number" onKeyUp="addvalue();">
                              <button type="button" onClick="this.parentNode.querySelector('input[type=number]').stepUp(); addvalue();" class="plus"></button>
                           </div>
                           <input type="hidden" name="userid" id="userid" class="form-control" value="<?php echo $userid;?>">
                           <input type="hidden" name="type" id="type" class="form-control">
                           <input type="hidden" name="value" id="value" class="form-control" >
                           <input type="hidden" name="counter" id="counter" class="form-control" >
                           <input type="hidden" name="inputgameid" id="inputgameid" class="form-control" value="<?php echo sprintf("%03d",gameid($con));?>"> 
                           <div class="mt-2">Total contract money is <span id="showamount">10</span></div>
                           <input type="hidden" name="finalamount" id="finalamount" value="10">
                           <div class="custom-control custom-checkbox mt-2">
                              <input type="checkbox" checked class="custom-control-input" id="presalerule" name="presalerule">
                              <label class="custom-control-label text-muted" for="presalerule">I agree <a data-toggle="modal" href="#privacy" data-backdrop="static" data-keyboard="false">PRESALE RULE</a></label>
                           </div>
                        </div>
                     </div>
                  </div>
                  <input type="hidden" name="tab" id="tab" value="sapre">
                  <div class="modal-footer"> 
                     <a type="button" class="pull-left btn btn-sm closebtn" data-dismiss="modal">CANCEL</a>
                     <button type="submit" class="pull-left btn btn-sm btn-blue">CONFIRM</button> 
                  </div>
               </form>
            </div>
         </div>
      </div>
      <div id="alert" class="modal fade" role="dialog">
         <div class="modal-dialog modal-sm" role="document">
            <div class="modal-content">
               <div class="modal-body" id="alertmessage"> </div>
               <div class="text-right pb-1 pr-2">
                  <a type="button" class="text-info" data-dismiss="modal">OK</a>
               </div>
            </div>
         </div>
      </div>
      <div id="loader" class="modal fade" role="dialog">
         <div class="modal-dialog">
            <div class="modal-content" style="background:transparent; border:none;">
               <div class="text-center pb-1">
                  <a type="button" id="closbtnloader" data-dismiss="modal">
                     <div class="spinner-grow text-success"></div>
                  </a>
               </div>
            </div>
         </div>
      </div>
      <!-- Jquery --> 
      <script src="assets/js/lib/jquery-3.4.1.min.js"></script> 
      <!-- Bootstrap--> 
      <script src="assets/js/lib/popper.min.js"></script> 
      <script src="assets/js/lib/bootstrap.min.js"></script> 
      <!-- Owl Carousel --> 
      <script src="assets/js/plugins/owl.carousel.min.js"></script> 
      <!-- Main Js File --> 
      <script src="assets/js/app.js"></script>
      <script src="assets/js/betting.js"></script>
      <script src="assets/js/jquery.dataTables.min.js"></script>
      <script>
         $(document).ready(function () {
            
         var x = setInterval(function() { 
         start_count_down(); 
           $('#closbtnloader').click(); 
         }, 1e3);
         
         getResultbyCategory('sapre','sapre');
         
         $('#example').DataTable({
               "paging": true,
               "lengthChange": false,
               "searching": false,
               "ordering": false,
               "info": true,
               "autoWidth": false
             });
         });
         function start_count_down() { 
         $(".showload").hide();
         $(".none").show();
         var countDownDate = Date.parse(new Date) / 1e3;
           var now = new Date().getTime();
           var distance = 60 - countDownDate % 60;
           // alert(distance);
           var i = distance / 60,
            n = distance % 60,
            o = n / 10,
            s = n % 10;
           var minutes = Math.floor(i);
           var seconds = ('0'+Math.floor(n)).slice(-2);
           document.getElementById("demo").innerHTML = "<span class='timer'>0"+Math.floor(minutes)+"</span>" + "<span>:</span>" +"<span class='timer'>"+seconds+"</span>";
         document.getElementById("counter").value = distance;
         if(distance==30 || distance==55 || distance==50 || distance==45 || distance==40){
         generateGameid();
         getResultbyCategory('parity','parity');
         getResultbyCategory('sapre','sapre');
         getResultbyCategory('bcone','bcone');
         getResultbyCategory('emerd','emerd');
         }
         if(distance<=5)
         {
         $(".gbutton").prop('disabled', true);
         }else{ 
         $(".gbutton").prop('disabled', false);
         	}
         }
         
         function generateGameid()
         {
         var futureid=$('#futureid').val();
         // alert(futureid);
         	$.ajax({
             type: "Post",
             data:"futureid=" + futureid + "& type=" + "generate" ,
             url: "periodid-generation.php",
             success: function (html) {
              //alert(html);
         	 var arr = html.split('~');
         	 //alert(arr[1]);
         	 document.getElementById("gameid").innerHTML=arr[0];
         	 document.getElementById("inputgameid").value=arr[0];
         	 document.getElementById("futureid").value=arr[0];
               return false;
               },
               error: function (e) {}
               });
         	}
         	
         	function betbutton(color,type,name)
             {
         	    $.ajax({
                     type: "Post",
                     data:"type=" + type+ "& name=" + name ,
                     url: "betform.php",
                     success: function (html) {
         		    document.getElementById("loadform").innerHTML=html;
                         return false;
                     },
                     error: function (e) {}
                 });
         
         	    if(type=='number'){
                 	$(".paymentheader").css("background-color", color);
                 	document.getElementById('chn').innerHTML = 'Select '+name;
                 }else{
                 	$(".paymentheader").css("background-color", color);
                 	document.getElementById('chn').innerHTML = 'Join '+name;
         	    }
         	    $('#payment').modal({backdrop: 'static', keyboard: false})  
                 $('#payment').modal('show');
                 document.getElementById('type').value = type;
                 document.getElementById('value').value = name;
             }
             
             //=====================amount calculation======================	
             function contract(abc){ //alert(abc);
                 var amount =$("#amount").val();
                 document.getElementById('contractmoney').value = abc;
                 var addvalue=abc*amount;
                 document.getElementById('showamount').innerHTML = addvalue;
                 document.getElementById('finalamount').value = addvalue;
             };	
             function addvalue()
             { 
                 var amount =$("#amount").val();
                 var contractmoney =$("#contractmoney").val();
                 var addvalue=contractmoney*amount;
                 document.getElementById('showamount').innerHTML = addvalue;
                 document.getElementById('finalamount').value = addvalue;
             }
             function tabname(tabname){
                 document.getElementById('tab').value = tabname;	
         	}	
         
         //=====================amount calculation======================
         //====================== get Result==============================
         
         function getResultbyCategory(category,containerid)
         { 
             $.ajax({
                 type: "Post",
                 data:"category=" + category,
                 url: "getResultbyCategory.php",
             success: function (html) {
         	 document.getElementById(containerid).innerHTML=html;
         	 waitlist('parity',<?php echo $userid;?>,'paritywait');
         	 waitlist('sapre',<?php echo $userid;?>,'saprewait');
         	 waitlist('bcone',<?php echo $userid;?>,'bconewait');
         	 waitlist('emerd',<?php echo $userid;?>,'emerdwait');
         	 if(category=='parity'){
         	  $('#parityt').DataTable({
               "paging": true,
               "lengthChange": false,
               "searching": false,
               "ordering": false,
               "info": true,
               "autoWidth": false
             });
         	$('#myrecordparityt').DataTable({
               "paging": true,
               "lengthChange": false,
               "searching": false,
               "ordering": false,
               "info": true,
               "autoWidth": false
             });
         	 }
         	 else if(category=='sapre'){
         	  $('#sapret').DataTable({
               "paging": true,
               "lengthChange": false,
               "searching": false,
               "ordering": false,
               "info": true,
               "autoWidth": false
             });
         	$('#myrecordsapret').DataTable({
               "paging": true,
               "lengthChange": false,
               "searching": false,
               "ordering": false,
               "info": true,
               "autoWidth": false
             });
         	 }
         	 else if(category=='bcone'){
         	  $('#bconet').DataTable({
               "paging": true,
               "lengthChange": false,
               "searching": false,
               "ordering": false,
               "info": true,
               "autoWidth": false
             });
         	$('#myrecordbconet').DataTable({
               "paging": true,
               "lengthChange": false,
               "searching": false,
               "ordering": false,
               "info": true,
               "autoWidth": false
             });
         	 }
         	 else if(category=='emerd'){
         	  $('#emerdt').DataTable({
               "paging": true,
               "lengthChange": false,
               "searching": false,
               "ordering": false,
               "info": true,
               "autoWidth": false
             });
         	$('#myrecordemerdt').DataTable({
               "paging": true,
               "lengthChange": false,
               "searching": false,
               "ordering": false,
               "info": true,
               "autoWidth": false
             });
         	 }
               return false;
               },
               error: function (e) {}
               });
         	 
         	}
         
         $(document).ready(function () {
         	waitlist('sapre',<?php echo $userid;?>,'saprewait');
         });
           function reloadbtn(id){
             $('#loader').modal({backdrop: 'static', keyboard: false})  
          $('#loader').modal('show');
         
         $.ajax({
             type: "Post",
             data:"userid=" + id,
             url: "getwalletbalance.php",
             success: function (html) {
         	 
         			document.getElementById('balance').innerHTML =html;
               return false;
               },
               error: function (e) {}
               });
         	
         	}
         
      </script>
   </body>
</html>