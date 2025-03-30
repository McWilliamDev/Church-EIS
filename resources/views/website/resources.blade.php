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

</div>


<div class="ministry_section layout_padding" id="resources">
    <div class="container">
       <h1 class="ministry_taital ">Our <span>Resources</span></h1>
       <p class="resources_text ">Our growth materials provide valuable resources to support spiritual development, leadership training, and community engagement for a stronger faith journey</p>

       <div class="container">
        <div class="row">
            @foreach($resources as $post)
            <div class="col-md-6 col-12">
                <div class="card mb-3" style="border-radius: 10px;">
                    <div class="row no-gutters">
                        <div class="col-md-6">
                            <img src="{{ asset('upload/resources/' . $post->file_image) }}" class="card-img resources-img" alt="..." style="height: 200px; width: 100%; object-fit: cover; align-items: center; margin: auto;">
                        </div>
                        <div class="col-md-6">
                            <div class="card-body block" style="margin-bottom: 10px;">
                                <h3 class="card-title block">{{ $post->file_name }}</h3>
                                <p class="card-text block">{{ $post->description }}</p>
                                <br>
                                <a href="{{ asset('upload/resources/documents/' . $post->document) }}" class="file-download block" download="{{ $post->file_name }}"> Download
                                </a>
                                <br>
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