<!DOCTYPE html>
<html lang="en">
    <head>

    @include('website.homecss')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    </head>
<!---------------------------------------------------------- Border ------------------------------------------------------------->

    <body>
        <!-- header section start -->
        <div class="header_section">
        @include('website.header')
        <!-- header section end -->

        <!-- banner section start -->
        @include('website.banner')
        </div>
        <!-- banner section end -->

        <!-- choose section start -->
        @include('website.general')
        <!-- choose section end -->

        <!-- SERVICE section start -->
        <div class="service-section">
            @include('website.service1')
        </div>
        <div class="service-section">
            @include('website.service2')
        </div>
        <!-- SERVICE section end -->


        <!-- pastors section start -->
        @include('website.pastors')
        <!-- pastors section end -->


        <!-- footer section start -->
        @include('website.footer')
        <!-- footer section end -->

<!---------------------------------------------------------- Javascript ------------------------------------------------------------->

    <script src="js/jquery.min.js"></script>
    <script src="js/popper.min.js"></script>
    <script src="js/bootstrap.bundle.min.js"></script>
    <script src="js/jquery-3.0.0.min.js"></script>
    <script src="js/plugin.js"></script>
    <!-- sidebar -->
    <script src="js/jquery.mCustomScrollbar.concat.min.js"></script>
    <script src="js/custom.js"></script>
    <!-- javascript --> 
    <script src="js/owl.carousel.js"></script>
    <script src="https:cdnjs.cloudflare.com/ajax/libs/fancybox/2.1.5/jquery.fancybox.min.js"></script>  

    </body>
</html>