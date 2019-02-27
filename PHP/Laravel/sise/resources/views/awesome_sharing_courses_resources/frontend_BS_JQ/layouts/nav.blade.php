      <nav class="navbar navbar-expand-md navbar-dark bg-light">
        <div class="container">
          {{-- <a class="navbar-brand absolute" href="index.html">Skwela</a> --}}
          {{-- <a class="navbar-brand absolute" href="index.html">精品课程资源共享网站</a> --}}
          <a class="navbar-brand absolute" href="/frontend">精品课程资源共享网站</a>
          <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarsExample05" aria-controls="navbarsExample05" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
          </button>

          <div class="collapse navbar-collapse navbar-light" id="navbarsExample05">
            <ul class="navbar-nav mx-auto">
              <li class="nav-item">
                {{-- <a class="nav-link active" href="index.html">Home</a> --}}
                <a class="nav-link active" href="/frontend">首页</a>
              </li>
              <li class="nav-item dropdown">
                {{-- <a class="nav-link dropdown-toggle" href="courses.html" id="dropdown04" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Online Courses</a> --}}
                <a class="nav-link dropdown-toggle" href="courses.html" id="dropdown04" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">在想课程</a>
                <div class="dropdown-menu" aria-labelledby="dropdown04">
                    {{-- @forelse ($coursetypes as $coursetype) --}}
                    @forelse ($all_coursetypes as $coursetype)
                       {{-- <a class="dropdown-item" href="/frontend/courses/{{ $coursetype->id }}">{{ $coursetype->type }}</a> --}}
                       {{-- <a class="dropdown-item" href="/frontend/courses?coursetype={{ $coursetype->id }}">{{ $coursetype->type }}</a> --}}
                       @if ($coursetype->enabled === 1)
                         <a class="dropdown-item" href="/frontend/courses/{{ $coursetype->id }}">{{ $coursetype->type }}</a>
                       @endif
                    @empty
                       <a class="dropdown-item" href="javascript:;">没有课程</a> 
                    @endforelse
                  {{-- <a class="dropdown-item" href="courses.html">HTML</a>
                  <a class="dropdown-item" href="courses.html">WordPress</a>
                  <a class="dropdown-item" href="courses.html">Web Development</a>
                  <a class="dropdown-item" href="courses.html">Javascript</a>
                  <a class="dropdown-item" href="courses.html">Photoshop</a> --}}
                </div>

              </li>

              <li class="nav-item dropdown">
                {{-- <a class="nav-link dropdown-toggle" href="#" id="dropdown05" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Categories</a> --}}
                <a class="nav-link dropdown-toggle" href="#" id="dropdown05" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">文件共享</a>
                <div class="dropdown-menu" aria-labelledby="dropdown05">
                    {{-- @forelse ($filetypes as $filetype) --}}
                    @forelse ($all_filetypes as $filetype)
                       {{-- <a class="dropdown-item" href="/frontend/files?filetype={{ $filetype->id }}">{{ $filetype->type }}</a> --}}
                       @if ($filetype->enabled === 1)
                        <a class="dropdown-item" href="/frontend/files/{{ $filetype->id }}">{{ $filetype->type }}</a>
                       @endif
                    @empty
                       <a class="dropdown-item" href="javascript:;">没有文件</a> 
                    @endforelse
                  {{-- <a class="dropdown-item" href="#">HTML</a>
                  <a class="dropdown-item" href="#">WordPress</a>
                  <a class="dropdown-item" href="#">Web Development</a>
                  <a class="dropdown-item" href="#">Javascript</a>
                  <a class="dropdown-item" href="#">Photoshop</a> --}}
                </div>

              </li>
              {{-- <li class="nav-item">
                <a class="nav-link" href="blog.html">Blog</a>
              </li> --}}
              {{-- <li class="nav-item">
                <a class="nav-link" href="about.html">About</a>
              </li> --}}
              <li class="nav-item">
                {{-- <a class="nav-link" href="contact.html">Contact</a> --}}
                {{-- <a class="nav-link" href="contact.html">联系我们</a> --}}
                <a class="nav-link" href="/frontend/contact_uses">联系我们</a>
              </li>
            </ul>
            <ul class="navbar-nav absolute-right">
                @if(!Auth::check())
              {{-- <li class="nav-item">
                <a href="/login" class="nav-link">登录</a>
              </li>
              <li class="nav-item">
                <a href="/register" class="nav-link">注册</a>
              </li> --}}
                @else
              <li>
                {{-- <a href="{{ route('logout') }}" class="nav-link">退出登录</a> --}}
                                <a href="{{ route('logout') }}" class="nav-link"
                                   onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                    退出登录
                                </a>

                                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                    {{ csrf_field() }}
                                </form>
              </li>
                @endif
            </ul>
            
          </div>
        </div>
      </nav>