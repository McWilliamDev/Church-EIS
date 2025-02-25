<div class="ministry_section layout_padding" id="section2">
    <div class="container">
       <h1 class="ministry_taital">Ministries</h1>
       <p class="ministry_text">Empowering individuals to serve God and others through various ministries that foster worship, and community.</p>

       <div class="ministry_section_2">
         <div class="row">
             @foreach($ministry as $post)
                 <div class="col-sm-3">
                     <div class="card">
                         <img src="images/website/img-1.png" class="ministry_img" alt="{{ $post->ministry_name }}">
                         <div class="btn_main">
                             <p class="generalp">{{ $post->ministry_name }}</p>
                         </div>
                         <p class="generalp">Music and Worship</p>
                     </div>
                 </div>
             @endforeach
         </div>
     </div>

    </div>
 </div>