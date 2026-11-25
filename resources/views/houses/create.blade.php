@extends('layouts.app')

@section('title', '发布房源 - HouseDeal')

@section('content')
<div class="row">
    <div class="col-md-8 col-md-offset-2">
        <h2 style="margin-bottom: 20px;"><i class="icon-plus"></i> 发布房源</h2>

        <form action="{{ route('user.houses.store') }}" method="POST">
            {{ csrf_field() }}

            <div class="panel panel-default">
                <div class="panel-heading"><h3 class="panel-title">基本信息</h3></div>
                <div class="panel-body">
                    <div class="form-group">
                        <label>标题 <span class="text-danger">*</span></label>
                        <input type="text" name="title" class="form-control" required placeholder="例：阳光花园 精装三房 南北通透">
                    </div>
                    <div class="row">
                        <div class="col-md-4 form-group">
                            <label>类型 <span class="text-danger">*</span></label>
                            <select name="type" class="form-control" required>
                                <option value="second">二手房</option>
                                <option value="new">新房</option>
                                <option value="rent">租房</option>
                            </select>
                        </div>
                        <div class="col-md-4 form-group">
                            <label>售价（元）</label>
                            <input type="number" name="price" class="form-control" placeholder="例：3200000">
                        </div>
                        <div class="col-md-4 form-group">
                            <label>租金（元/月）</label>
                            <input type="number" name="rent_price" class="form-control" placeholder="租房时填写">
                        </div>
                    </div>
                    <div class="form-group">
                        <label>房源描述</label>
                        <textarea name="description" class="form-control" rows="4" placeholder="详细描述房源特点、周边配套等信息..."></textarea>
                    </div>
                </div>
            </div>

            <div class="panel panel-default">
                <div class="panel-heading"><h3 class="panel-title">详细信息</h3></div>
                <div class="panel-body">
                    <div class="row">
                        <div class="col-md-4 form-group">
                            <label>城市</label>
                            <input type="text" name="city" class="form-control" placeholder="例：深圳市">
                        </div>
                        <div class="col-md-4 form-group">
                            <label>区域</label>
                            <input type="text" name="district" class="form-control" placeholder="例：南山区">
                        </div>
                        <div class="col-md-4 form-group">
                            <label>地址</label>
                            <input type="text" name="address" class="form-control" placeholder="详细地址">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-3 form-group">
                            <label>面积（㎡）</label>
                            <input type="number" step="0.1" name="area" class="form-control">
                        </div>
                        <div class="col-md-3 form-group">
                            <label>卧室数</label>
                            <input type="number" name="bedrooms" class="form-control" value="0">
                        </div>
                        <div class="col-md-3 form-group">
                            <label>客厅数</label>
                            <input type="number" name="living_rooms" class="form-control" value="0">
                        </div>
                        <div class="col-md-3 form-group">
                            <label>卫生间数</label>
                            <input type="number" name="bathrooms" class="form-control" value="0">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-3 form-group">
                            <label>所在楼层</label>
                            <input type="text" name="floor" class="form-control">
                        </div>
                        <div class="col-md-3 form-group">
                            <label>总楼层</label>
                            <input type="text" name="total_floor" class="form-control">
                        </div>
                        <div class="col-md-3 form-group">
                            <label>朝向</label>
                            <select name="orientation" class="form-control">
                                <option value="">请选择</option>
                                <option value="南">南</option>
                                <option value="北">北</option>
                                <option value="东南">东南</option>
                                <option value="西南">西南</option>
                                <option value="南北">南北</option>
                            </select>
                        </div>
                        <div class="col-md-3 form-group">
                            <label>装修</label>
                            <select name="decoration" class="form-control">
                                <option value="">请选择</option>
                                <option value="精装">精装</option>
                                <option value="普装">普装</option>
                                <option value="毛坯">毛坯</option>
                                <option value="豪装">豪装</option>
                            </select>
                        </div>
                    </div>
                </div>
            </div>

            <div class="text-right" style="margin-bottom: 40px;">
                <a href="{{ route('user.houses') }}" class="btn btn-default">取消</a>
                <button type="submit" class="btn btn-primary"><i class="icon-ok"></i> 提交发布</button>
            </div>
        </form>
    </div>
</div>
@endsection
