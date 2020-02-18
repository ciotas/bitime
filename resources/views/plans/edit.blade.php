<!-- Modal -->
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLongTitle">
          @if($plan->id)
            编辑交易计划
          @else
            新建交易计划
          @endif
        </h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        @if($plan->id)
          <form action="{{ route('plans.update', $plan->id) }}" method="POST" accept-charset="UTF-8">
            <input type="hidden" name="_method" value="PUT">
            @else
              <form action="{{ route('plans.store') }}" method="POST" accept-charset="UTF-8">
                @endif
                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                @include('shared._error')
                <div class="form-group">
                  <label for="market">市场</label>
                  <select class="form-control" name="market" required>
                    @foreach(config('classification.markets') as $market => $name)
                      <option value="{{ $market }}" {{ $plan->market == $market ? 'selected' : '' }}>{{ $name }}</option>
                    @endforeach
                  </select>
                </div>
                <div class="form-group">
                  <label for="symbol">Symbol</label>
                  <input class="form-control" type="text" name="symbol" value="{{ old('symbol', $plan->symbol ) }}" placeholder="" required />
                </div>
                <div class="form-group">
                  <label for="name">名称</label>
                  <input class="form-control" type="text" name="name" value="{{ old('name', $plan->name ) }}" placeholder="可选" required />
                </div>
                <div class="form-group">
                  <label for="period">周期</label>
                  <select class="form-control" name="period" required>
                    @foreach(config('classification.periods') as $period)
                    <option value="{{ $period }}" {{ $plan->period == $period ? 'selected' : '' }}>{{ $period }}</option>
                    @endforeach
                  </select>
                </div>
                <div class="form-group">
                  <label for="period"><span class="text-danger">总资金</span></label>
                  <input class="form-control" type="text" name="total" value="{{ old('total', $plan->total ) }}" placeholder="" required />
                </div>
                <div class="form-group">
                  <label for="lever">杠杆</label>
                  <select class="form-control" name="lever" required>
                    @foreach(config('classification.levers') as $lever => $name)
                    <option value="{{ $lever }}" {{ $plan->lever == $lever ? 'selected' : '' }}>{{ $name }}</option>
                    @endforeach
                  </select>
                </div>
                <div class="form-group">
                  <label for="ticker">Ticker</label>
                  <input class="form-control" type="text" name="ticker" value="{{ old('ticker', $plan->ticker ) }}" placeholder="" required />
                </div>
                <div class="form-group">
                  <label for="type"><span class="text-danger">标准图</span></label>
                  <select class="form-control" name="type" required>
                    <option value="pdf" {{ $plan->type == 'pdf' ? 'selected' : '' }}>破底翻</option>
                    <option value="break" {{ $plan->type == 'break' ? 'selected' : '' }}>突破</option>
                  </select>
                </div>

                <div class="form-group">
                  <label for="keyPrice"><span class="text-danger">关键价位</span></label>
                  <input class="form-control" type="text" name="keyPrice" value="{{ old('keyPrice', $plan->keyPrice ) }}" placeholder="" required />
                </div>
                <div class="form-group">
                  <label for="lowestPrice"><span class="text-danger">现行低点</span></label>
                  <input class="form-control" type="text" name="lowestPrice" value="{{ old('lowestPrice', $plan->lowestPrice ) }}" placeholder="" required />
                </div>
                <div class="form-group">
                  <label for="targetPrice"><span class="text-danger">停利目标</span></label>
                  <input class="form-control" type="text" name="targetPrice" value="{{ old('targetPrice', $plan->targetPrice ) }}" placeholder="" required />
                </div>
                <div class="form-group">
                  <label for="breakevenPrice"><span class="text-danger">拉不赔目标</span></label>
                  <input class="form-control" type="text" name="breakevenPrice" value="{{ old('breakevenPrice', $plan->breakevenPrice ) }}" placeholder="" required />
                </div>
                <div class="form-group">
                  <label for="expectRate">期望盈亏比</label>
                  <select class="form-control" name="expectRate" required>
                    @foreach(config('classification.expectRates') as $expectRate)
                      <option value="{{ $expectRate }}" {{ $plan->type == $expectRate ? 'selected' : '' }}>{{ $expectRate }}</option>
                    @endforeach
                  </select>
                </div>

                <div class="well well-sm pull-right">
                  <button type="button" class="btn btn-secondary" data-dismiss="modal">关闭</button>
                  <button type="submit" class="btn btn-primary"><i class="far fa-save mr-2" aria-hidden="true"></i> 保存</button>
                </div>
              </form>
      </div>
    </div>
  </div>
