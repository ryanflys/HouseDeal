@extends('layouts.app')

@section('title', '我的房源 - HouseDeal')

@section('content')
<div class="row">
    <div class="col-md-3">
        <div class="panel panel-default">
            <div class="panel-body text-center">
                <img src="{{ auth()->user()->avatar ?? '/img/demo/av1.jpg' }}" alt="" style="width: 80px; height: 80px; border-radius: 50%; margin-bottom: 10px;">
                <h4>{{ auth()->user()->name }}</h4>
            </div>
            <div class="list-group">
                <a href="{{ route('user.dashboard') }}" class="list-group-item"><i class="icon-home"></i> 个人中心</a>
                <a href="{{ route('user.houses') }}" class="list-group-item active"><i class="icon-th-list"></i> 我的房源</a>
                <a href="{{ route('user.favorites') }}" class="list-group-item"><i class="icon-heart"></i> 我的收藏</a>
            </div>
        </div>
    </div>
    <div class="col-md-9">
        <h2 style="margin-bottom: 20px;">
            <i class="icon-th-list"></i> 我的房源
            <a href="{{ route('user.houses.create') }}" class="btn btn-primary btn-sm pull-right"><i class="icon-plus"></i> 发布房源</a>
        </h2>
        @if($houses->isEmpty())
            <div class="alert alert-info text-center" style="padding: 40px;">
                <h4>暂未发布房源</h4>
                <a href="{{ route('user.houses.create') }}" class="btn btn-primary">立即发布房源</a>
            </div>
        @else
            <div class="panel panel-default">
                <div class="panel-body">
                    <table class="table table-hover">
                        <thead><tr><th>标题</th><th>价格</th><th>类型</th><th>状态</th><th>发布时间</th><th>操作</th></tr></thead>
                        <tbody>
                            @foreach($houses as $house)
                            <tr>
                                <td><a href="{{ route('houses.show', $house->id) }}">{{ $house->title }}</a></td>
                                <td class="price-tag">{{ $house->formatted_price }}</td>
                                <td>{{ $house->type }}</td>
                                <td>{{ $house->status }}</td>
                                <td>{{ $house->created_at->format('Y-m-d') }}</td>
                                <td>
                                    <a href="{{ route('user.houses.edit', $house->id) }}" class="btn btn-xs btn-warning"><i class="icon-pencil"></i> 编辑</a>
                                    <form action="{{ route('user.houses.destroy', $house->id) }}" method="POST" style="display:inline;" onsubmit="return confirm('确定删除此房源？')">
                                        {{ csrf_field() }} {{ method_field('DELETE') }}
                                        <button type="submit" class="btn btn-xs btn-danger"><i class="icon-trash"></i> 删除</button>
                                    </form>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="text-center">{{ $houses->links() }}</div>
        @endif
    </div>
</div>
@endsection
