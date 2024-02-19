<?php
ob_start();
session_start();
?>
<!doctype html>
<html lang="en">
<head>
<meta charset="utf-8" />
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<title>Search</title>

<!-- Global site tag (gtag.js) - Google Analytics -->
<script async src="https://www.googletagmanager.com/gtag/js?id=G-PVHDPGFCZX"></script>
<script>
  window.dataLayer = window.dataLayer || [];
  function gtag(){dataLayer.push(arguments);}
  gtag('js', new Date());

  gtag('config', 'G-PVHDPGFCZX');
</script><link rel="stylesheet" href="assets/css/style.css">
<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0">
<meta name="description" content="Bitter Mobile Template">
<meta name="keywords" content="bootstrap, mobile template, bootstrap 4, mobile, html, responsive" />
<style>
.pleft {
  padding-left:3px;
}
.pright {
  padding-right:3px;
}
.sectionTitle {
  -ms-flex-preferred-size: 50%;
  flex-basis: 100%;
  -webkit-box-flex: 0;
  -ms-flex-positive: 0;
  flex-grow: 0;
  max-width: 100%;
  margin-top:-15px;
}
/*.imageWrapper{
  width:40%;
}*/
@media (max-width:989px){
  .imageWrapper{
  width:100%;

}
}

</style>
</head>

<body>

   <?php include("include/connection.php");?>




<!-- App Capsule -->
<div id="appCapsule">
  <div class="appContent1">
    <div class="searchBlock">
      <form id="searchform" method="post" action="#">
        
    <span class="inputIcon" style="position:absolute; "> <i class="icon ion-ios-search"></i> </span>
        <input type="text" class="form-control" id="searchInput" name="searchInput" placeholder="Search for goods.......Please type keywords and press enter to view details..........">
    
      </form>
    </div>
  </div>
  <div class="appContent ">
    <div class="sectionTitle mb-2 p-2"> 
      
      <!-- post list -->

        <div class="row" id="searchResult"> 
    
          <!-- item -->

           <?php
  $i=0;
  $productQuery=mysqli_query($con,"select * from `tbl_product` where `status`='1'");
  while($productResult=mysqli_fetch_array($productQuery)){$i++;?>
            
          <div class="col-xs-4 col-md-4 col-sm-12">
            <div class="vcard card"> 
             <!--  <a href="productdetails.php?pid=dE5ENDVsMnpURWJqdVo4OWJlWWkvQT09" class="postItem">
              <div class="imageWrapper"> <img src="product/qjvnnv.png" alt="image" class="image"> </div>
              <p class="text-center">Ratnavali Jewels American Diamond Traditional Fashion Jewellery Green Necklace Pendant Set with Earring for Women/Girls RV2916G</p>
              <footer>₹ 19,999.00</footer>
              </a>  -->
               <a href="">
              <div class="imageWrapper"> <img src="product/<?php echo $productResult['images'];?>" alt="image" class="image" style="height:300px; width: auto;" > </div>
              <p class="text-center"><?php echo $productResult['name'];?></p>
              <footer>₹ <?php echo number_format($productResult['price'], 2);?></footer>
              </a> 
            </div>
          </div>

             <?php } ?>




          </div>
    </div>
  </div>
</div>

<div class="appBottomMenu">
  <div class="item "> <a href="index.php">
    <p> <i class="icon ion-md-home"></i> <span>Home</span> </p>
    </a> </div>
  <div class="item active"> <a href="search.php">
    <p> <i class="icon ion-ios-search"></i> <span>Search</span> </p>
    </a> </div>
     <div class="item "> <a href="login.php" class="icon toggleSidebar">
    <p> <i class="icon ion-md-person"></i> <span>My </span> </p>
    </a> </div>
    </div><!-- Jquery --> 
<script src="assets/js/lib/jquery-3.4.1.min.js"></script> 
<!-- Bootstrap--> 
<script src="assets/js/lib/popper.min.js"></script> 
<script src="assets/js/lib/bootstrap.min.js"></script> 
<!-- Owl Carousel --> 
<script src="assets/js/plugins/owl.carousel.min.js"></script> 
<!-- Main Js File --> 
<script src="assets/js/app.js"></script>
</body>
</html>