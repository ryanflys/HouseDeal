@extends('layouts.app')

@section('title', $house->title . ' - HouseDeal')

@section('content')
<div class="row">
    <div class="col-md-8">
        <!-- Main Image -->
        <div style="margin-bottom: 20px;">
            <img src="{{ $house->cover }}" alt="{{ $house->title }}" style="width: 100%; height: 400px; object-fit: cover; border-radius: 8px;">
        </div>

        <!-- Image Gallery -->
        @if(is_array($house->images) && count($house->images) > 1)
        <div class="row" style="margin-bottom: 20px;">
            @foreach($house->images as $img)
            <div class="col-md-3 col-sm-4 col-xs-6" style="margin-bottom: 10px;">
                <img src="{{ $img }}" alt="" style="width: 100%; height: 100px; object-fit: cover; border-radius: 4px;">
            </div>
            @endforeach
        </div>
        @endif

        <!-- House Info -->
        <div class="panel panel-default">
            <div class="panel-heading"><h3 class="panel-title"><i class="icon-info-sign"></i> 房源信息</h3></div>
            <div class="panel-body">
                <table class="table table-bordered">
                    <tbody>
                        <tr>
                            <td style="width: 15%;"><strong>户型</strong></td>
                            <td>{{ $house->bedrooms }}室{{ $house->living_rooms }}厅{{ $house->bathrooms }}卫</td>
                            <td style="width: 15%;"><strong>面积</strong></td>
                            <td>{{ $house->area }} ㎡</td>
                        </tr>
                        <tr>
                            <td><strong>楼层</strong></td>
                            <td>{{ $house->floor ?? '-' }} / {{ $house->total_floor ?? '-' }} 层</td>
                            <td><strong>朝向</strong></td>
                            <td>{{ $house->orientation ?? '-' }}</td>
                        </tr>
                        <tr>
                            <td><strong>装修</strong></td>
                            <td>{{ $house->decoration ?? '-' }}</td>
                            <td><strong>类型</strong></td>
                            <td>
                                @if($house->type === 'new') 新房
                                @elseif($house->type === 'second') 二手房
                                @elseif($house->type === 'rent') 租房
                                @endif
                            </td>
                        </tr>
                        <tr>
                            <td><strong>城市</strong></td>
                            <td>{{ $house->city ?? '-' }}</td>
                            <td><strong>区域</strong></td>
                            <td>{{ $house->district ?? '-' }}</td>
                        </tr>
                        <tr>
                            <td><strong>地址</strong></td>
                            <td colspan="3">{{ $house->address ?? '-' }}</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>

        <!-- Description -->
        <div class="panel panel-default">
            <div class="panel-heading"><h3 class="panel-title"><i class="icon-file-text"></i> 房源描述</h3></div>
            <div class="panel-body">
                <p style="line-height: 1.8;">{{ nl2br(e($house->description)) }}</p>
            </div>
        </div>
    </div>

    <!-- Sidebar -->
    <div class="col-md-4">
        <!-- Price Card -->
        <div class="panel panel-primary">
            <div class="panel-heading">
                <h3 class="panel-title text-center" style="font-size: 24px;">
                    @if($house->type === 'rent')
                        {{ number_format($house->rent_price) }} 元/月
                    @else
                        {{ $house->formatted_price }}
                    @endif
                </h3>
            </div>
            <div class="panel-body text-center">
                @if($house->status === 'sale')
                    <span class="label label-success" style="font-size: 14px;">在售中</span>
                @elseif($house->status === 'sold')
                    <span class="label label-danger" style="font-size: 14px;">已售</span>
                @elseif($house->status === 'rent')
                    <span class="label label-info" style="font-size: 14px;">出租中</span>
                @endif

                @auth
                    <div style="margin-top: 15px;">
                        @if(auth()->user()->favorites()->where('house_id', $house->id)->exists())
                            <form action="{{ route('user.favorites.toggle', $house->id) }}" method="POST">
                                {{ csrf_field() }}
                                <button type="submit" class="btn btn-warning btn-block"><i class="icon-heart"></i> 取消收藏</button>
                            </form>
                        @else
                            <form action="{{ route('user.favorites.toggle', $house->id) }}" method="POST">
                                {{ csrf_field() }}
                                <button type="submit" class="btn btn-default btn-block"><i class="icon-heart-empty"></i> 收藏房源</button>
                            </form>
                        @endif
                    </div>
                @endauth
            </div>
        </div>

        <!-- Agent Info -->
        @if($house->agent)
        <div class="panel panel-default">
            <div class="panel-heading"><h3 class="panel-title"><i class="icon-user"></i> 经纪人信息</h3></div>
            <div class="panel-body text-center">
                <img src="{{ $house->agent->avatar ?? '/img/demo/av2.jpg' }}" alt="" style="width: 80px; height: 80px; border-radius: 50%; margin-bottom: 10px;">
                <h4>{{ $house->agent->name }}</h4>
                <p class="text-muted">{{ $house->agent->agency ?? '' }}</p>
                <p><i class="icon-phone"></i> {{ $house->agent->phone ?? '联系方式' }}</p>
                <p><span class="label label-warning">{{ $house->agent->formatted_rating }}</span></p>
            </div>
        </div>
        @endif

        <!-- Contact -->
        <div class="panel panel-success">
            <div class="panel-heading"><h3 class="panel-title text-center"><i class="icon-phone-sign"></i> 联系看房</h3></div>
            <div class="panel-body text-center">
                <p style="font-size: 16px;">如有意向，请联系经纪人预约看房</p>
                <a href="tel:{{ $house->agent->phone ?? $house->user->phone ?? '' }}" class="btn btn-success btn-lg btn-block">
                    <i class="icon-phone"></i> 立即联系
                </a>
            </div>
        </div>
    </div>
</div>

<!-- Related Houses -->
@if($related->isNotEmpty())
<h3 style="margin-top: 40px; margin-bottom: 20px;"><i class="icon-th"></i> 相关房源</h3>
<div class="row">
    @foreach($related as $house)
    <div class="col-md-3 col-sm-6" style="margin-bottom: 20px;">
        <div class="house-card thumbnail" style="margin-bottom: 0;">
            <img src="{{ $house->cover }}" class="house-img" alt="{{ $house->title }}">
            <div class="caption">
                <h5 style="height: 40px; overflow: hidden;">
                    <a href="{{ route('houses.show', $house->id) }}">{{ $house->title }}</a>
                </h5>
                <p class="price-tag">{{ $house->formatted_price }}</p>
            </div>
        </div>
    </div>
    @endforeach
</div>
@endif
@endsection
