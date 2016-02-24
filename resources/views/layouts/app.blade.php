<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>
        Old Books
        @yield('title')
    </title>
    <!-- Fonts -->
    <link href="//cdnjs.cloudflare.com/ajax/libs/font-awesome/4.4.0/css/font-awesome.min.css" rel='stylesheet'
          type='text/css'>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.2-rc.1/css/select2.min.css" rel="stylesheet" />
    {{--<link href="//cdn.bootcss.com/bootstrap/3.3.6/css/bootstrap.css" rel="stylesheet">--}}
     <link href="{{ elixir('css/app.css') }}" rel="stylesheet">

</head>

<body role="application">
<nav class="nav navbar-default">
    <div class="container">
        <div class="navbar-header">
            <!-- Collapsed Hamburger -->
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse"
                    data-target="#app-navbar-collapse">
                <span class="sr-only">Toggle Navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <!-- Branding Image -->
            <a class="navbar-brand" href="{{ url('/') }}">olduncle.wang</a>
        </div>
        <div class="collapse navbar-collapse" id="app-navbar-collapse">
            <ul class="nav navbar-nav navbar-right">
                <li><a href="{{ url('/') }}" class="active" style="font-size: 15px">首页</a></li>
                <li><a href="{{ url('/book') }}" style="font-size: 15px">我要买书</a></li>
                <li><a href="{{ url('/book/create')}}" style="font-size: 15px">我要卖书</a></li>

                @if(!Auth::check())
                    <li><a href="{{url('login')}}" style="font-size: 15px">登录</a></li>
                    <li><a href="{{ url('register') }}" style="font-size: 15px">注册</a></li>
                @else
                    <li class="dropdown dropdown-menu-right">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button"
                           aria-expanded="false"
                           aria-haspopup="true">
                            {{ Auth::user()->name }}
                            @if(($count = Auth::user()->beBoughtOrders()->count())>0)
                                <span class="badge">{{$count}}</span>
                            @endif

                            <span class="caret"></span>
                        </a>

                        <ul class="dropdown-menu" style="font-size: 15px;">
                            <li class="text-center"><a href="{{ url('user',Auth::user()->id) }}">个人中心</a></li>

                            <li><a class="text-center" href="{{ url('logout') }}">退出登录</a></li>
                            @if(isAdmin(Auth::user()))
                                <li role="separator" class="divider"></li>
                                <li><a class="text-center" href="{{ url('/admin') }}">后台</a></li>
                            @endif
                        </ul>
                    </li>
                @endif
            </ul>
        </div>
    </div>

</nav>

<div class="container theme-showcase" role="main">
    @yield('content')
</div>

<footer>

    <p class="text-center">此网站由电子科技大学信息与软件工程学院<a href="http://www.ss.uestc.edu.cn/studio.do?id=247">DA Wizards工作室</a>开发
    </p>

</footer>


<!-- JavaScripts -->
<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/2.1.4/jquery.min.js"></script>
<script src="//cdn.bootcss.com/bootstrap/3.3.6/js/bootstrap.js"></script>
<script src="//cdn.datatables.net/1.10.10/js/jquery.dataTables.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.2-rc.1/js/select2.min.js"></script>
@yield('scripts')
</body>
</html>

