@extends('layouts.app')

@section('title', '关于'.$ask->symbol.'的诊股分析')

@section('content')
  <div class="container-fluid col-lg-9 col-md-9">
    <div>
      <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="#">我的</a></li>
          <li class="breadcrumb-item active" aria-current="page">
            诊股分析
          </li>
        </ol>
      </nav>
    </div>
    <div class="card">
      <h6 class="card-header">
        <code>{{$ask->name}}/{{$ask->symbol}}</code>的行情分析
      </h6>
      <div class="card-body topic-body">
{{--        这里采用后台赋值 start --}}
        {!! $ask->analyzer->body !!}
{{--        这里采用后台赋值 end --}}
      </div>
    </div>
    <br>
    @if($ask->analyzer->use_plan)
    <div class="card">
      <h6 class="card-header">BTC操作建议</h6>
      <ul class="list-group list-group-flush">
        <li class="list-group-item"><span class="text-secondary">方向：</span>
          {!! $ask->analyzer->plan->side == 'buy'?'<span class="text-success">做多</span>':'<span class="text-danger">做空</span>' !!}
        </li>
        <li class="list-group-item"><span class="text-secondary">可买数量：</span>{{ $ask->analyzer->plan->availableShares }}</li>
        <li class="list-group-item"><span class="text-secondary">进场点：</span>{{ $ask->analyzer->plan->shouldBuyPrice }}</li>
        <li class="list-group-item"><span class="text-secondary">停损位置：</span>{{ $ask->analyzer->plan->stopLossPrice }}</li>
        <li class="list-group-item"><span class="text-secondary">拉不赔目标：</span>{{ $ask->analyzer->plan->breakevenPrice }}</li>
        <li class="list-group-item"><span class="text-secondary">停利目标：</span>{{ $ask->analyzer->plan->targetPrice }}</li>
        <li class="list-group-item"><span class="text-secondary">最大盈/亏：</span>{{ $ask->analyzer->plan->maxProfit }} / -{{ $ask->analyzer->plan->maxLoss }} = {{ $ask->analyzer->plan->realRate }}</li>
        <li class="list-group-item"><span class="text-secondary">建议：{{ $ask->analyzer->plan->worthToBuy }}</span></li>
      </ul>
    </div>
    @endif
  </div>
@stop
