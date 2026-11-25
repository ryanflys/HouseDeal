@extends('layouts.admin')
@section('title', '交易管理 - HouseDeal 后台')
@section('breadcrumb')<span class="divider">/</span> <a href="#">交易管理</a>@endsection

@section('content')
<div class="row-fluid">
    <div class="widget-box">
        <div class="widget-title"><span class="icon"><i class="icon-tags"></i></span><h5>交易列表</h5></div>
        <div class="widget-content nopadding">
            <form action="{{ route('admin.deals.index') }}" method="GET" class="form-inline" style="padding: 10px;">
                <select name="status" class="form-control" style="width: 120px;">
                    <option value="">全部状态</option>
                    <option value="pending" {{ request('status') == 'pending' ? 'selected' : '' }}>待处理</option>
                    <option value="deposit" {{ request('status') == 'deposit' ? 'selected' : '' }}>已付定金</option>
                    <option value="contract" {{ request('status') == 'contract' ? 'selected' : '' }}>已签合同</option>
                    <option value="done" {{ request('status') == 'done' ? 'selected' : '' }}>交易完成</option>
                    <option value="canceled" {{ request('status') == 'canceled' ? 'selected' : '' }}>已取消</option>
                </select>
                <button type="submit" class="btn btn-primary"><i class="icon-filter"></i> 筛选</button>
            </form>
            <table class="table table-bordered table-striped">
                <thead><tr><th>ID</th><th>房产</th><th>经纪人</th><th>交易价</th><th>状态</th><th>签约时间</th><th>操作</th></tr></thead>
                <tbody>
                    @foreach($deals as $deal)
                    <tr>
                        <td>{{ $deal->id }}</td>
                        <td>{{ $deal->house->title ?? '-' }}</td>
                        <td>{{ $deal->agent->name ?? '-' }}</td>
                        <td>¥{{ number_format($deal->deal_price) }}</td>
                        <td>{{ $deal->status_label }}</td>
                        <td>{{ $deal->signed_at ? $deal->signed_at->format('Y-m-d') : '-' }}</td>
                        <td><a href="{{ route('admin.deals.edit', $deal->id) }}" class="btn btn-warning btn-mini"><i class="icon-pencil"></i> 处理</a></td>
                    </tr>
                    @endforeach
                    @if($deals->isEmpty())<tr><td colspan="7" class="text-center text-muted" style="padding: 20px;">暂无交易记录</td></tr>@endif
                </tbody>
            </table>
        </div>
    </div>
</div>
<div class="text-center">{{ $deals->links() }}</div>
@endsection
