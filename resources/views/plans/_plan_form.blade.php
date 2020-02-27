<div class="form-group">
  <label for="market"><span class="text-muted">市场</span></label>
  <select class="form-control" name="market">
    @foreach(config('classification.markets') as $market => $name)
      <option value="{{ $market }}" {{ isset($plan->market) ? ($plan->market == $market ? 'selected' : '') : ''}}>{{ $name }}</option>
    @endforeach
  </select>
</div>
<div class="form-group">
  <label for="symbol"><span class="text-muted">Symbol</span></label>
  <input class="form-control" type="text" name="symbol" value="{{ old('symbol', $plan->symbol??'' ) }}" placeholder="" />
</div>
<div class="form-group">
  <label for="name"><span class="text-muted">名称</span></label>
  <input class="form-control" type="text" name="name" value="{{ old('name', $plan->name??'' ) }}" placeholder="可选" />
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
  <label for="ticker"><span class="text-muted">Ticker</span></label>
  <input class="form-control" type="text" name="ticker" value="{{ old('ticker', $plan->ticker??'' ) }}" placeholder=""  />
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
    <option value="pdf" {{ isset($plan->type)? ($plan->type == 'pdf' ? 'selected' : ''):'' }}>破底翻</option>
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
