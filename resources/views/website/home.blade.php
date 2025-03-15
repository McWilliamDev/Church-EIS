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

{{-- Announcement Modal --}}
<div class="modal fade show" id="announcementModal" tabindex="-1" aria-labelledby="announcementModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content">

            <div class="modal-body">
                <h4 class="announcement-title">ANNOUNCEMENTS</h4>

                <div id="announcementCarousel" class="carousel slide" data-bs-ride="carousel" data-bs-interval="10000">
                    <div class="carousel-inner">
                        @foreach ($announcements as $index => $post)
                        <div class="carousel-item {{ $index == 0 ? 'active' : '' }}">
                            <div class="card mb-4 announcement-box p-4 d-flex" style="border-radius: 10px; width: 100%;">
                                
                                <div class="row g-0 align-items-center w-100">
                                    <div class="col-md-2 d-flex justify-content-center align-items-center">
                                        <img src="images/announcement.png" class="img-fluid rounded-start" 
                                             alt="Image" style="object-fit: contain; padding: 10px 0 0 30px;">
                                    </div>

                                    <div class="col-md-10 d-flex">
                                        <div class="card-body-announcements flex-grow-1">
                                            <h3 class="card-title">{{ $post->title }}</h3>
                                            <p class="announcements-text">{{ $post->description }}</p>
                                            <br>
                                            <p class="card-text"><small class="text-muted">{{ $post->publish_date }}</small></p>
                                        </div>
                                    </div>
                                </div>

                                <div class="carousel-buttons">
                                    <button class="btn btn-light" data-bs-target="#announcementCarousel" data-bs-slide="prev"><</button>
                                    <button class="btn btn-light" data-bs-target="#announcementCarousel" data-bs-slide="next">></button>
                                </div>

                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    document.addEventListener("DOMContentLoaded", function() {
        var announcementModal = new bootstrap.Modal(document.getElementById('announcementModal'), {
            backdrop: true,  
            keyboard: true   
        });
        announcementModal.show();
    });
</script>


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
