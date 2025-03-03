<div class="ministry_section layout_padding" id="ministry">
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