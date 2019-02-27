<!doctype html>
<html lang="en">
  <head>
    <title></title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    @include('awesome_sharing_courses_resources.frontend_BS_JQ.layouts.common_css')
  </head>
  <body>
    
    <header role="banner">
     
      @include('awesome_sharing_courses_resources.frontend_BS_JQ.layouts.nav')
    </header>
    <!-- END header -->

    {{-- <section class="site-hero overlay" data-stellar-background-ratio="0.5" style="background-image: url({{ asset('sise/frontend/images/webdesign.jpg') }});"> --}}
    <section class="site-hero overlay" data-stellar-background-ratio="0.5" style="background-image: url({{ asset('sise/frontend/images/big_image_1.jpg') }});">
      <div class="container">
        <div class="row align-items-center site-hero-inner justify-content-center">
          <div class="col-md-12">

            <div class="mb-5 element-animate">
              <div class="row align-items-center">
                <div class="col-md-8">
                  {{-- <h1 class="mb-0">Web Design 101</h1> --}}
                  <h1 class="mb-0">{{ $course->title }}</h1>
                  {{-- <p>By Gregg White</p> --}}
                  <p>{{ $course->user->name }}</p>
                  {{-- <p class="lead mb-5">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Perspiciatis, fuga.</p> --}}
                  <p class="lead mb-5">{{ $course->description }}</p>
                  
                  {{-- <p><a href="#" class="btn btn-primary mr-2">Start Series</a> <a href="#" class="btn btn-outline-white">Add To Watch List</a></p> --}}
                </div>
                <div class="col-md-4">
                  {{-- <img src="images/webdesign.jpg" alt="Image placeholder" class="img-fluid"> --}}
                </div>
              </div>
            </div>

            

            
          </div>
        </div>
      </div>
    </section>
    <!-- END section -->

    
     <section class="site-section episodes">
      <div class="container">
        @for ($i = 0; $i < count($course->files); $i++)
        <div class="row bg-light align-items-center p-4 episode">
          <div class="col-md-3">
            <span class="episode-number">{{ $i + 1 }}</span>
          </div>
          <div class="col-md-9">
            {{-- <p class="meta">Episode 1 <a href="#">Runtime 2:53</a></p> --}}
            {{-- <h2><a href="#">Some Title Here For The Video</a></h2> --}}
            <h2><a href="/storage/{{ $course->files[$i]->file_path }}">{{ $course->files[$i]->title }}</a></h2>
            {{-- <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Architecto, fugit!</p> --}}
            {{-- <p>{{ $course->files[$i]->title }}</p> --}}
          </div>
        </div>
        @endfor

        {{-- <div class="row align-items-center p-4 episode">
          <div class="col-md-3">
            <span class="episode-number">2</span>
          </div>
          <div class="col-md-9">
            <p class="meta">Episode 2 <a href="#">Runtime 5:12</a></p>
            <h2><a href="#">Some Title Here For The Video</a></h2>
            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Architecto, fugit!</p>
          </div> --}}
        </div>
    </section>

    {{-- <section class="site-section bg-light">
      <div class="container">
        <div class="row justify-content-center mb-5">
          <div class="col-md-7 text-center">
            <h2>You May Also Like</h2>
            <p class="lead">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Earum magnam illum maiores adipisci pariatur, eveniet.</p>
          </div>
        </div>
      

        <div class="row top-course">
          <div class="col-lg-2 col-md-4 col-sm-6 col-12">
            <a href="#" class="course">
              <img src="images/webdesign.jpg" alt="Image placeholder">
              <h2>Web Design 101</h2>
              <p>Enroll Now</p>
            </a>
          </div>
        <!-- END row -->

        
      </div>
    </section>
    <!-- END section --> --}}

   
{{-- 
    <section class="site-section">
      <div class="container">
        <div class="row justify-content-center mb-5">
          <div class="col-md-7 text-center">
            <h2>Meet Your Instructors</h2>
            <p class="lead">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Earum magnam illum maiores adipisci pariatur, eveniet.</p>
          </div>
        </div>
        <section class="school-features text-dark d-flex">
        </section> --}}

        {{-- <section class="school-features text-dark last d-flex">

          <div class="inner">
            <div class="media d-block feature text-center">
              <img src="images/person_1.jpg" alt="Image placeholder" class="mb-3">
              <div class="media-body">
                <h3 class="mt-0">Rhea Smith</h3>
                <p class="instructor-meta">WordPress Expert</p>
                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Tempora fuga suscipit numquam esse saepe quam, eveniet iure assumenda dignissimos aliquam!</p>
              </div>
            </div>
        </section> --}}


      </div>
    </section>
    <!-- END section -->

    {{-- <section class="section-cover bg-dark">
      <div class="container">
        <div class="row justify-content-center align-items-center intro">
          <div class="col-md-7 text-center element-animate">
            <h2>Sign Up And Get a 7-day Free Trial</h2>
            <p class="lead mb-5">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Architecto quidem tempore expedita facere facilis, dolores!</p>
            <p><a href="#" class="btn btn-primary">Sign up and get a 7-day free trial</a></p>
          </div>
        </div>
      </div>
    </section>
    <!-- END section --> --}}

    
  
    {{-- @include('awesome_sharing_courses_resources.frontend_BS_JQ.layouts.common_footer') --}}
    
    <!-- loader -->
    <div id="loader" class="show fullscreen"><svg class="circular" width="48px" height="48px"><circle class="path-bg" cx="24" cy="24" r="22" fill="none" stroke-width="4" stroke="#eeeeee"/><circle class="path" cx="24" cy="24" r="22" fill="none" stroke-width="4" stroke-miterlimit="10" stroke="#f4b214"/></svg></div>

    @include('awesome_sharing_courses_resources.frontend_BS_JQ.layouts.common_js')
  </body>
</html>