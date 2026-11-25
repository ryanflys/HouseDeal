<!DOCTYPE html>
<html lang="zh-CN">
<head>
    <title>@yield('title', 'HouseDeal 后台管理')</title>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="{{ asset('css/bootstrap.min.css') }}" />
    <link rel="stylesheet" href="{{ asset('css/bootstrap-responsive.min.css') }}" />
    <link rel="stylesheet" href="{{ asset('css/matrix-style.css') }}" />
    <link rel="stylesheet" href="{{ asset('css/matrix-media.css') }}" />
    <link href="{{ asset('font-awesome/css/font-awesome.css') }}" rel="stylesheet" />
    <link href="{{ asset('css/fonts_googleapis.css') }}" rel='stylesheet' type='text/css'>
    @stack('styles')
</head>
<body>

<!--Header-->
<div id="header">
    <h1><a href="{{ route('admin.index') }}">HouseDeal 后台</a></h1>
</div>

<!--User Nav-->
<div id="user-nav" class="navbar navbar-inverse">
    <ul class="nav">
        <li class="dropdown" id="profile-messages">
            <a title="" href="#" data-toggle="dropdown" data-target="#profile-messages" class="dropdown-toggle">
                <i class="icon icon-user"></i> <span class="text">{{ Auth::user()->name }}</span> <b class="caret"></b>
            </a>
            <ul class="dropdown-menu">
                <li><a href="{{ route('user.dashboard') }}"><i class="icon-user"></i> 个人中心</a></li>
                <li class="divider"></li>
                <li>
                    <form action="{{ route('logout') }}" method="POST" style="display:inline;">
                        {{ csrf_field() }}
                        <button type="submit" class="btn btn-link" style="padding: 3px 20px; text-align: left;"><i class="icon-key"></i> 退出登录</button>
                    </form>
                </li>
            </ul>
        </li>
        <li class=""><a title="" href="{{ route('home') }}"><i class="icon icon-share-alt"></i> <span class="text">返回前台</span></a></li>
    </ul>
</div>

<!--Sidebar-->
<div id="sidebar"><a href="#" class="visible-phone"><i class="icon icon-home"></i> Dashboard</a>
    <ul>
        <li class="{{ request()->routeIs('admin.index') ? 'active' : '' }}"><a href="{{ route('admin.index') }}"><i class="icon icon-home"></i> <span>仪表盘</span></a></li>
        <li class="{{ request()->routeIs('admin.houses.*') ? 'active' : '' }}"><a href="{{ route('admin.houses.index') }}"><i class="icon icon-th"></i> <span>房源管理</span></a></li>
        <li class="{{ request()->routeIs('admin.users.*') ? 'active' : '' }}"><a href="{{ route('admin.users.index') }}"><i class="icon icon-user"></i> <span>用户管理</span></a></li>
        <li class="{{ request()->routeIs('admin.agents.*') ? 'active' : '' }}"><a href="{{ route('admin.agents.index') }}"><i class="icon icon-briefcase"></i> <span>经纪人管理</span></a></li>
        <li class="{{ request()->routeIs('admin.deals.*') ? 'active' : '' }}"><a href="{{ route('admin.deals.index') }}"><i class="icon icon-tags"></i> <span>交易管理</span></a></li>
    </ul>
</div>

<!--Content-->
<div id="content">
    <div id="content-header">
        <div id="breadcrumb">
            <a href="{{ route('admin.index') }}" title="返回首页" class="tip-bottom"><i class="icon-home"></i> 后台首页</a>
            @yield('breadcrumb')
        </div>
    </div>

    @if(session('success'))
        <div class="alert alert-success"><button class="close" data-dismiss="alert">&times;</button>{{ session('success') }}</div>
    @endif
    @if(session('error'))
        <div class="alert alert-error"><button class="close" data-dismiss="alert">&times;</button>{{ session('error') }}</div>
    @endif

    <div class="container-fluid">
        @yield('content')
    </div>
</div>

<div class="row-fluid">
    <div id="footer" class="span12">{{ date('Y') }} &copy; HouseDeal 房产交易平台 · MIT License</div>
</div>

<script src="{{ asset('js/excanvas.min.js') }}"></script>
<script src="{{ asset('js/jquery.min.js') }}"></script>
<script src="{{ asset('js/jquery.ui.custom.js') }}"></script>
<script src="{{ asset('js/bootstrap.min.js') }}"></script>
<script src="{{ asset('js/matrix.js') }}"></script>
@stack('scripts')
</body>
</html>
