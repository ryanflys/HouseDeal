@extends('layouts.app')

@section('title', '注册 - HouseDeal')

@section('content')
<div class="row">
    <div class="col-md-4 col-md-offset-4" style="margin-top: 30px;">
        <div class="panel panel-success">
            <div class="panel-heading text-center">
                <h3 class="panel-title" style="font-size: 20px;"><i class="icon-user-plus"></i> 用户注册</h3>
            </div>
            <div class="panel-body">
                <form action="{{ route('register') }}" method="POST">
                    {{ csrf_field() }}
                    <div class="form-group">
                        <label>用户名</label>
                        <input type="text" name="name" class="form-control" required value="{{ old('name') }}" placeholder="请输入用户名">
                    </div>
                    <div class="form-group">
                        <label>邮箱</label>
                        <input type="email" name="email" class="form-control" required value="{{ old('email') }}" placeholder="请输入邮箱">
                    </div>
                    <div class="form-group">
                        <label>手机号（选填）</label>
                        <input type="text" name="phone" class="form-control" value="{{ old('phone') }}" placeholder="请输入手机号">
                    </div>
                    <div class="form-group">
                        <label>密码</label>
                        <input type="password" name="password" class="form-control" required placeholder="请输入密码（至少6位）">
                    </div>
                    <div class="form-group">
                        <label>确认密码</label>
                        <input type="password" name="password_confirmation" class="form-control" required placeholder="请再次输入密码">
                    </div>
                    <button type="submit" class="btn btn-success btn-block btn-lg"><i class="icon-ok"></i> 注册</button>
                </form>
            </div>
            <div class="panel-footer text-center">已有账号？<a href="{{ route('login') }}">立即登录</a></div>
        </div>
    </div>
</div>
@endsection
