@extends('layouts.admin')
@section('title', '编辑经纪人 - HouseDeal 后台')
@section('breadcrumb')<span class="divider">/</span> <a href="{{ route('admin.agents.index') }}">经纪人管理</a> <span class="divider">/</span> 编辑经纪人@endsection

@section('content')
<div class="row-fluid">
    <div class="widget-box">
        <div class="widget-title"><span class="icon"><i class="icon-edit"></i></span><h5>编辑经纪人</h5></div>
        <div class="widget-content nopadding">
            <form action="{{ route('admin.agents.update', $agent->id) }}" method="POST" class="form-horizontal">
                {{ csrf_field() }} {{ method_field('PUT') }}
                <div class="control-group"><label class="control-label">姓名</label><div class="controls"><input type="text" name="name" class="span6" required value="{{ old('name', $agent->name) }}"></div></div>
                <div class="control-group"><label class="control-label">电话</label><div class="controls"><input type="text" name="phone" class="span6" value="{{ old('phone', $agent->phone) }}"></div></div>
                <div class="control-group"><label class="control-label">邮箱</label><div class="controls"><input type="email" name="email" class="span6" value="{{ old('email', $agent->email) }}"></div></div>
                <div class="control-group"><label class="control-label">所属机构</label><div class="controls"><input type="text" name="agency" class="span6" value="{{ old('agency', $agent->agency) }}"></div></div>
                <div class="control-group"><label class="control-label">执照编号</label><div class="controls"><input type="text" name="license_no" class="span6" value="{{ old('license_no', $agent->license_no) }}"></div></div>
                <div class="control-group"><label class="control-label">评分</label><div class="controls"><input type="number" step="0.1" name="rating" class="span2" value="{{ old('rating', $agent->rating) }}" min="0" max="5"></div></div>
                <div class="control-group"><label class="control-label">简介</label><div class="controls"><textarea name="description" class="span8" rows="4">{{ old('description', $agent->description) }}</textarea></div></div>
                <div class="form-actions"><button type="submit" class="btn btn-primary"><i class="icon-ok"></i> 保存</button><a href="{{ route('admin.agents.index') }}" class="btn">取消</a></div>
            </form>
        </div>
    </div>
</div>
@endsection
