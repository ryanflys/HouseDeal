@extends('layouts.app')

@section('title', '编辑房源 - HouseDeal')

@section('content')
<div class="row">
    <div class="col-md-8 col-md-offset-2">
        <h2 style="margin-bottom: 20px;"><i class="icon-edit"></i> 编辑房源</h2>

        <form action="{{ route('user.houses.update', $house->id) }}" method="POST">
            {{ csrf_field() }}
            {{ method_field('PUT') }}

            <div class="panel panel-default">
                <div class="panel-heading"><h3 class="panel-title">基本信息</h3></div>
                <div class="panel-body">
                    <div class="form-group">
                        <label>标题 <span class="text-danger">*</span></label>
                        <input type="text" name="title" class="form-control" required value="{{ old('title', $house->title) }}">
                    </div>
                    <div class="row">
                        <div class="col-md-4 form-group">
                            <label>类型 <span class="text-danger">*</span></label>
                            <select name="type" class="form-control" required>
                                <option value="second" {{ $house->type == 'second' ? 'selected' : '' }}>二手房</option>
                                <option value="new" {{ $house->type == 'new' ? 'selected' : '' }}>新房</option>
                                <option value="rent" {{ $house->type == 'rent' ? 'selected' : '' }}>租房</option>
                            </select>
                        </div>
                        <div class="col-md-4 form-group">
                            <label>售价（元）</label>
                            <input type="number" name="price" class="form-control" value="{{ old('price', $house->price) }}">
                        </div>
                        <div class="col-md-4 form-group">
                            <label>租金（元/月）</label>
                            <input type="number" name="rent_price" class="form-control" value="{{ old('rent_price', $house->rent_price) }}">
                        </div>
                    </div>
                    <div class="form-group">
                        <label>房源描述</label>
                        <textarea name="description" class="form-control" rows="4">{{ old('description', $house->description) }}</textarea>
                    </div>
                </div>
            </div>

            <div class="panel panel-default">
                <div class="panel-heading"><h3 class="panel-title">详细信息</h3></div>
                <div class="panel-body">
                    <div class="row">
                        <div class="col-md-4 form-group">
                            <label>城市</label>
                            <input type="text" name="city" class="form-control" value="{{ old('city', $house->city) }}">
                        </div>
                        <div class="col-md-4 form-group">
                            <label>区域</label>
                            <input type="text" name="district" class="form-control" value="{{ old('district', $house->district) }}">
                        </div>
                        <div class="col-md-4 form-group">
                            <label>地址</label>
                            <input type="text" name="address" class="form-control" value="{{ old('address', $house->address) }}">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-3 form-group">
                            <label>面积（㎡）</label>
                            <input type="number" step="0.1" name="area" class="form-control" value="{{ old('area', $house->area) }}">
                        </div>
                        <div class="col-md-3 form-group">
                            <label>卧室数</label>
                            <input type="number" name="bedrooms" class="form-control" value="{{ old('bedrooms', $house->bedrooms) }}">
                        </div>
                        <div class="col-md-3 form-group">
                            <label>客厅数</label>
                            <input type="number" name="living_rooms" class="form-control" value="{{ old('living_rooms', $house->living_rooms) }}">
                        </div>
                        <div class="col-md-3 form-group">
                            <label>卫生间数</label>
                            <input type="number" name="bathrooms" class="form-control" value="{{ old('bathrooms', $house->bathrooms) }}">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-3 form-group">
                            <label>所在楼层</label>
                            <input type="text" name="floor" class="form-control" value="{{ old('floor', $house->floor) }}">
                        </div>
                        <div class="col-md-3 form-group">
                            <label>总楼层</label>
                            <input type="text" name="total_floor" class="form-control" value="{{ old('total_floor', $house->total_floor) }}">
                        </div>
                        <div class="col-md-3 form-group">
                            <label>朝向</label>
                            <input type="text" name="orientation" class="form-control" value="{{ old('orientation', $house->orientation) }}">
                        </div>
                        <div class="col-md-3 form-group">
                            <label>装修</label>
                            <input type="text" name="decoration" class="form-control" value="{{ old('decoration', $house->decoration) }}">
                        </div>
                    </div>
                </div>
            </div>

            <div class="text-right" style="margin-bottom: 40px;">
                <a href="{{ route('user.houses') }}" class="btn btn-default">取消</a>
                <button type="submit" class="btn btn-primary"><i class="icon-ok"></i> 保存修改</button>
            </div>
        </form>
    </div>
</div>
@endsection
