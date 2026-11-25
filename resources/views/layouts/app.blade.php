<!DOCTYPE html>
<html lang="zh-CN">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'HouseDeal - 房产交易平台')</title>
    <link rel="stylesheet" href="{{ asset('css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('font-awesome/css/font-awesome.css') }}">
    <link rel="stylesheet" href="{{ asset('css/matrix-style.css') }}">
    <link rel="stylesheet" href="{{ asset('css/matrix-media.css') }}">
    <link href="{{ asset('css/fonts_googleapis.css') }}" rel='stylesheet' type='text/css'>
    <style>
        .navbar-brand { font-size: 22px; font-weight: bold; color: #fff; }
        .house-card { transition: transform 0.3s, box-shadow 0.3s; }
        .house-card:hover { transform: translateY(-4px); box-shadow: 0 8px 25px rgba(0,0,0,0.15); }
        .house-img { height: 200px; object-fit: cover; width: 100%; }
        .price-tag { color: #e74c3c; font-size: 18px; font-weight: bold; }
        .badge-status { font-size: 12px; }
        .footer { background: #2c3e50; color: #ecf0f1; padding: 30px 0; margin-top: 40px; }
        .footer a { color: #3498db; }
        .search-bar { background: #34495e; padding: 20px 0; }
        .search-bar input { border-radius: 4px; }
    </style>
    @stack('styles')
</head>
<body>

<!-- Navigation -->
<nav class="navbar navbar-inverse" style="border-radius:0;">
    <div class="container-fluid">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#navbar">
                <span class="icon-bar"></span><span class="icon-bar"></span><span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="{{ route('home') }}">HouseDeal</a>
        </div>
        <div class="collapse navbar-collapse" id="navbar">
            <ul class="nav navbar-nav">
                <li class="{{ request()->routeIs('home') ? 'active' : '' }}"><a href="{{ route('home') }}">首页</a></li>
                <li class="{{ request()->routeIs('houses.index') ? 'active' : '' }}"><a href="{{ route('houses.index') }}">二手房</a></li>
                <li><a href="{{ route('houses.index', ['type' => 'new']) }}">新房</a></li>
                <li><a href="{{ route('houses.index', ['type' => 'rent']) }}">租房</a></li>
            </ul>
            <ul class="nav navbar-nav navbar-right">
                @guest
                    <li><a href="{{ route('login') }}"><i class="icon-key"></i> 登录</a></li>
                    <li><a href="{{ route('register') }}"><i class="icon-user"></i> 注册</a></li>
                @else
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                            <i class="icon icon-user"></i> {{ Auth::user()->name }} <b class="caret"></b>
                        </a>
                        <ul class="dropdown-menu">
                            <li><a href="{{ route('user.dashboard') }}"><i class="icon-home"></i> 个人中心</a></li>
                            <li><a href="{{ route('user.houses') }}"><i class="icon-th-list"></i> 我的房源</a></li>
                            <li><a href="{{ route('user.favorites') }}"><i class="icon-heart"></i> 我的收藏</a></li>
                            @if(Auth::user()->isAdmin())
                                <li class="divider"></li>
                                <li><a href="{{ route('admin.index') }}"><i class="icon-cog"></i> 后台管理</a></li>
                            @endif
                            <li class="divider"></li>
                            <li>
                                <form action="{{ route('logout') }}" method="POST" style="display:inline;">
                                    {{ csrf_field() }}
                                    <button type="submit" class="btn btn-link" style="padding: 3px 20px;"><i class="icon-share-alt"></i> 退出</button>
                                </form>
                            </li>
                        </ul>
                    </li>
                @endguest
            </ul>
        </div>
    </div>
</nav>

<!-- Search Bar -->
<div class="search-bar">
    <div class="container">
        <form action="{{ route('houses.index') }}" method="GET" class="row">
            <div class="col-md-8">
                <input type="text" name="keyword" class="form-control input-lg" placeholder="搜索区域、小区、户型..." value="{{ request('keyword') }}">
            </div>
            <div class="col-md-2">
                <select name="type" class="form-control input-lg">
                    <option value="">全部类型</option>
                    <option value="new" {{ request('type') == 'new' ? 'selected' : '' }}>新房</option>
                    <option value="second" {{ request('type') == 'second' ? 'selected' : '' }}>二手房</option>
                    <option value="rent" {{ request('type') == 'rent' ? 'selected' : '' }}>租房</option>
                </select>
            </div>
            <div class="col-md-2">
                <button type="submit" class="btn btn-primary btn-lg btn-block"><i class="icon-search"></i> 搜索</button>
            </div>
        </form>
    </div>
</div>

<!-- Flash Messages -->
@if(session('success'))
    <div class="alert alert-success alert-dismissible" style="margin:10px 0;">
        <button type="button" class="close" data-dismiss="alert">&times;</button>
        {{ session('success') }}
    </div>
@endif
@if(session('error'))
    <div class="alert alert-danger alert-dismissible" style="margin:10px 0;">
        <button type="button" class="close" data-dismiss="alert">&times;</button>
        {{ session('error') }}
    </div>
@endif

<!-- Main Content -->
<div class="container" style="margin-top: 20px; margin-bottom: 40px;">
    @yield('content')
</div>

<!-- Footer -->
<div class="footer">
    <div class="container">
        <div class="row">
            <div class="col-md-6">
                <h4>HouseDeal</h4>
                <p>开箱即用的房产交易网站模板，基于 Laravel 5.4 构建，支持二手房、新房、租房交易管理。</p>
                <p>MIT License &copy; {{ date('Y') }} HouseDeal</p>
            </div>
            <div class="col-md-3">
                <h5>快速链接</h5>
                <ul class="list-unstyled">
                    <li><a href="{{ route('home') }}">首页</a></li>
                    <li><a href="{{ route('houses.index') }}">房源列表</a></li>
                    <li><a href="{{ route('houses.index', ['type' => 'new']) }}">新房</a></li>
                    <li><a href="{{ route('houses.index', ['type' => 'rent']) }}">租房</a></li>
                </ul>
            </div>
            <div class="col-md-3">
                <h5>关于</h5>
                <ul class="list-unstyled">
                    <li><a href="https://github.com/ryanflys/HouseDeal">GitHub 项目</a></li>
                    <li><a href="https://github.com/ryanflys/HouseDeal/issues">问题反馈</a></li>
                </ul>
            </div>
        </div>
    </div>
</div>

<script src="{{ asset('js/jquery.min.js') }}"></script>
<script src="{{ asset('js/bootstrap.min.js') }}"></script>
@stack('scripts')
</body>
</html>
