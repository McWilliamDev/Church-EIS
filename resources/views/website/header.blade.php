<div class="mobile_menu">
   <nav class="navbar navbar-expand-lg navbar-light bg-light">
      <div class="logo_mobile">
         <img src="images/LogoTransparentWhite.png" style="width: 80px">
      </div>
      <button class="navbar-toggler" type="button" id="navbar-toggler" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
         <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarNav">
         <ul class="navbar-nav">
           <li><a href="{{ route('home') }}">Home</a></li>
           <li><a href="{{ route(name: 'ministry') }}">Ministry</a></li>
           <li><a href="{{ route('event') }}">Events</a></li>
           <li><a href="{{ route('resources') }}">Resources</a></li>
         </ul>
      </div>
   </nav>
</div>

<div class="container-fluid">
   <div class="logo"><img src="images/LogoTransparentWhite.png" style="width: 150px"></div>
   <div class="menu_main">
      <ul> 
        <li><a href="{{ route('home') }}">Home</a></li>
        <li><a href="{{ route(name: 'ministry') }}">Ministry</a></li>
        <li><a href="{{ route('event') }}">Events</a></li>
        <li><a href="{{ route('resources') }}">Resources</a></li>
      </ul>
   </div>
</div>

<script>
   document.addEventListener("DOMContentLoaded", function() {
       const navToggle = document.getElementById("navbar-toggler");
       const navbarNav = document.getElementById("navbarNav");
       const navLinks = navbarNav.querySelectorAll("a"); // Select all navbar links

       // Toggle navbar on button click
       navToggle.addEventListener("click", function() {
           navbarNav.classList.toggle("show");
       });

       // Collapse navbar when a link is clicked
       navLinks.forEach(link => {
           link.addEventListener("click", function() {
               navbarNav.classList.remove("show"); // Remove "show" to collapse
           });
       });
   });
</script>

<style>
   /* Ensure smooth transition */
   .collapse {
       display: none;
       transition: max-height 0.3s ease-in-out;
   }

   .collapse.show {
       display: block;
   }

   .navbar-nav li {
      color: #ffffff;
      padding: 10px 20px;
      font-weight: 500;
      text-transform: uppercase;
   }

   .navbar-nav a {
      color: #ffffff;
   }

   .navbar-nav a:hover {
      color: #ffffff;
      padding: 10px 20px;
   }
</style>
