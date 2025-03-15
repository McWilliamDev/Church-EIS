@include('website.homecss')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">

<div class="event_section layout_padding">
    <div class="container">
        {{-- for each --}}
        <div class="card mb-3 announcement-box" style="border-radius: 10px; position: relative;">
            
            <!-- Close Button -->
            <button class="close-btn" onclick="hideAnnouncement(this)">
                &times;
            </button>

            <div class="row g-0 align-items-center">
                <!-- Image on the Left, Centered -->
                <div class="col-md-2 d-flex justify-content-center align-items-center">
                    <img src="images/announcement.png" class="img-fluid rounded-start" 
                         alt="Image" style="height: 200px; object-fit: contain; padding: 50px;">
                </div>

                <!-- Text on the Right -->
                <div class="col-md-10">
                    <div class="card-body-announcements">
                        <h3 class="card-title">Title Title</h3>
                        <p class="card-text">
                            HAHAHAHHHAHAHAHAHAHAHAHAHHA
                        </p>
                        <br>
                        <p class="card-text"><small class="text-muted">March 1, 2025</small></p>
                    </div>
                </div>
            </div>
        </div>
        {{-- for each --}}
    </div>
</div>

<script>
    function hideAnnouncement(button) {
        button.parentElement.style.display = 'none';
    }
</script>


