@extends('layouts.admin')
@section('title', '添加房源 - HouseDeal 后台')
@section('breadcrumb')<span class="divider">/</span> <a href="{{ route('admin.houses.index') }}">房源管理</a> <span class="divider">/</span> 添加房源@endsection

@section('content')
<div class="row-fluid">
    <div class="widget-box">
        <div class="widget-title"><span class="icon"><i class="icon-plus"></i></span><h5>添加房源</h5></div>
        <div class="widget-content nopadding">
            <form action="{{ route('admin.houses.store') }}" method="POST" class="form-horizontal">
                {{ csrf_field() }}
                <div class="control-group"><label class="control-label">标题 *</label><div class="controls"><input type="text" name="title" class="span6" required></div></div>
                <div class="control-group"><label class="control-label">类型 *</label><div class="controls"><select name="type" class="span6"><option value="second">二手房</option><option value="new">新房</option><option value="rent">租房</option></select></div></div>
                <div class="control-group"><label class="control-label">状态 *</label><div class="controls"><select name="status" class="span6"><option value="sale">在售</option><option value="rent">在租</option><option value="offline">下架</option></select></div></div>
                <div class="control-group"><label class="control-label">价格（元）</label><div class="controls"><input type="number" name="price" class="span6" value="0"></div></div>
                <div class="control-group"><label class="control-label">城市</label><div class="controls"><input type="text" name="city" class="span6"></div></div>
                <div class="control-group"><label class="control-label">区域</label><div class="controls"><input type="text" name="district" class="span6"></div></div>
                <div class="control-group"><label class="control-label">地址</label><div class="controls"><input type="text" name="address" class="span6"></div></div>
                <div class="control-group"><label class="control-label">面积（㎡）</label><div class="controls"><input type="number" step="0.1" name="area" class="span6" value="0"></div></div>
                <div class="control-group"><label class="control-label">卧室/客厅/卫</label><div class="controls"><input type="number" name="bedrooms" class="span1" value="0"><input type="number" name="living_rooms" class="span1" value="0"><input type="number" name="bathrooms" class="span1" value="0"></div></div>
                <div class="control-group"><label class="control-label">描述</label><div class="controls"><textarea name="description" class="span8" rows="4"></textarea></div></div>
                <div class="form-actions"><button type="submit" class="btn btn-primary"><i class="icon-ok"></i> 添加</button><a href="{{ route('admin.houses.index') }}" class="btn">取消</a></div>
            </form>
        </div>
    </div>
</div>
@endsection
