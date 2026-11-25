@extends('layouts.app')

@section('title', '个人中心 - HouseDeal')

@section('content')
<div class="row">
    <div class="col-md-3">
        <div class="panel panel-default">
            <div class="panel-body text-center">
                <img src="{{ $user->avatar ?? '/img/demo/av1.jpg' }}" alt="" style="width: 80px; height: 80px; border-radius: 50%; margin-bottom: 10px;">
                <h4>{{ $user->name }}</h4>
                <p class="text-muted">{{ $user->email }}</p>
                <p>
                    @if($user->isAdmin()) <span class="label label-danger">管理员</span>
                    @elseif($user->isAgent()) <span class="label label-warning">经纪人</span>
                    @else <span class="label label-info">普通用户</span>
                    @endif
                </p>
            </div>
            <div class="list-group">
                <a href="{{ route('user.dashboard') }}" class="list-group-item {{ request()->routeIs('user.dashboard') ? 'active' : '' }}"><i class="icon-home"></i> 个人中心</a>
                <a href="{{ route('user.houses') }}" class="list-group-item {{ request()->routeIs('user.houses') ? 'active' : '' }}"><i class="icon-th-list"></i> 我的房源</a>
                <a href="{{ route('user.favorites') }}" class="list-group-item {{ request()->routeIs('user.favorites') ? 'active' : '' }}"><i class="icon-heart"></i> 我的收藏</a>
            </div>
        </div>
    </div>

    <div class="col-md-9">
        <h2 style="margin-bottom: 20px;"><i class="icon-dashboard"></i> 个人中心</h2>

        <div class="row" style="margin-bottom: 20px;">
            <div class="col-md-4">
                <div class="panel panel-primary">
                    <div class="panel-body text-center"><h1>{{ $houseCount }}</h1><p>我的房源</p></div>
                    <div class="panel-footer"><a href="{{ route('user.houses') }}">查看房源 <i class="icon-arrow-right"></i></a></div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="panel panel-success">
                    <div class="panel-body text-center"><h1>{{ $favoriteCount }}</h1><p>我的收藏</p></div>
                    <div class="panel-footer"><a href="{{ route('user.favorites') }}">查看收藏 <i class="icon-arrow-right"></i></a></div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="panel panel-info">
                    <div class="panel-body text-center"><h1>{{ $recentHouses->count() }}</h1><p>最近发布</p></div>
                </div>
            </div>
        </div>

        <div class="panel panel-default">
            <div class="panel-heading">
                <h3 class="panel-title"><i class="icon-th-large"></i> 最近发布的房源
                    <a href="{{ route('user.houses.create') }}" class="btn btn-primary btn-sm pull-right"><i class="icon-plus"></i> 发布房源</a>
                </h3>
            </div>
            <div class="panel-body">
                @if($recentHouses->isEmpty())
                    <p class="text-center text-muted" style="padding: 30px;">暂未发布房源，<a href="{{ route('user.houses.create') }}">立即发布</a></p>
                @else
                    <div class="table-responsive">
                        <table class="table table-hover">
                            <thead><tr><th>标题</th><th>价格</th><th>状态</th><th>发布时间</th><th>操作</th></tr></thead>
                            <tbody>
                                @foreach($recentHouses as $house)
                                <tr>
                                    <td><a href="{{ route('houses.show', $house->id) }}">{{ $house->title }}</a></td>
                                    <td class="price-tag">{{ $house->formatted_price }}</td>
                                    <td>{{ $house->status }}</td>
                                    <td>{{ $house->created_at->format('Y-m-d') }}</td>
                                    <td>
                                        <a href="{{ route('user.houses.edit', $house->id) }}" class="btn btn-xs btn-warning"><i class="icon-pencil"></i></a>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection
