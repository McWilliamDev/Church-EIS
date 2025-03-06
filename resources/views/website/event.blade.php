<div class="event_section layout_padding" id="events">
    <div class="container">
       <h1 class="event_taital">Upcoming Events</h1>
       <p class="generalp">Dedicated spiritual leaders guiding the church community with faith, wisdom, and service, fostering growth in faith and fellowship</p> 
       
       <br>

       @foreach($events as $post)
       <div class="card mb-3" style="border-radius: 10px;">
        <div class="row g-0" style="padding-bottom: 0px">
          <div class="col-md-4">
            <img src="images/website/banner-bg.png" class="img-fluid rounded-start" alt="..." style="height: auto; width: auto;">
          </div>
          <div class="col-md-8">
            <div class="card-body">
              <h3 class="card-title">{{ $post->title }}</h3>
              <p class="card-text">{{ $post->description }}</p>
              <br><p class="card-text"><small class="text-muted">{{ $post->date }}</small></p>
              <p class="card-text"><small class="text-muted">{{ $post->location }}</small></p>
            </div>
          </div>
        </div>
      </div>
      @endforeach


    </div>
 </div>