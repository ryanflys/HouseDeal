@extends('layouts.admin')
@section('title', '经纪人管理 - HouseDeal 后台')
@section('breadcrumb')<span class="divider">/</span> <a href="#">经纪人管理</a>@endsection

@section('content')
<div class="row-fluid">
    <div class="widget-box">
        <div class="widget-title">
            <span class="icon"><i class="icon-briefcase"></i></span><h5>经纪人列表</h5>
            <a href="{{ route('admin.agents.create') }}" class="btn btn-primary btn-mini pull-right" style="margin: 5px;"><i class="icon-plus"></i> 添加经纪人</a>
        </div>
        <div class="widget-content nopadding">
            <table class="table table-bordered table-striped">
                <thead><tr><th>ID</th><th>姓名</th><th>电话</th><th>所属机构</th><th>执照编号</th><th>评分</th><th>操作</th></tr></thead>
                <tbody>
                    @foreach($agents as $agent)
                    <tr>
                        <td>{{ $agent->id }}</td>
                        <td>{{ $agent->name }}</td>
                        <td>{{ $agent->phone ?? '-' }}</td>
                        <td>{{ $agent->agency ?? '-' }}</td>
                        <td>{{ $agent->license_no ?? '-' }}</td>
                        <td><span class="label label-warning">{{ $agent->formatted_rating }}</span></td>
                        <td>
                            <a href="{{ route('admin.agents.edit', $agent->id) }}" class="btn btn-warning btn-mini"><i class="icon-pencil"></i> 编辑</a>
                            <form action="{{ route('admin.agents.destroy', $agent->id) }}" method="POST" style="display:inline;" onsubmit="return confirm('确定删除？')">
                                {{ csrf_field() }} {{ method_field('DELETE') }}
                                <button type="submit" class="btn btn-danger btn-mini"><i class="icon-trash"></i></button>
                            </form>
                        </td>
                    </tr>
                    @endforeach
                    @if($agents->isEmpty())<tr><td colspan="7" class="text-center text-muted" style="padding: 20px;">暂无经纪人</td></tr>@endif
                </tbody>
            </table>
        </div>
    </div>
</div>
<div class="text-center">{{ $agents->links() }}</div>
@endsection
