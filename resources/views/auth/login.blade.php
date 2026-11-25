@extends('layouts.app')

@section('title', '登录 - HouseDeal')

@section('content')
<div class="row">
    <div class="col-md-4 col-md-offset-4" style="margin-top: 40px;">
        <div class="panel panel-primary">
            <div class="panel-heading text-center">
                <h3 class="panel-title" style="font-size: 20px;"><i class="icon-user"></i> 用户登录</h3>
            </div>
            <div class="panel-body">
                <form action="{{ route('login') }}" method="POST">
                    {{ csrf_field() }}
                    <div class="form-group">
                        <label>邮箱</label>
                        <div class="input-group">
                            <span class="input-group-addon"><i class="icon-envelope"></i></span>
                            <input type="email" name="email" class="form-control" required value="{{ old('email') }}" placeholder="请输入邮箱">
                        </div>
                    </div>
                    <div class="form-group">
                        <label>密码</label>
                        <div class="input-group">
                            <span class="input-group-addon"><i class="icon-key"></i></span>
                            <input type="password" name="password" class="form-control" required placeholder="请输入密码">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="checkbox-inline">
                            <input type="checkbox" name="remember" {{ old('remember') ? 'checked' : '' }}> 记住我
                        </label>
                        <a href="{{ route('password.request') }}" class="pull-right">忘记密码？</a>
                    </div>
                    <button type="submit" class="btn btn-primary btn-block btn-lg"><i class="icon-signin"></i> 登录</button>
                </form>
            </div>
            <div class="panel-footer text-center">还没有账号？<a href="{{ route('register') }}">立即注册</a></div>
        </div>
    </div>
</div>
@endsection
