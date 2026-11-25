@extends('layouts.admin')

@section('title', '仪表盘 - HouseDeal 后台')
@section('breadcrumb')<span class="divider">/</span> <a href="#">仪表盘</a>@endsection

@section('content')
<div class="row-fluid">
    <div class="quick-actions_homepage">
        <ul class="quick-actions">
            <li class="bg_lb"><a href="{{ route('admin.houses.index') }}"><i class="icon-th"></i> <span class="label">{{ $stats['house_count'] }}</span> 房源总数</a></li>
            <li class="bg_lg"><a href="{{ route('admin.users.index') }}"><i class="icon-user"></i> <span class="label">{{ $stats['user_count'] }}</span> 用户总数</a></li>
            <li class="bg_ly"><a href="{{ route('admin.agents.index') }}"><i class="icon-briefcase"></i><span class="label label-success">{{ $stats['agent_count'] }}</span> 经纪人数</a></li>
            <li class="bg_lo"><a href="{{ route('admin.deals.index') }}"><i class="icon-tags"></i> <span class="label">{{ $stats['deal_count'] }}</span> 交易总数</a></li>
        </ul>
    </div>
</div>

<div class="row-fluid" style="margin-top: 20px;">
    <div class="widget-box">
        <div class="widget-title bg_lg"><span class="icon"><i class="icon-signal"></i></span><h5>交易统计</h5></div>
        <div class="widget-content">
            <ul class="site-stats">
                <li class="bg_lh"><i class="icon-time"></i> <strong>{{ $stats['pending_deals'] }}</strong> <small>待处理交易</small></li>
                <li class="bg_lh"><i class="icon-ok"></i> <strong>{{ $stats['done_deals'] }}</strong> <small>已完成交易</small></li>
                <li class="bg_lh"><i class="icon-tags"></i> <strong>{{ $stats['deal_count'] }}</strong> <small>交易总量</small></li>
                <li class="bg_lh"><i class="icon-th"></i> <strong>{{ $stats['house_count'] }}</strong> <small>房源总量</small></li>
            </ul>
        </div>
    </div>
</div>

<div class="row-fluid" style="margin-top: 20px;">
    <div class="span6">
        <div class="widget-box">
            <div class="widget-title"><span class="icon"><i class="icon-th"></i></span><h5>最新房源</h5></div>
            <div class="widget-content nopadding">
                <table class="table table-bordered">
                    <thead><tr><th>标题</th><th>价格</th><th>状态</th><th>时间</th></tr></thead>
                    <tbody>
                        @foreach($recentHouses as $house)
                        <tr><td>{{ $house->title }}</td><td>{{ $house->formatted_price }}</td><td>{{ $house->status }}</td><td>{{ $house->created_at->format('m-d') }}</td></tr>
                        @endforeach
                        @if($recentHouses->isEmpty())<tr><td colspan="4" class="text-center text-muted">暂无房源</td></tr>@endif
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <div class="span6">
        <div class="widget-box">
            <div class="widget-title"><span class="icon"><i class="icon-tags"></i></span><h5>最新交易</h5></div>
            <div class="widget-content nopadding">
                <table class="table table-bordered">
                    <thead><tr><th>房产</th><th>交易价</th><th>状态</th><th>时间</th></tr></thead>
                    <tbody>
                        @foreach($recentDeals as $deal)
                        <tr><td>{{ $deal->house->title ?? '-' }}</td><td>{{ number_format($deal->deal_price) }}</td><td>{{ $deal->status_label }}</td><td>{{ $deal->created_at->format('m-d') }}</td></tr>
                        @endforeach
                        @if($recentDeals->isEmpty())<tr><td colspan="4" class="text-center text-muted">暂无交易</td></tr>@endif
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection
