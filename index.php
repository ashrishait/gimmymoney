<?php
ob_start();
session_start();
include('head.php');
include("include/connection.php");

$bannerQuery = mysqli_query($con, "SELECT * FROM `banner`");
$productQuery = mysqli_query($con, "SELECT * FROM `tbl_product` WHERE `status`='1'");

?>

<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0">
    <meta name="description" content="Bitter Mobile Template">
    <meta name="keywords" content="bootstrap, mobile template, bootstrap 4, mobile, html, responsive" />

    <link rel="stylesheet" href="https://demo6.madhyabharat.org/assets/css/fontawasome.min.css">
    <link rel="stylesheet" href="https://demo6.madhyabharat.org/assets/css/style.css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.1/css/all.css" integrity="sha384-vp86vTRFVJgpjF9jiIGPEEqYqlDwgyBgEF109VFjmqGmIY/Y4HV4d3Gp2irVfcrp" crossorigin="anonymous">
    <link rel="stylesheet" href="assets/css/style.css?v=2">
    <script src="https://cdn.tailwindcss.com"></script>

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

    <title>Diamond Club</title>
</head>

<!-- <body onload="AmagiLoader.show()"> -->

<body class="overflow-y-scroll">
    <!-- <div class="container-fluid !p-0"> -->
    <div class="row header-banner shadow rounded" style="padding: 10px;">
        <div class="col-sm-12 flex justify-between items-center ">
            <p class="text-2xl font-bold">Diamond Club</p>
            <span class="pull-right">
                <a href="assets/app-debug.apk"><i class="fas fa-download download-icon"></i></a>
            </span>
        </div>
    </div>

    <div class="row py-2 !mt-2.5">
        <div class="col-sm-12 text-center p-0">
            <h4 class="top_title text-3xl font-bold">Welcome Back</h4>
            <p class="bot_title underline text-lg">Quality Guarantee</p>
        </div>
    </div>

    <div class="row p-0">
        <div class="col-sm-12 p-0">
            <div class="owl-slider">
                <div id="carousel" class="owl-carousel">
                    <?php while ($row = mysqli_fetch_array($bannerQuery)) { ?>
                        <div class="item">
                            <img class="d-block w-100 rounded-t-xl" src="lottlucyappadmin/banner/<?php echo $row["material"]; ?>">
                        </div>
                    <?php } ?>
                </div>
            </div>
        </div>
    </div>

    <div class="row p-0" style="">
        <?php while ($productResult = mysqli_fetch_array($productQuery)) { ?>
            <div class="col-sm-4 col-12 text-center shadow mb-3 p-0 py-5 ">
                <img class="img-fluid img-responssive" src="product/<?php echo $productResult['images']; ?>" style="height: 400px;">
                <p class="text-justify"><?php echo $productResult['name']; ?></p>
                <p class="price-symbol text-left"> ₹ <?php echo number_format($productResult['price'], 2); ?></p>
            </div>
        <?php } ?>
    </div>
    <?php
    // Dummy array containing winning information
    // $winningInformation = [
    //     [
    //         'username' => 'User**75',
    //         'amount' => '₹47.04',
    //         'avatar' => 'https://bigmumbai.link/assets/png/avatar-ea3b8ee9.png',
    //         'background' => 'https://bigmumbai.link/assets/png/luck_bg-62bc96e0.png'
    //     ], [
    //         'username' => 'User**95',
    //         'amount' => '₹4087.04',
    //         'avatar' => 'https://bigmumbai.link/assets/png/avatar-ea3b8ee9.png',
    //         'background' => 'https://bigmumbai.link/assets/png/luck_bg-62bc96e0.png'
    //     ], [
    //         'username' => 'User**275',
    //         'amount' => '₹227.04',
    //         'avatar' => 'https://bigmumbai.link/assets/png/avatar-ea3b8ee9.png',
    //         'background' => 'https://bigmumbai.link/assets/png/luck_bg-62bc96e0.png'
    //     ], [
    //         'username' => 'User**905',
    //         'amount' => '₹87.04',
    //         'avatar' => 'https://bigmumbai.link/assets/png/avatar-ea3b8ee9.png',
    //         'background' => 'https://bigmumbai.link/assets/png/luck_bg-62bc96e0.png'
    //     ], [
    //         'username' => 'User**375',
    //         'amount' => '₹2427.04',
    //         'avatar' => 'https://bigmumbai.link/assets/png/avatar-ea3b8ee9.png',
    //         'background' => 'https://bigmumbai.link/assets/png/luck_bg-62bc96e0.png'
    //     ],
    //     // Add more entries as needed
    // ];

    
// Fetch data from the database
$productQuery = mysqli_query($con, "SELECT * FROM `tbl_userresult` WHERE `status` = 'success' ORDER BY `createdate` DESC");
$winningInformation = [];

// Check if query was successful
if ($productQuery) {
    while ($row = mysqli_fetch_assoc($productQuery)) {
        // Fetch additional details from tbl_user using user id
        $userId = $row['userid'];
        $userQuery = mysqli_query($con, "SELECT * FROM `tbl_user` WHERE `id` = '$userId'");
        if ($userQuery) {
            $userData = mysqli_fetch_assoc($userQuery);
            $mobile = $userData['mobile'];
            // Mask mobile number
            $maskedMobile = substr($mobile, 0, 5) . '*****' . substr($mobile, -2);
            // Create an entry for winning information
            $winningInformation[] = [
                'username' => $maskedMobile,
                'amount' => '₹' . $row['amount'],
                'avatar' => 'https://bigmumbai.link/assets/png/avatar-ea3b8ee9.png',
                'background' => 'https://bigmumbai.link/assets/png/luck_bg-62bc96e0.png'
            ];
        }
    }
}

    ?>

    <div class="row m-0 !mt-4 !mb-1 p-0">
        <div class="col-sm-12 p-0 text-center">
            <p class="text-lg font-normal text-center font-semibold">Winning Information</p>
        </div>
        <div class="inline-flex items-center justify-center w-full">
            <hr class="w-10/12 h-px my-4 bg-gray-200 border-0 dark:bg-gray-700">
        </div>
        <div class="col-sm-12 py-0 !px-1">
            <div class="owl-slider">
                <div id="carouselWinning" class="owl-carousel !mb-10">
                    <?php foreach ($winningInformation as $info) { ?>
                        <div class="item mx-2 border bg-[#f0f0f5] rounded-xl">
                            <div class="w-full flex flex-col gap-y-2 justify-center relative">
                                <div class="flex flex-col justify-center items-center -mt-3">
                                    <img src="<?php echo $info['background']; ?>" class="!w-14 !h-14 relative top-4" />
                                    <img src="<?php echo $info['avatar']; ?>" class="!w-16 !h-16" />
                                </div>
                                <p class="text-center font-semibold text-xs"><?php echo $info['username']; ?></p>
                                <hr class="w-10/12 h-px mx-auto my-0 border-0 bg-gray-400">
                                <p class="text-center font-semibold text-lg my-2 mt-0 bg-clip-text text-transparent bg-gradient-to-r from-purple-500 to-pink-500 "><?php echo $info['amount']; ?></p>
                            </div>
                        </div>
                    <?php } ?>
                </div>
            </div>
        </div>
    </div>

    <?php
    // Dummy array containing earning information
    // $earnings = [
    //     [
    //         'username' => 'User**75',
    //         'amount' => '₹403627.04',
    //         'avatar' => 'https://bigmumbai.link/assets/png/avatar-ea3b8ee9.png',
    //         'background' => 'https://bigmumbai.link/assets/png/luck_bg-62bc96e0.png'
    //     ],
    //     [
    //         'username' => 'User**75',
    //         'amount' => '₹111347.04',
    //         'avatar' => 'https://bigmumbai.link/assets/png/avatar-ea3b8ee9.png',
    //         'background' => 'https://bigmumbai.link/assets/png/luck_bg-62bc96e0.png'
    //     ],
    //     [
    //         'username' => 'User**75',
    //         'amount' => '₹936647.04',
    //         'avatar' => 'https://bigmumbai.link/assets/png/avatar-ea3b8ee9.png',
    //         'background' => 'https://bigmumbai.link/assets/png/luck_bg-62bc96e0.png'
    //     ],
    //     [
    //         'username' => 'User**75',
    //         'amount' => '₹432327.04',
    //         'avatar' => 'https://bigmumbai.link/assets/png/avatar-ea3b8ee9.png',
    //         'background' => 'https://bigmumbai.link/assets/png/luck_bg-62bc96e0.png'
    //     ],
    //     [
    //         'username' => 'User**75',
    //         'amount' => '₹423237.04',
    //         'avatar' => 'https://bigmumbai.link/assets/png/avatar-ea3b8ee9.png',
    //         'background' => 'https://bigmumbai.link/assets/png/luck_bg-62bc96e0.png'
    //     ],
    //     // Add more entries as needed
    // ];
  
    // // Sorting the earnings array by amount
    // usort($earnings, function ($a, $b) {
    //     return $a['amount'] < $b['amount'];
    // });

    // // Limiting the earnings array to 7 entries
    // $earnings = array_slice($earnings, 0, 7);

    
// Get today's date
$todayDate = date('Y-m-d');

// Fetch data from the database for today
$query = mysqli_query($con, "SELECT userid, SUM(amount) AS total_amount FROM tbl_userresult WHERE DATE(createdate) = '$todayDate' GROUP BY userid");

$earnings = [];

// Check if query was successful
if ($query) {
    while ($row = mysqli_fetch_assoc($query)) {
        $userId = $row['userid'];
        // Fetch additional details from tbl_user using user id
        $userQuery = mysqli_query($con, "SELECT * FROM tbl_user WHERE id = '$userId'");
        if ($userQuery) {
            $userData = mysqli_fetch_assoc($userQuery);
            $maskedMobile = substr($userData['mobile'], 0, 5) . '*****' . substr($userData['mobile'], -2);
            // Create an entry for earnings array
            $earnings[] = [
                'username' => $maskedMobile,
                'amount' => '₹' . number_format($row['total_amount'], 2),
                'avatar' => 'https://bigmumbai.link/assets/png/avatar-ea3b8ee9.png',
                'background' => 'https://bigmumbai.link/assets/png/luck_bg-62bc96e0.png'
            ];
        }
    }
}

// Sorting the earnings array by amount
usort($earnings, function ($a, $b) {
    return $a['amount'] < $b['amount'];
});

// Limiting the earnings array to 7 entries
$earnings = array_slice($earnings, 0, 7);


    ?>

    <div class="row m-0 !mt-4 !mb-14 p-0 ">
        <div class="col-sm-12 p-0 text-center">
            <p class="text-lg font-normal text-center font-semibold">Today's Earnings chart</p>
        </div>
        <div class="inline-flex items-center justify-center w-full">
            <hr class="w-10/12 h-px my-4 bg-gray-200 border-0 dark:bg-gray-700">
        </div>
        <div class="col-sm-12 py-0 !px-1 !mb-8">
        <?php if (empty($earnings)) { ?>
    <div class="text-center font-semibold text-lg mt-4">No Data Found</div>
<?php } else { ?>
    <?php foreach ($earnings as $index => $info) { ?>
        <div class="w-11/12 mx-auto border rounded-t-lg bg-[#f0f0f5]">
            <div class="w-full flex flex-row justify-between items-center px-2 py-2">
                <div class="flex flex-row justify-center items-center gap-2">
                    <div class="flex flex-col justify-center items-center -mt-8">
                        <img src="<?php echo $info['background']; ?>" class="!w-10 !h-10 relative top-6" />
                        <img src="<?php echo $info['avatar']; ?>" class="!w-12 !h-12" />
                    </div>
                    <div class="flex flex-col">
                        <p class="text-center font-semibold text-xs"><?php echo $info['username']; ?></p>
                        <?php if ($index === 0) { ?>
                            <div class="flex gap-1 items-center">
                                <img src="https://bigmumbai.link/assets/png/top1-573e2e29.png" class="!w-4 !h-4" />
                                <p class="text-center font-semibold text-sm color-[#fbae3b]">No. 1</p>
                            </div>
                        <?php } elseif ($index === 1) { ?>
                            <div class="flex gap-1 items-center">
                                <img src="https://bigmumbai.link/assets/png/top2-40f62dc7.png" class="!w-4 !h-4" />
                                <p class="text-center font-semibold text-sm color-[#508e9e]">No. 2</p>
                            </div>
                        <?php } elseif ($index === 2) { ?>
                            <div class="flex gap-1 items-center">
                                <img src="https://bigmumbai.link/assets/png/top3-31e06806.png" class="!w-4 !h-4" />
                                <p class="text-center font-semibold text-sm color-[#f59369]">No. 3</p>
                            </div>
                        <?php } else { ?>
                            <p class="text-center font-semibold text-sm">No. <?php echo ($index + 1); ?></p>
                        <?php } ?>
                    </div>
                </div>
                <p class="text-center font-semibold text-lg my-2 mt-0 bg-clip-text text-transparent bg-gradient-to-r from-purple-500 to-pink-500 "><?php echo $info['amount']; ?></p>
            </div>
        </div>
    <?php } ?>
<?php } ?>

        </div>
    </div>


    <div class="mt-8">
        " "
    </div>

    <!-- </div> -->
    <?php include("include/footer.php"); ?>

    <!-- Scripts -->
    <script src="assets/js/lib/jquery-3.4.1.min.js"></script>
    <script src="assets/js/lib/popper.min.js"></script>
    <script src="assets/js/lib/bootstrap.min.js"></script>
    <script src="assets/js/plugins/owl.carousel.min.js"></script>
    <script src="assets/js/app.js"></script>

    <script>
        // Owl Carousel Initialization
        jQuery("#carousel, #trending, #shoe").owlCarousel({
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
        jQuery("#carouselWinning").owlCarousel({
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
                    items: 3
                },
                600: {
                    items: 3
                },
                1024: {
                    items: 3
                },
                1366: {
                    items: 3
                }
            }
        });
    </script>
</body>

</html>