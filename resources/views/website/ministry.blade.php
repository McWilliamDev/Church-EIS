@include('website.homecss')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">


{{--------------------------------------------------- HEADER ------------------------------------------------------------------}}
<div class="header_section">
    <div class="header_main">
        <div class="mobile_menu">
        <nav class="navbar navbar-expand-lg navbar-light bg-light">
            <div class="logo_mobile"><img src="images/LogoTransparentWhite.png" style="width: 80px"></div>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav">
                    <li class="nav-item">
                    <a class="nav-link" href="/aboutus">About Us</a>
                    </li>
                    <li class="nav-item">
                    <a class="nav-link" href="/ministry">Ministries</a>
                    </li>
                    <li class="nav-item">
                    <a class="nav-link " href="/events">Events</a>
                    </li>
                    <li class="nav-item">
                    <a class="nav-link " href="/resources">Resources</a>
                    </li>
                </ul>
            </div>
        </nav>
        </div>
        <div class="container-fluid">
        <div class="logo"><img src="images/LogoTransparentWhite.png" style="width: 150px"></div>
        <div class="menu_main" id="home">
            <ul>
                <li><a href="">Home</a></li>
                <li><a href="/ministry">Ministries</a></li>
                <li><a href="/events">Events</a></li>
                <li><a href="/resources">Resources</a></li>
            </ul>
        </div>
        </div>
    </div> 



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
          <div class="carousel-item">
             <div class="container">
                <h1 class="banner_taital">Ministries</h1>
                <p class="banner_text">There are many variations of passages of Lorem Ipsum available, but the majority have sufferedThere are ma available, but the majority have suffered</p>
                <div class="read_bt"><a href="#section2">Read More</a></div>
             </div>
          </div>
          <div class="carousel-item">
             <div class="container">
                <h1 class="banner_taital">Events</h1>
                <p class="banner_text">There are many variations of passages of Lorem Ipsum available, but the majority have sufferedThere are ma available, but the majority have suffered</p>
                <div class="read_bt"><a href="#section3">Read More</a></div>
             </div>
          </div>
          <div class="carousel-item">
            <div class="container">
               <h1 class="banner_taital">Resources</h1>
               <p class="banner_text">There are many variations of passages of Lorem Ipsum available, but the majority have sufferedThere are ma available, but the majority have suffered</p>
               <div class="read_bt"><a href="#section4">Read More</a></div>
            </div>
         </div>
       </div>
    </div>
 </div>
</div>



<div class="ministry_section layout_padding">
    <div class="container">
       <h1 class="ministry_taital">Ministries</h1>
       <p class="ministry_text">Empowering individuals to serve God and others through various ministries that foster worship, and community.</p>

       <div class="ministry_section_2">
         <div class="row">
            @foreach($ministry as $post)
            @if($post->is_delete != 1)
                <div class="col-sm-3">
                    <div class="card">
                        <img src="{{ $post->ministry_profile ? asset('upload/ministry/' . $post->ministry_profile) : asset('images/default-ministry.png') }}" class="ministry_img" alt="{{ $post->ministry_name }}">
                        <div class="btn_main">
                            <p class="generalp">{{ $post->ministry_name }}</p>
                        </div>
                        <p class="generalp">{{ $post->ministry_description }}</p>
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