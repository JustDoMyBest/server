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
     

      {{-- @include('awesome_sharing_courses_resources.frontend_BS_JQ.layouts.nav', [ 'coursetypes' => $all_coursetypes, 'filetypes' => $all_filetypes]) --}}
      @include('awesome_sharing_courses_resources.frontend_BS_JQ.layouts.nav')
    </header>
    <!-- END header -->

    <section class="site-hero site-hero-innerpage overlay" data-stellar-background-ratio="0.5" style="background-image: url({{ asset('sise/frontend/images/big_image_1.jpg') }});">
      <div class="container">
        <div class="row align-items-center site-hero-inner justify-content-center">
          <div class="col-md-8 text-center">

            <div class="mb-5 element-animate">
              {{-- <h1>Contact Us</h1> --}}
              <h1>联系我们</h1>
            </div>
          </div>
        </div>
      </div>
    </section>
    <!-- END section -->


    <section class="site-section bg-light">
      <div class="container">
        <div class="row">
          <div class="col-md-12">
            {{-- <form action="#" method="post"> --}}
            <form action="{{ route('contact_us.store') }}" method="post">
              {{ csrf_field() }}
                  <div class="row">
                    <div class="col-md-12 form-group">
                      {{-- <label for="name">Name</label>
                      <input type="text" id="name" class="form-control "> --}}
                      <label for="contact_information">联系方式</label>
                      <input name="contact_information" type="text" id="contact_information" class="form-control ">
                    </div>
                    {{-- <div class="col-md-4 form-group">
                      <label for="phone">Phone</label>
                      <input type="text" id="phone" class="form-control ">
                    </div>
                    <div class="col-md-4 form-group">
                      <label for="email">Email</label>
                      <input type="email" id="email" class="form-control ">
                    </div> --}}
                  </div>
                  <div class="row">
                    <div class="col-md-12 form-group">
                      {{-- <label for="message">Write Message</label>
                      <textarea name="message" id="message" class="form-control " cols="30" rows="8"></textarea> --}}
                      <label for="message">建议</label>
                      <textarea name="text" id="message" class="form-control " cols="100%" rows="8"></textarea>
                    </div>
                  </div>
                  <div class="row">
                    {{-- <div class="col-md-6 form-group"> --}}
                    <div class="col-md-6 form-group">
                      {{-- <input type="submit" value="Send Message" class="btn btn-primary"> --}}
                      <input type="submit" value="提交建议" class="btn btn-primary">
                    </div>
                  </div>
                </form>
          </div>
        </div>
      </div>
    </section>
    <!-- END section -->

     {{-- <section class="overflow">
      <div class="container">
        <div class="row justify-content-center align-items-center">
          
          
          <div class="col-lg-7 order-lg-3 order-1 mb-lg-0 mb-5">
            <img src="images/person_testimonial_1.jpg" alt="Image placeholder" class="img-md-fluid">
          </div>
          <div class="col-lg-1 order-lg-2"></div>
          <div class="col-lg-4 order-lg-1 order-2 mb-lg-0 mb-5">
            <blockquote class="testimonial">
              &ldquo; Lorem ipsum dolor sit amet, consectetur adipisicing elit. Nesciunt incidunt nihil ab cumque molestiae commodi. &rdquo;
            </blockquote>
            <p>&mdash; John Doe, Certified ReactJS Student</p>
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