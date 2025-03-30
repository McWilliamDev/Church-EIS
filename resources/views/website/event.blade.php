@include('website.homecss')
<link rel="icon" type="image/x-icon" href="{{ asset('favicon.ico') }}">
<link rel="icon" type="image/png" href="{{ asset('/favicon-32x32.png') }}">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">

{{--------------------------------------------------- HEADER ------------------------------------------------------------------}}
<div class="header_section">
@include('website.header')
{{--------------------------------------------------- BANNER ------------------------------------------------------------------}}
   <div class="banner_section layout_padding">
   <div id="carouselExampleSlidesOnly" class="carousel slide" data-ride="carousel">
      <div class="carousel-inner">
         <div class="carousel-item active">
            <div class="container">
               <h1 class="banner_taital">Upcoming church</h1>
               <h1 class="banner_taital2">events</h1>
               <p class="banner_text">"That person is like a tree planted by streams of water, which yields its fruit in season and whose leaf does not wither— whatever they do prospers.</p>
               <p class="banner_text1"><i>Psalms 1:3</i></p>
            </div>
         </div>
      
      </div>
   </div>
   </div>
   </div>
</div>

</div>



<div class="event_section layout_padding">
    <div class="container">

      <h1 class="event_taital ">Our <span>Events</span></h1>
      <p class="event_text ">Our events bring our community together through faith, fellowship, and meaningful activities that inspire spiritual growth and connection</p>
      

      <div class="container">
        <div class="row">
            @foreach($events as $post)
            <div class="col-md-6 col-12">
                <div class="card mb-3" style="border-radius: 10px;">
                    <div class="row no-gutters">
                        <div class="col-md-5 d-flex align-items-center justify-content-center">
                            <div class="image-container">
                                <img src="{{ asset('upload/featured/' . $post->featured_image) }}" class="card-img" alt="..." />
                            </div>
                        </div>
                        <div class="col-md-7">
                            <div class="card-body" style="margin-bottom: 10px;">
                                <h3 class="card-title">{{ $post->title }}</h3>
                                <p class="card-text">{{ $post->description }}</p>
                                <br>
                                <p class="card-text"><small class="text-muted">{{ $post->date }}</small></p>
                                <p class="card-text"><small class="text-muted">{{ $post->location }}</small></p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
  


    </div>
    </div>
 </div>

          <!-- footer section start -->
          @include('website.footer')
          <!-- footer section end -->

    <style>
        .image-container {
            width: 100%;
            height: 200px;
            overflow: hidden;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .image-container img {
            width: 100%;
            height: auto;
            min-height: 100%;
            object-fit: cover;
        }
    </style>