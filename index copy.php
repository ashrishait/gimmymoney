<?php
ob_start();
session_start();
?>
<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <?php include('head.php') ?>
    <link rel="stylesheet" href="assets/css/style.css?v=2">

    <link rel='stylesheet' href="https://demo6.madhyabharat.org/assets/css/fontawasome.min.css">
    <link rel="stylesheet" href="https://demo6.madhyabharat.org/assets/css/style.css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.1/css/all.css" integrity="sha384-vp86vTRFVJgpjF9jiIGPEEqYqlDwgyBgEF109VFjmqGmIY/Y4HV4d3Gp2irVfcrp" crossorigin="anonymous">
    <script src="https://cdn.tailwindcss.com"></script>

    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0">
    <meta name="description" content="Bitter Mobile Template">
    <meta name="keywords" content="bootstrap, mobile template, bootstrap 4, mobile, html, responsive" />
    <style>
        .pleft {
            padding-left: 3px;
        }

        .pright {
            padding-right: 3px;
        }

        .height {
            height: 40px;
            line-height: 40px;
        }

        .height .pageTitle {
            line-height: 2em;
        }
    </style>
</head>

<body onload="AmagiLoader.show()">

    <?php include("include/connection.php"); ?>
    <div class="container-fluid">
        <div class="row header-banner shadow rounded" style="padding: 10px;">
            <div class="col-sm-12">
                <b style="font-size:30px;">Diamond Club</b>

                <span class="pull-right">
                    <a href="assets/app-debug.apk"><i class="fas fa-download download-icon" style="float: right;"></i></a>
                </span>
            </div>
        </div>
        <div class="row py-2">
            <div class="col-sm-12 text-center">
                <h4 class="top_title">Welcome Back</h4>
                <p class="bot_title">Quality Guarantee</p>
            </div>
        </div>

        <div class="row">
            <div class="col-sm-12">
                <div class="owl-slider">
                    <div id="carousel" class="owl-carousel">

                        <?php
                        $Query = mysqli_query($con, "select * from `banner`");
                        $i = 0;
                        while ($row = mysqli_fetch_array($Query)) {
                            $i++;
                        ?>

                            <div class="item">

                                <!-- <img class="owl-lazy" src="../lottlucyappadmin/<?php echo @$row["material"]; ?>" alt=""> -->
                                <!-- <img class="d-block w-100" src="../lottlucyappadmin/banner/<?php echo $row["material"]; ?>" alt="First slide"> -->
                                <img class="d-block w-100" src="lottlucyappadmin/banner/<?php echo @$row["material"]; ?>">
                            </div>

                        <?php }  ?>
                    </div>
                </div>
            </div>
        </div>



        <div class="row" style="padding-bottom:70px;">
            <?php
            $i = 0;
            $productQuery = mysqli_query($con, "select * from `tbl_product` where `status`='1'");
            while ($productResult = mysqli_fetch_array($productQuery)) {
                $i++; ?>


                <div class="col-sm-4 col-12 text-center shadow mb-3 py-5">
                    <img class="img-fluid img-responssive" src="product/<?php echo $productResult['images']; ?>" style="height: 400px;">
                    <p class="text-justify"><?php echo $productResult['name']; ?></p>
                    <p class="price-symbol text-left"> ₹ <?php echo number_format($productResult['price'], 2); ?></p>
                </div>

            <?php } ?>


        </div>


        <?php include("include/footer.php"); ?>

        <!-- ///////////// Js Files ////////////////////  -->
        <!-- Jquery -->
        <script src="assets/js/lib/jquery-3.4.1.min.js"></script>
        <!-- Bootstrap-->
        <script src="assets/js/lib/popper.min.js"></script>
        <script src="assets/js/lib/bootstrap.min.js"></script>
        <!-- Owl Carousel -->
        <script src="assets/js/plugins/owl.carousel.min.js"></script>
        <!-- Main Js File -->
        <script src="assets/js/app.js"></script>
        <!--<script src="https://demo6.madhyabharat.org/assets/js/amagiloader.js"></script>-->

        <!--<script>-->
        <!-- AmagiLoader.show();-->
        <!-- setTimeout(() => {-->
        <!--    AmagiLoader.hide();-->
        <!-- }, 2000);-->
        <!--</script>-->

    </div>

    <script>
        jQuery("#carousel").owlCarousel({
            autoplay: true,
            lazyLoad: true,
            loop: true,
            margin: 0,
            animateOut: 'fadeOut',
            animateIn: 'fadeIn',

            responsiveClass: true,
            autoHeight: true,
            autoplayTimeout: 3000,
            smartSpeed: 800,
            nav: false,
            responsive: {
                0: {
                    items: 1
                },

                600: {
                    items: 1
                },

                1024: {
                    items: 1
                },

                1366: {
                    items: 1
                }
            }
        });
        jQuery("#trending").owlCarousel({
            autoplay: true,
            lazyLoad: true,
            loop: true,
            margin: 0,

            animateOut: 'fadeOut',
            animateIn: 'fadeIn',

            responsiveClass: true,
            autoHeight: true,
            autoplayTimeout: 3000,
            smartSpeed: 800,
            nav: false,
            responsive: {
                0: {
                    items: 2
                },

                600: {
                    items: 2
                },

                1024: {
                    items: 6
                },

                1366: {
                    items: 6
                }
            }
        });
        jQuery("#shoe").owlCarousel({
            autoplay: true,
            lazyLoad: true,
            loop: true,
            margin: 0,

            animateOut: 'fadeOut',
            animateIn: 'fadeIn',

            responsiveClass: true,
            autoHeight: true,
            autoplayTimeout: 3000,
            smartSpeed: 800,
            nav: false,
            responsive: {
                0: {
                    items: 2
                },

                600: {
                    items: 2
                },

                1024: {
                    items: 6
                },

                1366: {
                    items: 6
                }
            }
        });
    </script>
</body>

</html>