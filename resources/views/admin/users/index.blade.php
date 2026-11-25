@extends('layouts.admin')
@section('title', '用户管理 - HouseDeal 后台')
@section('breadcrumb')<span class="divider">/</span> <a href="#">用户管理</a>@endsection

@section('content')
<div class="row-fluid">
    <div class="widget-box">
        <div class="widget-title"><span class="icon"><i class="icon-user"></i></span><h5>用户列表</h5></div>
        <div class="widget-content nopadding">
            <form action="{{ route('admin.users.index') }}" method="GET" class="form-inline" style="padding: 10px;">
                <input type="text" name="keyword" class="form-control" placeholder="搜索用户名/邮箱/手机..." value="{{ request('keyword') }}" style="width: 200px;">
                <select name="role" class="form-control" style="width: 120px;">
                    <option value="">全部角色</option>
                    <option value="admin" {{ request('role') == 'admin' ? 'selected' : '' }}>管理员</option>
                    <option value="agent" {{ request('role') == 'agent' ? 'selected' : '' }}>经纪人</option>
                    <option value="user" {{ request('role') == 'user' ? 'selected' : '' }}>普通用户</option>
                </select>
                <button type="submit" class="btn btn-primary"><i class="icon-search"></i> 搜索</button>
            </form>
            <table class="table table-bordered table-striped">
                <thead><tr><th>ID</th><th>用户名</th><th>邮箱</th><th>手机</th><th>角色</th><th>注册时间</th><th>操作</th></tr></thead>
                <tbody>
                    @foreach($users as $user)
                    <tr>
                        <td>{{ $user->id }}</td>
                        <td>{{ $user->name }}</td>
                        <td>{{ $user->email }}</td>
                        <td>{{ $user->phone ?? '-' }}</td>
                        <td>
                            @if($user->isAdmin()) <span class="label label-danger">管理员</span>
                            @elseif($user->isAgent()) <span class="label label-warning">经纪人</span>
                            @else <span class="label label-info">用户</span>
                            @endif
                        </td>
                        <td>{{ $user->created_at->format('Y-m-d') }}</td>
                        <td>
                            <a href="{{ route('admin.users.edit', $user->id) }}" class="btn btn-warning btn-mini"><i class="icon-pencil"></i> 编辑</a>
                            <form action="{{ route('admin.users.destroy', $user->id) }}" method="POST" style="display:inline;" onsubmit="return confirm('确定删除？')">
                                {{ csrf_field() }} {{ method_field('DELETE') }}
                                <button type="submit" class="btn btn-danger btn-mini"><i class="icon-trash"></i></button>
                            </form>
                        </td>
                    </tr>
                    @endforeach
                    @if($users->isEmpty())<tr><td colspan="7" class="text-center text-muted" style="padding: 20px;">暂无用户</td></tr>@endif
                </tbody>
            </table>
        </div>
    </div>
</div>
<div class="text-center">{{ $users->links() }}</div>
@endsection
