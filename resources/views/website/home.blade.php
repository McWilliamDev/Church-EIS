<!DOCTYPE html>
<html lang="en">
    <head>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        @include('website.homecss')
        <link rel="stylesheet" href="{{ url('vendor/fontawesome-free/css/all.min.css') }}">
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

        @if ($announcements->isNotEmpty())
        <div class="modal" id="announcementModal" tabindex="-1" aria-labelledby="announcementModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-body">
                        <div id="announcementCarousel" class="carousel slide" data-bs-ride="carousel" data-bs-interval="10000">
                            <div class="carousel-inner">
                                @foreach ($announcements as $index => $post)
                                <div class="carousel-item {{ $index == 0 ? 'active' : '' }}">
                                    <div class="card mb-4 announcement-box p-4 d-flex" style="border-radius: 10px; width: 100%; box-shadow: none;">
                                        <div class="row g-0 align-items-center w-100">
                                            <div class="col-md-12 d-flex">
                                                <div class="card-body-announcements flex-grow-1">
                                                    <h3 class="card-title">{{ $post->title }}</h3>
                                                    <p class="card-text"><small class="text-muted">{{ $post->notice_date }}</small></p>
                                                    <br>
                                                    <p class="announcements-text">{{ $post->description }}</p>
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
        @endif

        @include('website.general')


        {{-- Infographics section start --}}
        <div class="container-fluid">
            <div class="row stats-container">

                <div class="col-12 col-md-3 stat-box">
                    <i class="fas fa-user block"></i>
                    <h2 class="block">{{ $ministryCount }}</h2>
                    <p class="block">Ministries</p>
                </div>
                <div class="col-12 col-md-3 stat-box">
                    <i class="fas fa-calendar-alt block"></i>
                    <h2 class="block">{{ $eventCount }}</h2>
                    <p class="block">Events</p>
                </div>
                <div class="col-12 col-md-3 stat-box">
                    <i class="fas fa-book block"></i>
                    <h2 class="block">{{ $resourceCount }}</h2>
                    <p class="block">Resources</p>
                </div>
            </div>
        </div>

        {{-- Infographics section end --}}

        <!-- SERVICE section start -->
        <div class="service-section">
            @include('website.service1')
        </div>
        <!-- SERVICE section end -->

        <!-- pastors section start -->
        @include('website.pastors')
        <!-- pastors section end -->


        <!-- footer section start -->
        @include('website.footer')
        <!-- footer section end -->

<!---------------------------------------------------------- Javascript ------------------------------------------------------------->
<script src="js/popper.min.js"></script>
<script src="js/bootstrap.bundle.min.js"></script>

<script>
    document.addEventListener("DOMContentLoaded", function() {
        var announcementModal = new bootstrap.Modal(document.getElementById('announcementModal'), {
            backdrop: true,
            keyboard: true
        });
        announcementModal.show();

        document.body.style.overflow = "auto";
        document.body.style.paddingRight = "0px";
    });
</script>

<style>
    body.modal-open {
        overflow: auto !important;
        padding-right: 0 !important;
    }
</style>


    </body>
</html>
