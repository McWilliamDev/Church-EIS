@include('website.homecss')
<link rel="icon" type="image/x-icon" href="{{ asset('favicon.ico') }}">
<link rel="icon" type="image/png" href="{{ asset('/favicon-32x32.png') }}">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">


{{--------------------------------------------------- HEADER ------------------------------------------------------------------}}

<div class="header_section">@include('website.header')
 {{--------------------------------------------------- BANNER ------------------------------------------------------------------}}
 <div class="banner_section layout_padding">
    <div id="carouselExampleSlidesOnly" class="carousel slide" data-ride="carousel">
       <div class="carousel-inner">
          <div class="carousel-item active">
             <div class="container">
                <h1 class="banner_taital">Grow through our</h1>
                <h1 class="banner_taital2">ministries</h1>
                <p class="banner_text">"That person is like a tree planted by streams of water, which yields its fruit in season and whose leaf does not wither— whatever they do prospers.</p>
                <p class="banner_text1"><i>Psalms 1:3</i></p>
             </div>
          </div>
       </div>
    </div>
 </div>
</div>

</div>



<div class="ministry_section layout_padding">
    <div class="container">
       <h1 class="ministry_taital ">Our <span>Ministries</span></h1>
       <p class="ministry_text ">Our ministries are dedicated to serving the community through faith, fellowship, and outreach, fostering spiritual growth and meaningful connections</p>

       <div class="ministry_section_2">
         <div class="row">
            @foreach($ministry as $post)
            @if($post->is_delete != 1)
                <div class="col-sm-4">
                    <div class="card">
                        <img src="{{ $post->ministry_profile ? asset('upload/ministry/' . $post->ministry_profile) : asset('images/default-ministry.png') }}" class="ministry_img" alt="{{ $post->ministry_name }}">
                        <div class="btn_main block">
                            <p class="ministry_name block">{{ $post->ministry_name }}</p>
                        </div>
                        <p class="ministry_p block">{{ $post->ministry_description }}</p>
                    </div>
                </div>
            @endif
        @endforeach
         </div>
     </div>

    </div>
 </div>


         <!-- footer section start -->
         @include('website.footer')
         <!-- footer section end -->