@extends('layouts.app')

@section('title', '我的收藏 - HouseDeal')

@section('content')
<div class="row">
    <div class="col-md-3">
        <div class="panel panel-default">
            <div class="panel-body text-center">
                <img src="{{ auth()->user()->avatar ?? '/img/demo/av1.jpg' }}" alt="" style="width: 80px; height: 80px; border-radius: 50%; margin-bottom: 10px;">
                <h4>{{ auth()->user()->name }}</h4>
            </div>
            <div class="list-group">
                <a href="{{ route('user.dashboard') }}" class="list-group-item"><i class="icon-home"></i> 个人中心</a>
                <a href="{{ route('user.houses') }}" class="list-group-item"><i class="icon-th-list"></i> 我的房源</a>
                <a href="{{ route('user.favorites') }}" class="list-group-item active"><i class="icon-heart"></i> 我的收藏</a>
            </div>
        </div>
    </div>
    <div class="col-md-9">
        <h2 style="margin-bottom: 20px;"><i class="icon-heart"></i> 我的收藏</h2>
        @if($houses->isEmpty())
            <div class="alert alert-info text-center" style="padding: 40px;">
                <h4>暂无收藏房源</h4>
                <a href="{{ route('houses.index') }}" class="btn btn-primary">浏览房源</a>
            </div>
        @else
            <div class="row">
                @foreach($houses as $house)
                <div class="col-md-4 col-sm-6" style="margin-bottom: 20px;">
                    <div class="house-card thumbnail" style="margin-bottom: 0;">
                        <img src="{{ $house->cover }}" class="house-img" alt="{{ $house->title }}">
                        <div class="caption">
                            <h5 style="height: 40px; overflow: hidden;">
                                <a href="{{ route('houses.show', $house->id) }}">{{ $house->title }}</a>
                            </h5>
                            <p class="price-tag">{{ $house->formatted_price }}</p>
                            <p>
                                <span class="badge">{{ $house->area }}㎡</span>
                                <span class="badge">{{ $house->bedrooms }}室</span>
                            </p>
                            <form action="{{ route('user.favorites.toggle', $house->id) }}" method="POST" style="margin-top: 10px;">
                                {{ csrf_field() }}
                                <button type="submit" class="btn btn-warning btn-sm btn-block"><i class="icon-heart"></i> 取消收藏</button>
                            </form>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
            <div class="text-center">{{ $houses->links() }}</div>
        @endif
    </div>
</div>
@endsection
