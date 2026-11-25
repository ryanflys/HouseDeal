@extends('layouts.app')

@section('title', 'HouseDeal - 开箱即用的房产交易平台')

@section('content')
<!-- Hero Section -->
<div style="background: linear-gradient(135deg, #3498db, #2c3e50); color: #fff; padding: 60px 0; text-align: center; border-radius: 8px; margin-bottom: 30px;">
    <h1 style="font-size: 36px; margin-bottom: 15px;">HouseDeal 房产交易平台</h1>
    <p style="font-size: 18px; opacity: 0.9;">开箱即用的房产交易网站模板 · 二手房 · 新房 · 租房</p>
    @auth
        <a href="{{ route('user.houses.create') }}" class="btn btn-lg btn-success" style="margin-top: 20px;">
            <i class="icon-plus"></i> 发布房源
        </a>
    @else
        <a href="{{ route('register') }}" class="btn btn-lg btn-success" style="margin-top: 20px;">
            <i class="icon-user"></i> 免费注册
        </a>
    @endauth
</div>

<!-- Featured Houses -->
@if($featured->isNotEmpty())
<h2 style="margin-bottom: 20px;"><i class="icon-star"></i> 精选房源</h2>
<div class="row">
    @foreach($featured as $house)
    <div class="col-md-3 col-sm-6" style="margin-bottom: 20px;">
        <div class="house-card thumbnail" style="margin-bottom: 0;">
            <img src="{{ $house->cover }}" class="house-img" alt="{{ $house->title }}">
            <div class="caption">
                <h4 style="height: 40px; overflow: hidden;">
                    <a href="{{ route('houses.show', $house->id) }}" style="color: #333;">{{ $house->title }}</a>
                </h4>
                <p class="text-muted" style="height: 20px; overflow: hidden;">
                    <i class="icon-map-marker"></i> {{ $house->city ?? '' }} {{ $house->district ?? '' }}
                </p>
                <p class="price-tag">
                    @if($house->type === 'rent')
                        {{ number_format($house->rent_price) }} 元/月
                    @else
                        {{ $house->formatted_price }}
                    @endif
                </p>
                <p>
                    <span class="badge badge-info badge-status">{{ $house->area }}㎡</span>
                    <span class="badge badge-status">{{ $house->bedrooms }}室{{ $house->living_rooms }}厅</span>
                </p>
            </div>
        </div>
    </div>
    @endforeach
</div>
@endif

<!-- Recent Houses -->
<h2 style="margin-bottom: 20px; margin-top: 30px;"><i class="icon-th-large"></i> 最新房源</h2>
<div class="row">
    @foreach($houses as $house)
    <div class="col-md-3 col-sm-6" style="margin-bottom: 20px;">
        <div class="house-card thumbnail" style="margin-bottom: 0;">
            <img src="{{ $house->cover }}" class="house-img" alt="{{ $house->title }}">
            <div class="caption">
                <h4 style="height: 40px; overflow: hidden;">
                    <a href="{{ route('houses.show', $house->id) }}" style="color: #333;">{{ $house->title }}</a>
                </h4>
                <p class="text-muted" style="height: 20px; overflow: hidden;">
                    <i class="icon-map-marker"></i> {{ $house->city ?? '' }} {{ $house->district ?? '' }}
                </p>
                <p class="price-tag">
                    @if($house->type === 'rent')
                        {{ number_format($house->rent_price) }} 元/月
                    @else
                        {{ $house->formatted_price }}
                    @endif
                </p>
                <p>
                    <span class="badge badge-info badge-status">{{ $house->area }}㎡</span>
                    <span class="badge badge-status">{{ $house->bedrooms }}室{{ $house->living_rooms }}厅</span>
                </p>
            </div>
        </div>
    </div>
    @endforeach
</div>

<div class="text-center" style="margin-top: 20px;">
    <a href="{{ route('houses.index') }}" class="btn btn-primary btn-lg">查看更多房源 <i class="icon-arrow-right"></i></a>
</div>
@endsection
