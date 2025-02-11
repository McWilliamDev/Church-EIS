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
      @include('website.service')
      <!-- SERVICE section end -->

      <!-- pastors section start -->
      @include('website.pastors')
      <!-- pastors section end -->

      <!-- MINISTRY section start -->
        @include('website.ministry')
      <!-- MINISTRY section end -->

      <!-- event section start -->
        @include('website.event')
      <!-- event section end -->

      <!-- event section start -->
      @include('website.resources')
      <!-- event section end -->

      <!-- footer section start -->
      @include('website.footer')
      <!-- footer section end -->

<!---------------------------------------------------------- Javascript ------------------------------------------------------------->

      <script src="js/website/jquery.min.js"></script>
      <script src="js/website/popper.min.js"></script>
      <script src="js/website/bootstrap.bundle.min.js"></script>
      <script src="js/website/jquery-3.0.0.min.js"></script>
      <script src="js/website/plugin.js"></script>
      <!-- sidebar -->
      <script src="js/website/jquery.mCustomScrollbar.concat.min.js"></script>
      <script src="js/website/custom.js"></script>
      <!-- javascript --> 
      <script src="js/website/owl.carousel.js"></script>
      <script src="https:cdnjs.cloudflare.com/ajax/libs/fancybox/2.1.5/jquery.fancybox.min.js"></script>    
   </body>
</html>