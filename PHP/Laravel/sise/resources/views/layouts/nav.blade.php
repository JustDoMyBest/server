<nav class="navbar navbar-default navbar-static-top">
    <div class="container">
        <div class="navbar-header">

            <!-- Collapsed Hamburger -->
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#app-navbar-collapse">
                <span class="sr-only">Toggle Navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>

            <!-- Branding Image -->
            {{-- <a class="navbar-brand" href="{{ url('/') }}"> --}}
            <a class="navbar-brand" href="javascript:;">
                {{ config('app.name', 'Laravel') }}
            </a>
        </div>

        <div class="collapse navbar-collapse" id="app-navbar-collapse">
            <!-- Left Side Of Navbar -->
            <ul class="nav navbar-nav">
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-hidden="true"
                       {{-- aria-expanded="false">Browse <span class="caret"></span> </a> --}}
                       aria-expanded="false">浏览 <span class="caret"></span> </a>

                    <ul class="dropdown-menu">
                        {{-- <li><a href="/threads">ALL Threads</a> </li> --}}
                        <li><a href="/threads">所有的在线互动学习问答</a> </li>

                        @if(auth()->check())
                            <li><a href="/threads?by={{ auth()->user()->name }}">我的在线互动学习问答</a> </li>
                        @endif

                        <li><a href="/threads?popularity=1">讨论热度排序的在线互动学习问答</a> </li>
                        <li><a href="/threads?unanswered=1">暂未有回复的在线互动学习问答</a> </li>
                    </ul>
                </li>

                {{-- <li><a href="/threads/create">New Thread</a></li> --}}
                <li><a href="/threads/create">新建在线互动学习问答</a></li>

                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-hidden="true"
                       {{-- aria-expanded="false">Channels <span class="caret"></span> </a> --}}
                       aria-expanded="false">在线互动学习问答类型 <span class="caret"></span> </a>

                    <ul class="dropdown-menu">
                        @foreach($channels as $channel)
                            <li><a href="/threads/{{ $channel->slug }}">{{ $channel->name }}</a> </li>
                        @endforeach
                    </ul>
                </li>
            </ul>

            <!-- Right Side Of Navbar -->
            <ul class="nav navbar-nav navbar-right">
                <!-- Authentication Links -->
                @if (Auth::guest())
                    <li><a href="{{ route('login') }}">登录</a></li>
                    <li><a href="{{ route('register') }}">注册</a></li>
                @else
                    <user-notifications></user-notifications>
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
                            {{ Auth::user()->name }} <span class="caret"></span>
                        </a>

                        <ul class="dropdown-menu" role="menu">
                            <li>
                                <a href="{{ route('profile',Auth::user()) }}">My Profile</a>
                            </li>

                            <li>
                                <a href="{{ route('logout') }}"
                                   onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                    Logout
                                </a>

                                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                    {{ csrf_field() }}
                                </form>
                            </li>
                        </ul>
                    </li>
                @endif
            </ul>
        </div>
    </div>
</nav>