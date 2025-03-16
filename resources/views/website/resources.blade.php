@include('website.homecss')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">

{{--------------------------------------------------- HEADER ------------------------------------------------------------------}}
<div class="header_section">
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
                <li><a href="{{ route('home') }}">Home</a></li>
                <li><a href="{{ route(name: 'ministry') }}">Ministry</a></li>
                <li><a href="{{ route('event') }}">Events</a></li>
                <li><a href="{{ route('resources') }}">Resources</a></li>
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
               <h1 class="banner_taital">Church Growth</h1>
               <h1 class="banner_taital2">Materials</h1>
               <p class="banner_text">"That person is like a tree planted by streams of water, which yields its fruit in season and whose leaf does not wither— whatever they do prospers.</p>
               <p class="banner_text1"><i>Psalms 1:3</i></p>
            </div>
         </div>
      
      </div>
   </div>
   </div>
   </div>
</div>


<div class="ministry_section layout_padding" id="resources">
    <div class="container">
       <h1 class="ministry_taital">Resources</h1>
       <p class="resources_text">Church Resources provide members and visitors with access to spiritual materials, sermon archives, event guides, and ministry tools to support faith and community growth.</p>

       <div class="container">
        <div class="row">
         @foreach($resources as $post)
         <div class="col-md-6 col-12">
             <div class="card mb-3" style="border-radius: 10px;">
                 <div class="row no-gutters">
                     <div class="col-md-4">
                         <img src="{{ asset('upload/resources/' . $post->file_image) }}" class="card-img" alt="..." style="width: 200px; height: 200px">
                     </div>
                     <div class="col-md-8">
                         <div class="card-body">
                             <h3 class="card-title">{{ $post->file_name }}</h3>
                             <p class="card-text">{{ $post->description }}</p>
                             <br>
                             <a href="{{ asset('upload/resources/documents/' . $post->document) }}" class="file-download" download> Download
                             </a>
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

           <!-- footer section start -->
           @include('website.footer')
           <!-- footer section end -->