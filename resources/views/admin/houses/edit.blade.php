@extends('layouts.admin')
@section('title', '编辑房源 - HouseDeal 后台')
@section('breadcrumb')<span class="divider">/</span> <a href="{{ route('admin.houses.index') }}">房源管理</a> <span class="divider">/</span> 编辑房源@endsection

@section('content')
<div class="row-fluid">
    <div class="widget-box">
        <div class="widget-title"><span class="icon"><i class="icon-edit"></i></span><h5>编辑房源</h5></div>
        <div class="widget-content nopadding">
            <form action="{{ route('admin.houses.update', $house->id) }}" method="POST" class="form-horizontal">
                {{ csrf_field() }} {{ method_field('PUT') }}
                <div class="control-group">
                    <label class="control-label">标题</label>
                    <div class="controls"><input type="text" name="title" class="span6" required value="{{ old('title', $house->title) }}"></div>
                </div>
                <div class="control-group">
                    <label class="control-label">价格（元）</label>
                    <div class="controls"><input type="number" name="price" class="span6" value="{{ old('price', $house->price) }}"></div>
                </div>
                <div class="control-group">
                    <label class="control-label">类型</label>
                    <div class="controls">
                        <select name="type" class="span6">
                            <option value="second" {{ $house->type == 'second' ? 'selected' : '' }}>二手房</option>
                            <option value="new" {{ $house->type == 'new' ? 'selected' : '' }}>新房</option>
                            <option value="rent" {{ $house->type == 'rent' ? 'selected' : '' }}>租房</option>
                        </select>
                    </div>
                </div>
                <div class="control-group">
                    <label class="control-label">状态</label>
                    <div class="controls">
                        <select name="status" class="span6">
                            <option value="sale" {{ $house->status == 'sale' ? 'selected' : '' }}>在售</option>
                            <option value="sold" {{ $house->status == 'sold' ? 'selected' : '' }}>已售</option>
                            <option value="rent" {{ $house->status == 'rent' ? 'selected' : '' }}>在租</option>
                            <option value="rented" {{ $house->status == 'rented' ? 'selected' : '' }}>已租</option>
                            <option value="offline" {{ $house->status == 'offline' ? 'selected' : '' }}>下架</option>
                        </select>
                    </div>
                </div>
                <div class="control-group">
                    <label class="control-label">城市</label>
                    <div class="controls"><input type="text" name="city" class="span6" value="{{ old('city', $house->city) }}"></div>
                </div>
                <div class="control-group">
                    <label class="control-label">区域</label>
                    <div class="controls"><input type="text" name="district" class="span6" value="{{ old('district', $house->district) }}"></div>
                </div>
                <div class="control-group">
                    <label class="control-label">面积（㎡）</label>
                    <div class="controls"><input type="number" step="0.1" name="area" class="span6" value="{{ old('area', $house->area) }}"></div>
                </div>
                <div class="control-group">
                    <label class="control-label">卧室/客厅/卫生间</label>
                    <div class="controls">
                        <input type="number" name="bedrooms" class="span1" value="{{ old('bedrooms', $house->bedrooms) }}" placeholder="卧">
                        <input type="number" name="living_rooms" class="span1" value="{{ old('living_rooms', $house->living_rooms) }}" placeholder="厅">
                        <input type="number" name="bathrooms" class="span1" value="{{ old('bathrooms', $house->bathrooms) }}" placeholder="卫">
                    </div>
                </div>
                <div class="control-group">
                    <label class="control-label">描述</label>
                    <div class="controls"><textarea name="description" class="span8" rows="4">{{ old('description', $house->description) }}</textarea></div>
                </div>
                <div class="control-group">
                    <label class="control-label">推荐</label>
                    <div class="controls">
                        <label class="checkbox"><input type="checkbox" name="is_featured" value="1" {{ $house->is_featured ? 'checked' : '' }}> 设为精选房源</label>
                    </div>
                </div>
                <div class="form-actions">
                    <button type="submit" class="btn btn-primary"><i class="icon-ok"></i> 保存</button>
                    <a href="{{ route('admin.houses.index') }}" class="btn">取消</a>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
