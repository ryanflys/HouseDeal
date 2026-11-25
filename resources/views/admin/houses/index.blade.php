@extends('layouts.admin')
@section('title', '房源管理 - HouseDeal 后台')
@section('breadcrumb')<span class="divider">/</span> <a href="#">房源管理</a>@endsection

@section('content')
<div class="row-fluid">
    <div class="widget-box">
        <div class="widget-title">
            <span class="icon"><i class="icon-th"></i></span>
            <h5>房源列表</h5>
            <a href="{{ route('admin.houses.create') }}" class="btn btn-primary btn-mini pull-right" style="margin: 5px;"><i class="icon-plus"></i> 添加房源</a>
        </div>
        <div class="widget-content nopadding">
            <form action="{{ route('admin.houses.index') }}" method="GET" class="form-inline" style="padding: 10px;">
                <input type="text" name="keyword" class="form-control" placeholder="搜索标题..." value="{{ request('keyword') }}" style="width: 200px;">
                <select name="status" class="form-control" style="width: 120px;">
                    <option value="">全部状态</option>
                    <option value="sale" {{ request('status') == 'sale' ? 'selected' : '' }}>在售</option>
                    <option value="sold" {{ request('status') == 'sold' ? 'selected' : '' }}>已售</option>
                    <option value="rent" {{ request('status') == 'rent' ? 'selected' : '' }}>在租</option>
                    <option value="offline" {{ request('status') == 'offline' ? 'selected' : '' }}>下架</option>
                </select>
                <button type="submit" class="btn btn-primary"><i class="icon-search"></i> 搜索</button>
            </form>
            <table class="table table-bordered table-striped">
                <thead><tr><th>ID</th><th>标题</th><th>价格</th><th>类型</th><th>状态</th><th>面积</th><th>发布时间</th><th>操作</th></tr></thead>
                <tbody>
                    @foreach($houses as $house)
                    <tr>
                        <td>{{ $house->id }}</td>
                        <td>{{ $house->title }}</td>
                        <td>{{ $house->formatted_price }}</td>
                        <td>{{ $house->type }}</td>
                        <td>{{ $house->status }}</td>
                        <td>{{ $house->area }}㎡</td>
                        <td>{{ $house->created_at->format('Y-m-d') }}</td>
                        <td>
                            <a href="{{ route('admin.houses.edit', $house->id) }}" class="btn btn-warning btn-mini"><i class="icon-pencil"></i></a>
                            <a href="{{ route('houses.show', $house->id) }}" class="btn btn-info btn-mini"><i class="icon-eye-open"></i></a>
                            <form action="{{ route('admin.houses.destroy', $house->id) }}" method="POST" style="display:inline;" onsubmit="return confirm('确定删除？')">
                                {{ csrf_field() }} {{ method_field('DELETE') }}
                                <button type="submit" class="btn btn-danger btn-mini"><i class="icon-trash"></i></button>
                            </form>
                        </td>
                    </tr>
                    @endforeach
                    @if($houses->isEmpty())<tr><td colspan="8" class="text-center text-muted" style="padding: 20px;">暂无房源数据</td></tr>@endif
                </tbody>
            </table>
        </div>
    </div>
</div>
<div class="text-center">{{ $houses->links() }}</div>
@endsection
