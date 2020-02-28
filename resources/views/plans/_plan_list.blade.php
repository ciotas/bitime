<div class="row row-cols-1 row-cols-md-4">
@if (count($plans))
    @foreach ($plans as $plan)
      <div class="col mb-3">
        <div class="card">
          <h6 class="card-header">
            @if($plan->tag == 'private')
            <i class="fas fa-lock"></i>
            @endif
            {{$plan->name ? $plan->name .'/ '. $plan->symbol : $plan->symbol }}
          </h6>
          <ul class="list-group list-group-flush">
            <li class="list-group-item"><span class="text-secondary">方向：</span>{!! ($plan->type == 'pdf'?'破底翻':'突破').'，'.($plan->side == 'buy'?'<span class="text-success">做多</span>':'<span class="text-danger">做空</span>') !!}</li>
            <li class="list-group-item"><span class="text-secondary">可{{ $plan->side == 'buy'?'买':'卖' }}数量：</span>{{ $plan->availableShares }}</li>
            <li class="list-group-item"><span class="text-secondary">进场点：</span>{{ $plan->shouldBuyPrice }}</li>
            <li class="list-group-item"><span class="text-secondary">停损位置：</span>{{ $plan->stopLossPrice }}</li>
            <li class="list-group-item"><span class="text-secondary">拉不赔目标：</span>{{ $plan->breakevenPrice }}</li>
            <li class="list-group-item"><span class="text-secondary">停利目标：</span>{{ $plan->targetPrice }}</li>
            <li class="list-group-item"><span class="text-secondary">最大盈/亏：</span>{{ $plan->maxProfit }} / -{{ $plan->maxLoss }} = {{ $plan->realRate }}</li>
            <li class="list-group-item"><span class="text-secondary">创建时间：</span> {{ $plan->created_at->diffForhumans() }}</li>
          </ul>
          @if(Auth::check()) {{--  && $plan->UserSubscribed --}}
            @can('manage_trades')
            <div class="card-body">
              @if($plan->tag == 'official')
              <form action="{{ route('plans.destroy', $plan->id) }}" method="post"
                    style="display: inline-block;"
                    onsubmit="return confirm('您确定要删除吗？');">
                {{ csrf_field() }}
                {{ method_field('DELETE') }}
                <button type="submit" class="btn btn-outline-danger btn-sm">
                  <i class="far fa-trash-alt"></i> 删除
                </button>
              </form>
              @endif
              <a href="{{ route('plans.edit', ['plan'=>$plan->id]) }}" class="btn btn-outline-secondary btn-sm" >
                重新计算
              </a>
            </div>
            @endcan
          @else
{{--          <div class="card-body">--}}
{{--            <form action="{{ route('users.subscribe.store') }}" method="post">--}}
{{--              {{ csrf_field() }}--}}
{{--              <input type="hidden" name="plan_id" value="{{ $plan->id }}">--}}
{{--              <button type="submit" class="btn btn-block btn-outline-success btn-sm">--}}
{{--                 订阅--}}
{{--              </button>--}}
{{--            </form>--}}
{{--          </div>--}}
          @endif
        </div>
      </div>
    @endforeach
@else
    <div class="container-fluid col-lg-12 col-md-12">
      <div class="card">
        <div class="card-body">
          暂无数据
        </div>
      </div>
    </div>
@endif
</div>
