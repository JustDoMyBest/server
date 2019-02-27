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

    <section class="site-hero overlay" data-stellar-background-ratio="0.5" style="background-image: url({{ asset('sise/frontend/images/big_image_1.jpg') }});">
      <div class="container">
        <div class="row align-items-center site-hero-inner justify-content-center">
          <div class="col-md-8 text-center">

            <div class="mb-5 element-animate">
              {{-- <h1>Level Up Your Skills</h1> --}}
              <h1>提升您的技能</h1>
              {{-- <p class="lead">See our courses Below. Learn something new every day with skwela lorem ipsum dolor sit amet.</p> --}}
              <p class="lead">向下滚动查看您的搜索结果。</p>
              {{-- <p><a href="#" class="btn btn-primary">Sign up and get a 7-day free trial</a></p> --}}
              {{-- <p><a href="#" class="btn btn-primary">注册后更多惊喜等着您!</a></p> --}}
            </div>

            
          </div>
        </div>
      </div>
    </section>
    <!-- END section -->


    <section class="site-section bg-light">
      <div class="container">
        <div class="row justify-content-center mb-5">
          <div class="col-md-7 text-center">
            {{-- <h2>Our Courses</h2>
            <p class="lead">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Earum magnam illum maiores adipisci pariatur, eveniet.</p> --}}
            <h2>我们的课程</h2>
            <p class="lead">静心学习我们的所有课程，你就有可能月薪几十万咯!!</p>
          </div>
        </div>
        <div class="row top-course">
          {{-- @forelse ($coursetype->courses as $course) --}}
          @forelse ($courses as $course)
          {{-- @if ($course->enable === 1) --}}
          <div class="col-lg-2 col-md-4 col-sm-6 col-12">
            {{-- <a href="course-single.html" class="course"> --}}
            {{-- <a href="/frontend/courses/{{ $coursetype->id }}/{{ $course->id }}" class="course"> --}}
            <a href="/frontend/courses/{{ $course->coursetype_id }}/{{ $course->id }}" class="course">
              {{-- <img src="{{ asset('sise/frontend/images/webdesign.jpg') }}" alt="Image placeholder"> --}}
              <h2>{{ $course->title }}</h2>
              <p>{{ $course->description }}</p>
            </a>
          </div>
          {{-- @endif --}}
          @empty
          {{-- <div class="col-md-4 col-sm-6 col-12"> --}}
          <div class="col-lg-12 col-md-12 col-sm-12 col-12">
            <a href="javascript:;" class="course">
              {{-- <img src="{{ asset('sise/frontend/images/webdesign.jpg') }}" alt="Image placeholder"> --}}
              {{-- <h1 align='center'>当前类型没有课程</h1> --}}
              <h1 align='center'>没有课程包含关键字&nbsp;"{{ session('text') }}"</h1>
              {{-- <p>Enroll Now</p> --}}
            </a>
          </div>
          @endforelse
          {{-- {{ $courses->render() }} --}}
        </div>
          {{-- {{ $files->links() }} --}}
        <!-- END row -->

        {{-- <div class="row top-course">
          <div class="col-lg-2 col-md-4 col-sm-6 col-12">
            <a href="course-single.html" class="course">
              <img src="{{ asset('sise/frontend/images/webdesign.jpg') }}" alt="Image placeholder">
              <h2>Web Design 101</h2>
              <p>Enroll Now</p>
            </a>
          </div>
          <div class="col-lg-2 col-md-4 col-sm-6 col-12">
            <a href="course-single.html" class="course">
              <img src="{{ asset('sise/frontend/images/wordpress.jpg') }}" alt="Image placeholder">
              <h2>Learn How To Develop WordPress Plugin</h2>
              <p>Enroll Now</p>
            </a>
          </div>
          <div class="col-lg-2 col-md-4 col-sm-6 col-12">
            <a href="course-single.html" class="course">
              <img src="{{ asset('sise/frontend/images/javascript.jpg') }}" alt="Image placeholder">
              <h2>JavaScript 101</h2>
              <p>Enroll Now</p>
            </a>
          </div>
          <div class="col-lg-2 col-md-4 col-sm-6 col-12">
            <a href="course-single.html" class="course">
              <img src="{{ asset('sise/frontend/images/photoshop.jpg') }}" alt="Image placeholder">
              <h2>Photoshop Design 101</h2>
              <p>Enroll Now</p>
            </a>
          </div>
          <div class="col-lg-2 col-md-4 col-sm-6 col-12">
            <a href="course-single.html" class="course">
              <img src="{{ asset('sise/frontend/images/reactjs.jpg') }}" alt="Image placeholder">
              <h2>Learn Native ReactJS</h2>
              <p>Enroll Now</p>
            </a>
          </div>
          <div class="col-lg-2 col-md-4 col-sm-6 col-12">
            <a href="course-single.html" class="course">
              <img src="{{ asset('sise/frontend/images/angularjs.jpg') }}" alt="Image placeholder">
              <h2>Learn AngularJS 2</h2>
              <p>Enroll Now</p>
            </a>
          </div>
        </div> --}}
        <!-- END row -->

        
        {{-- <div class="row top-course">
          <div class="col-md-4 col-sm-6 col-12">
            <a href="course-single.html" class="course">
              <img src="{{ asset('sise/frontend/images/photoshop.jpg') }}" alt="Image placeholder">
              <h2>Photoshop Design 101</h2>
              <p>Enroll Now</p>
            </a>
          </div>
          <div class="col-md-4 col-sm-6 col-12">
            <a href="course-single.html" class="course">
              <img src="{{ asset('sise/frontend/images/reactjs.jpg') }}" alt="Image placeholder">
              <h2>Learn Native ReactJS</h2>
              <p>Enroll Now</p>
            </a>
          </div>
          <div class="col-md-4 col-sm-6 col-12">
            <a href="course-single.html" class="course">
              <img src="{{ asset('sise/frontend/images/angularjs.jpg') }}" alt="Image placeholder">
              <h2>Learn AngularJS 2</h2>
              <p>Enroll Now</p>
            </a>
          </div>
        </div> --}}
        <!-- END row -->
      </div>
    </section>

    

    <section class="site-section bg-light">
      <div class="container">
        <div class="row justify-content-center mb-5">
          <div class="col-md-7 text-center">
            {{-- <h2>Our Courses</h2>
            <p class="lead">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Earum magnam illum maiores adipisci pariatur, eveniet.</p> --}}
            <h2>我们的文件</h2>
            <p class="lead">我们共享的所有文件，点击就能在线浏览或者下载咯，右键另存为还能直接下载图片、视频等文件哦!!</p>
          </div>
        </div>
        <div class="row top-course">
          {{-- @forelse ($coursetype->courses as $course) --}}
          @forelse ($files as $file)
          {{-- @if ($file->enable === 1) --}}
          <div class="col-lg-2 col-md-4 col-sm-6 col-12">
            {{-- <a href="file-single.html" class="file"> --}}
            {{-- <a href="/frontend/files/{{ $filetype->id }}/{{ $file->id }}" class="file"> --}}
            <a href="/storage/{{ $file->file_path }}" class="file">
              {{-- <img src="{{ asset('sise/frontend/images/webdesign.jpg') }}" alt="Image placeholder"> --}}
              <h2>{{ $file->title }}</h2>
              <p>{{ $file->description }}</p>
            </a>
          </div>
          {{-- @endif --}}
          @empty
          {{-- <div class="col-md-4 col-sm-6 col-12"> --}}
          <div class="col-lg-12 col-md-12 col-sm-12 col-12">
            <a href="javascript:;" class="course">
              {{-- <img src="{{ asset('sise/frontend/images/webdesign.jpg') }}" alt="Image placeholder"> --}}
              {{-- <h1 align='center'>当前类型没有文件</h1> --}}
              <h1 align='center'>没有文件包含关键字&nbsp;"{{ session('text') }}"</h1>
              {{-- <p>Enroll Now</p> --}}
            </a>
          </div>
          @endforelse
        </div>
      </div>
    </section>
    <!-- END section -->

    {{-- <section class="site-section">
      <div class="container">
        <div class="row justify-content-center mb-5">
          <div class="col-md-7 text-center">
            <h2>Meet Your Instructors</h2>
            <p class="lead">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Earum magnam illum maiores adipisci pariatur, eveniet.</p>
          </div>
        </div>
        <section class="school-features text-dark d-flex">

          <div class="inner">
            <div class="media d-block feature text-center">
              <img src="{{ asset('sise/frontend/images/person_1.jpg') }}" alt="Image placeholder" class="mb-3">
              <div class="media-body">
                <h3 class="mt-0">Rhea Smith</h3>
                <p class="instructor-meta">WordPress Expert</p>
                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Tempora fuga suscipit numquam esse saepe quam, eveniet iure assumenda dignissimos aliquam!</p>
              </div>
            </div>

            <div class="media d-block feature text-center">
              <img src="{{ asset('sise/frontend/images/person_2.jpg') }}" alt="Image placeholder" class="mb-3">
              <div class="media-body">
                <h3 class="mt-0">Gregg White</h3>
                <p class="instructor-meta">HTML4, CSS3 Expert</p>
                <p>Delectus fuga voluptatum minus amet, mollitia distinctio assumenda voluptate quas repellat eius quisquam odio. Aliquam, laudantium, optio? Error velit, alias.</p>
              </div>
            </div>

            <div class="media d-block feature text-center">
              <img src="{{ asset('sise/frontend/images/person_3.jpg') }}" alt="Image placeholder" class="mb-3">
              <div class="media-body">
                <h3 class="mt-0">Rob Gold</h3>
                <p class="instructor-meta">JS Expert</p>
                <p>Delectus fuga voluptatum minus amet, mollitia distinctio assumenda voluptate quas repellat eius quisquam odio. Aliquam, laudantium, optio? Error velit, alias.</p>
              </div>
            </div>


            <div class="media d-block feature text-center">
              <img src="{{ asset('sise/frontend/images/person_4.jpg') }}" alt="Image placeholder" class="mb-3">
              <div class="media-body">
                <h3 class="mt-0">Wennie Poe</h3>
                <p class="instructor-meta">Angular JS Expert</p>
                <p>Harum, adipisci, aspernatur. Vero repudiandae quos ab debitis, fugiat culpa obcaecati, voluptatibus ad distinctio cum soluta fugit sed animi eaque?</p>
              </div>
            </div>
          </div>
        </section>

        <section class="school-features text-dark last d-flex">

          <div class="inner">
            <div class="media d-block feature text-center">
              <img src="{{ asset('sise/frontend/images/person_1.jpg') }}" alt="Image placeholder" class="mb-3">
              <div class="media-body">
                <h3 class="mt-0">Rhea Smith</h3>
                <p class="instructor-meta">WordPress Expert</p>
                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Tempora fuga suscipit numquam esse saepe quam, eveniet iure assumenda dignissimos aliquam!</p>
              </div>
            </div>

            <div class="media d-block feature text-center">
              <img src="{{ asset('sise/frontend/images/person_2.jpg') }}" alt="Image placeholder" class="mb-3">
              <div class="media-body">
                <h3 class="mt-0">Gregg White</h3>
                <p class="instructor-meta">Photoshop Expert</p>
                <p>Delectus fuga voluptatum minus amet, mollitia distinctio assumenda voluptate quas repellat eius quisquam odio. Aliquam, laudantium, optio? Error velit, alias.</p>
              </div>
            </div>

            <div class="media d-block feature text-center">
              <img src="{{ asset('sise/frontend/images/person_3.jpg') }}" alt="Image placeholder" class="mb-3">
              <div class="media-body">
                <h3 class="mt-0">Rob Gold</h3>
                <p class="instructor-meta">Web Design Expert</p>
                <p>Delectus fuga voluptatum minus amet, mollitia distinctio assumenda voluptate quas repellat eius quisquam odio. Aliquam, laudantium, optio? Error velit, alias.</p>
              </div>
            </div>


            <div class="media d-block feature text-center">
              <img src="{{ asset('sise/frontend/images/person_4.jpg') }}" alt="Image placeholder" class="mb-3">
              <div class="media-body">
                <h3 class="mt-0">Wennie Poe</h3>
                <p class="instructor-meta">React JS Expert</p>
                <p>Harum, adipisci, aspernatur. Vero repudiandae quos ab debitis, fugiat culpa obcaecati, voluptatibus ad distinctio cum soluta fugit sed animi eaque?</p>
              </div>
            </div>
          </div>
        </section>


      </div>
    </section> --}}
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