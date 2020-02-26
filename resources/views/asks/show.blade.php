@extends('layouts.app')

@section('title', 'BTC诊股回复')

@section('content')
  <div class="container-fluid col-lg-9 col-md-9">
    <div>
      <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="#">我的</a></li>
          <li class="breadcrumb-item active" aria-current="page">
            诊股回复
          </li>
        </ol>
      </nav>
    </div>
    <div class="card">
      <h6 class="card-header">
        BTC行情分析
      </h6>
      <div class="card-body">
{{--        这里采用后台赋值 start --}}
        <h5 class="card-title">Special title treatment</h5>
        <p class="card-text">With supporting text below as a natural lead-in to additional content.</p>
{{--        这里采用后台赋值 end --}}
      </div>
    </div>
    <br>
    <div class="card">
      <h6 class="card-header">BTC操作建议</h6>
      <ul class="list-group list-group-flush">
        <li class="list-group-item"><span class="text-secondary">方向：</span>{!! '破底翻，做多'!!}</li>
        <li class="list-group-item"><span class="text-secondary">可买数量：</span>5</li>
        <li class="list-group-item"><span class="text-secondary">进场点：</span>8500</li>
        <li class="list-group-item"><span class="text-secondary">停损位置：</span>8455</li>
        <li class="list-group-item"><span class="text-secondary">拉不赔目标：</span>9000</li>
        <li class="list-group-item"><span class="text-secondary">停利目标：</span>10000</li>
        <li class="list-group-item"><span class="text-secondary">最大盈/亏：</span>6.33</li>
        <li class="list-group-item"><span class="text-secondary">建议：建议买入</span></li>
      </ul>
    </div>
  </div>
@stop
