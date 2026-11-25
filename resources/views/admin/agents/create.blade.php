@extends('layouts.admin')
@section('title', '添加经纪人 - HouseDeal 后台')
@section('breadcrumb')<span class="divider">/</span> <a href="{{ route('admin.agents.index') }}">经纪人管理</a> <span class="divider">/</span> 添加经纪人@endsection

@section('content')
<div class="row-fluid">
    <div class="widget-box">
        <div class="widget-title"><span class="icon"><i class="icon-plus"></i></span><h5>添加经纪人</h5></div>
        <div class="widget-content nopadding">
            <form action="{{ route('admin.agents.store') }}" method="POST" class="form-horizontal">
                {{ csrf_field() }}
                <div class="control-group"><label class="control-label">姓名</label><div class="controls"><input type="text" name="name" class="span6" required></div></div>
                <div class="control-group"><label class="control-label">电话</label><div class="controls"><input type="text" name="phone" class="span6"></div></div>
                <div class="control-group"><label class="control-label">邮箱</label><div class="controls"><input type="email" name="email" class="span6"></div></div>
                <div class="control-group"><label class="control-label">所属机构</label><div class="controls"><input type="text" name="agency" class="span6"></div></div>
                <div class="control-group"><label class="control-label">执照编号</label><div class="controls"><input type="text" name="license_no" class="span6"></div></div>
                <div class="control-group"><label class="control-label">评分</label><div class="controls"><input type="number" step="0.1" name="rating" class="span2" value="5.0" min="0" max="5"></div></div>
                <div class="control-group"><label class="control-label">简介</label><div class="controls"><textarea name="description" class="span8" rows="4"></textarea></div></div>
                <div class="form-actions"><button type="submit" class="btn btn-primary"><i class="icon-ok"></i> 添加</button><a href="{{ route('admin.agents.index') }}" class="btn">取消</a></div>
            </form>
        </div>
    </div>
</div>
@endsection
