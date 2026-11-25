@extends('layouts.app')

@section('title', '房源列表 - HouseDeal')

@section('content')
<h2 style="margin-bottom: 20px;"><i class="icon-th-large"></i> 房源列表</h2>

<!-- Filter Bar -->
<div class="well" style="padding: 15px;">
    <form action="{{ route('houses.index') }}" method="GET" class="form-inline">
        <div class="form-group" style="margin-right: 10px;">
            <label>类型：</label>
            <select name="type" class="form-control">
                <option value="">全部</option>
                <option value="new" {{ request('type') == 'new' ? 'selected' : '' }}>新房</option>
                <option value="second" {{ request('type') == 'second' ? 'selected' : '' }}>二手房</option>
                <option value="rent" {{ request('type') == 'rent' ? 'selected' : '' }}>租房</option>
            </select>
        </div>
        <div class="form-group" style="margin-right: 10px;">
            <label>状态：</label>
            <select name="status" class="form-control">
                <option value="">全部</option>
                <option value="sale" {{ request('status') == 'sale' ? 'selected' : '' }}>在售</option>
                <option value="rent" {{ request('status') == 'rent' ? 'selected' : '' }}>在租</option>
                <option value="sold" {{ request('status') == 'sold' ? 'selected' : '' }}>已售</option>
            </select>
        </div>
        <div class="form-group" style="margin-right: 10px;">
            <label>最低价：</label>
            <input type="number" name="min_price" class="form-control" placeholder="万元" value="{{ request('min_price') }}">
        </div>
        <div class="form-group" style="margin-right: 10px;">
            <label>最高价：</label>
            <input type="number" name="max_price" class="form-control" placeholder="万元" value="{{ request('max_price') }}">
        </div>
        <button type="submit" class="btn btn-primary"><i class="icon-filter"></i> 筛选</button>
        <a href="{{ route('houses.index') }}" class="btn btn-default">重置</a>
    </form>
</div>

<!-- House Grid -->
@if($houses->isEmpty())
    <div class="alert alert-info" style="text-align: center; padding: 40px;">
        <h3>暂无符合条件的房源</h3>
        <p>请调整筛选条件后重试</p>
    </div>
@else
<div class="row">
    @foreach($houses as $house)
    <div class="col-md-3 col-sm-6" style="margin-bottom: 20px;">
        <div class="house-card thumbnail" style="margin-bottom: 0;">
            <img src="{{ $house->cover }}" class="house-img" alt="{{ $house->title }}">
            <div class="caption">
                <h4 style="height: 40px; overflow: hidden;">
                    <a href="{{ route('houses.show', $house->id) }}">{{ $house->title }}</a>
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
                    <span class="badge badge-info">{{ $house->area }}㎡</span>
                    <span class="badge">{{ $house->bedrooms }}室{{ $house->living_rooms }}厅</span>
                </p>
            </div>
        </div>
    </div>
    @endforeach
</div>

<!-- Pagination -->
<div class="text-center">
    {{ $houses->links() }}
</div>
@endif
@endsection
