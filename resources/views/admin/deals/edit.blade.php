@extends('layouts.admin')
@section('title', '处理交易 - HouseDeal 后台')
@section('breadcrumb')<span class="divider">/</span> <a href="{{ route('admin.deals.index') }}">交易管理</a> <span class="divider">/</span> 处理交易@endsection

@section('content')
<div class="row-fluid">
    <div class="widget-box">
        <div class="widget-title"><span class="icon"><i class="icon-tags"></i></span><h5>交易详情 - #{{ $deal->id }}</h5></div>
        <div class="widget-content nopadding">
            <table class="table table-bordered">
                <tr><th style="width:120px;">房产</th><td>{{ $deal->house->title ?? '-' }}</td></tr>
                <tr><th>经纪人</th><td>{{ $deal->agent->name ?? '-' }}</td></tr>
                <tr><th>买方</th><td>{{ $deal->buyer->name ?? '-' }}</td></tr>
                <tr><th>卖方</th><td>{{ $deal->seller->name ?? '-' }}</td></tr>
                <tr><th>交易价格</th><td>¥{{ number_format($deal->deal_price) }}</td></tr>
                <tr><th>交易类型</th><td>{{ $deal->deal_type }}</td></tr>
                <tr><th>当前状态</th><td>{{ $deal->status_label }}</td></tr>
                <tr><th>签约时间</th><td>{{ $deal->signed_at ? $deal->signed_at->format('Y-m-d H:i') : '未签约' }}</td></tr>
            </table>
        </div>
    </div>
</div>

<div class="row-fluid" style="margin-top: 20px;">
    <div class="widget-box">
        <div class="widget-title"><span class="icon"><i class="icon-edit"></i></span><h5>更新交易状态</h5></div>
        <div class="widget-content nopadding">
            <form action="{{ route('admin.deals.update', $deal->id) }}" method="POST" class="form-horizontal">
                {{ csrf_field() }} {{ method_field('PUT') }}
                <div class="control-group">
                    <label class="control-label">交易状态</label>
                    <div class="controls">
                        <select name="status" class="span6">
                            <option value="pending" {{ $deal->status == 'pending' ? 'selected' : '' }}>待处理</option>
                            <option value="deposit" {{ $deal->status == 'deposit' ? 'selected' : '' }}>已付定金</option>
                            <option value="contract" {{ $deal->status == 'contract' ? 'selected' : '' }}>已签合同</option>
                            <option value="done" {{ $deal->status == 'done' ? 'selected' : '' }}>交易完成</option>
                            <option value="canceled" {{ $deal->status == 'canceled' ? 'selected' : '' }}>已取消</option>
                        </select>
                    </div>
                </div>
                <div class="control-group">
                    <label class="control-label">交易价格</label>
                    <div class="controls"><input type="number" name="deal_price" class="span6" value="{{ old('deal_price', $deal->deal_price) }}"></div>
                </div>
                <div class="form-actions">
                    <button type="submit" class="btn btn-primary"><i class="icon-ok"></i> 更新交易</button>
                    <a href="{{ route('admin.deals.index') }}" class="btn">返回列表</a>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
