@extends('layouts.admin')
@section('title', '编辑用户 - HouseDeal 后台')
@section('breadcrumb')<span class="divider">/</span> <a href="{{ route('admin.users.index') }}">用户管理</a> <span class="divider">/</span> 编辑用户@endsection

@section('content')
<div class="row-fluid">
    <div class="widget-box">
        <div class="widget-title"><span class="icon"><i class="icon-edit"></i></span><h5>编辑用户</h5></div>
        <div class="widget-content nopadding">
            <form action="{{ route('admin.users.update', $user->id) }}" method="POST" class="form-horizontal">
                {{ csrf_field() }} {{ method_field('PUT') }}
                <div class="control-group">
                    <label class="control-label">用户名</label>
                    <div class="controls"><input type="text" name="name" class="span6" required value="{{ old('name', $user->name) }}"></div>
                </div>
                <div class="control-group">
                    <label class="control-label">邮箱</label>
                    <div class="controls"><input type="email" name="email" class="span6" required value="{{ old('email', $user->email) }}"></div>
                </div>
                <div class="control-group">
                    <label class="control-label">手机</label>
                    <div class="controls"><input type="text" name="phone" class="span6" value="{{ old('phone', $user->phone) }}"></div>
                </div>
                <div class="control-group">
                    <label class="control-label">角色</label>
                    <div class="controls">
                        <select name="role" class="span6">
                            <option value="user" {{ $user->role == 'user' ? 'selected' : '' }}>普通用户</option>
                            <option value="agent" {{ $user->role == 'agent' ? 'selected' : '' }}>经纪人</option>
                            <option value="admin" {{ $user->role == 'admin' ? 'selected' : '' }}>管理员</option>
                        </select>
                    </div>
                </div>
                <div class="form-actions">
                    <button type="submit" class="btn btn-primary"><i class="icon-ok"></i> 保存</button>
                    <a href="{{ route('admin.users.index') }}" class="btn">取消</a>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
