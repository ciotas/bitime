<div class="row row-cols-1 row-cols-md-3">
@if (count($plans))
    @foreach ($plans as $plan)
      <div class="col mb-3">
        <div class="card">
          <h5 class="card-header">{{$plan->name ? $plan->name .'/ '. $plan->symbol : $plan->symbol }}</h5>
  {{--        <div class="card-body">--}}
  {{--          <h5 class="card-title">{{ $plan->symbol }}</h5>--}}
  {{--        </div>--}}
          <ul class="list-group list-group-flush">
            <li class="list-group-item">总资金：{{ $plan->total }}</li>
            <li class="list-group-item">杠杆：{{ $plan->lever }}</li>
            <li class="list-group-item">可用资金：{{ $plan->availableMoney }}</li>
            <li class="list-group-item">标准图：{{ $plan->type == 'pdf'?'破底翻':'突破' }}</li>
            <li class="list-group-item">期望盈亏比：{{ $plan->expectRate }}</li>
            <li class="list-group-item">可买数量：{{ $plan->availableShares }}</li>
            <li class="list-group-item">关键价位：{{ $plan->keyPrice }}</li>
            <li class="list-group-item">现行低点：{{ $plan->lowestPrice }}</li>
            <li class="list-group-item">最大停损空间：{{ $plan->maxStopLossDis }}</li>
            <li class="list-group-item">停利目标：<span class="text-success">{{ $plan->targetPrice }}</span></li>
            <li class="list-group-item">拉不赔目标：<span class="text-success">{{ $plan->breakevenPrice }}</span></li>
            <li class="list-group-item">停损点：<span class="text-success">{{ $plan->stopLossPrice }}</span></li>
            <li class="list-group-item">合理进场点：<span class="text-success">{{ $plan->shouldBuyPrice }}</span></li>
            <li class="list-group-item">值得入吗：{!! $plan->worthToBuy >= 0 ? '<span class="badge badge-success">Y</span>' : '<span class="badge badge-danger">N</span>' !!}</li>
          </ul>
          <div class="card-body">
            @include('plans._editbtn', ['plan'=> $plan])
          </div>
        </div>
      </div>
    @endforeach

@else
  <div class="empty-block">暂无数据 ~_~ </div>
@endif
</div>
