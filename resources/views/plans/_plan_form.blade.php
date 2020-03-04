<div class="form-group search-form">
  <label for="market"><span class="text-muted">市场</span></label>
  <select class="form-control" name="market">
    @foreach(config('classification.markets') as $market => $name)
      <option value="{{ $market }}" {{ isset($plan->market) ? ($plan->market == $market ? 'selected' : '') : ''}}>{{ $name }}</option>
    @endforeach
  </select>
</div>

<div class="form-group">
  <label for="symbol"><span class="text-muted">Symbol</span></label>
{{--  @if(!$plan->market || $plan->market == 'crypto')--}}
{{--  <select class="form-control" name="symbol">--}}
{{--      @foreach(config('classification.crypto_tickers') as $symbol => $ticker)--}}
{{--        <option value="{{ $symbol }}" {{ isset($plan->symbol) ? ($plan->symbol == $symbol ? 'selected' : '') : ''}}>{{ $symbol }}</option>--}}
{{--      @endforeach--}}
{{--  </select>--}}
  <input class="form-control" type="text" name="symbol" value="{{ old('symbol', $plan->symbol??'' ) }}" placeholder="" />
</div>

<div class="form-group">
  <label for="name"><span class="text-muted">名称</span></label>
  <input class="form-control" type="text" name="name" value="{{ old('name', $plan->name??'' ) }}" placeholder="" />
</div>
<div class="form-group">
  <label for="period"><span class="text-muted">周期</span></label>
  <select class="form-control" name="period">
    @foreach(config('classification.periods') as $period)
      <option value="{{ $period }}" {{ isset($plan->period)?($plan->period == $period ? 'selected' : ''): '' }}>{{ $period }}</option>
    @endforeach
  </select>
</div>
<div class="form-group">
  <label for="period"><span class="text-danger"><span class="text-muted">总资金</span></span></label>
  <input class="form-control" type="text" name="total" value="{{ old('total', $plan->total??'') }}" placeholder="" />
</div>
<div class="form-group">
  <label for="lever"><span class="text-muted">杠杆</span></label>
  <select class="form-control" name="lever">
    @foreach(config('classification.levers') as $lever => $name)
      <option value="{{ $lever }}" {{ isset($plan->lever)?($plan->lever == $lever ? 'selected' : ''):'' }}>{{ $name }}</option>
    @endforeach
  </select>
</div>
<div class="form-group">
  <label for="side"><span class="text-danger">方向</span></label>
  <select class="form-control" name="side">
    <option value="buy" {{ isset($plan->side)?($plan->side == 'buy' ? 'selected' : ''): '' }}>做多</option>
    <option value="sell" {{ isset($plan->side)?($plan->side == 'sell' ? 'selected' : ''): '' }}>做空</option>
  </select>
</div>
<div class="form-group">
  <label for="type"><span class="text-danger">标准图</span></label>
  <select class="form-control" name="type">
    <option value="pdf" {{ isset($plan->type)? ($plan->type == 'pdf' ? 'selected' : ''):'selected' }}>破底翻</option>
    <option value="break" {{ isset($plan->type)? ($plan->type == 'break' ? 'selected' : ''):'' }}>突破</option>
  </select>
</div>

<div class="form-group">
  <label for="keyPrice"><span class="text-danger"><span class="text-danger">关键价位</span></span></label>
  <input class="form-control" type="text" name="keyPrice" value="{{ old('keyPrice', $plan->keyPrice??'' )}}" placeholder="" />
</div>
<div class="form-group">
  <label for="lowestPrice"><span class="text-danger">现行低/高点</span></label>
  <input class="form-control" type="text" name="lowestPrice" value="{{ old('lowestPrice', $plan->lowestPrice?? '' ) }}" placeholder="" />
</div>
<div class="form-group">
  <label for="breakevenPrice"><span class="text-danger">拉不赔目标</span></label>
  <input class="form-control" type="text" name="breakevenPrice" value="{{ old('breakevenPrice', $plan->breakevenPrice??'' ) }}" placeholder="" />
</div>
<div class="form-group">
  <label for="targetPrice"><span class="text-danger">停利目标</span></label>
  <input class="form-control" type="text" name="targetPrice" value="{{ old('targetPrice', $plan->targetPrice??'' ) }}" placeholder="" />
</div>
@can('manage_trades')
<div class="form-group">
  <label for="status"><span class="text-muted">上线/下线</span></label>
  <select class="form-control" name="status">
    <option value="online" {{ isset($plan->status)?($plan->status == 'online' ? 'selected' : ''): 'selected' }}>上线</option>
    <option value="offline" {{ isset($plan->status)?($plan->status == 'offline' ? 'selected' : ''): '' }}>下线</option>
  </select>
</div>
<div class="form-group">
  <label for="status"><span class="text-muted">官方/私有</span></label>
  <select class="form-control" name="tag">
    <option value="official" {{ isset($plan->tag)?($plan->tag == 'official' ? 'selected' : ''): 'selected' }}>官方</option>
    <option value="private" {{ isset($plan->tag)?($plan->tag == 'private' ? 'selected' : ''): '' }}>私有</option>
  </select>
</div>
@endcan

@section('scripts')
  <script !src="">
    $('.search-form select[name=market]').on('change', function() {

    });
  </script>
@endsection
