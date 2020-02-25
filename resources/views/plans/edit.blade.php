@extends('layouts.app')

@section('title', '交易计划')

@section('content')
  <div class="container-fluid col-lg-9 col-md-9">
    <div>
      <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="#">交易</a></li>
          <li class="breadcrumb-item active" aria-current="page">
            @if($plan->id)
              编辑计划
            @else
              发布计划
            @endif
              </li>
        </ol>
      </nav>
    </div>
  <div class="card">
    <div class="card-body">
      @if($plan->id)
        <form action="{{ route('plans.update', $plan->id) }}" method="POST" accept-charset="UTF-8">
          <input type="hidden" name="_method" value="PUT">
          @else
            <form action="{{ route('plans.store') }}" method="POST" accept-charset="UTF-8">
              @endif
              <input type="hidden" name="_token" value="{{ csrf_token() }}">
              @include('shared._error')
              <div class="form-group">
                <label for="market"><span class="text-muted">市场</span></label>
                <select class="form-control" name="market" required>
                  @foreach(config('classification.markets') as $market => $name)
                    <option value="{{ $market }}" {{ $plan->market == $market ? 'selected' : '' }}>{{ $name }}</option>
                  @endforeach
                </select>
              </div>
              <div class="form-group">
                <label for="symbol"><span class="text-muted">Symbol</span></label>
                <input class="form-control" type="text" name="symbol" value="{{ old('symbol', $plan->symbol ) }}" placeholder="" required />
              </div>
              <div class="form-group">
                <label for="name"><span class="text-muted">名称</span></label>
                <input class="form-control" type="text" name="name" value="{{ old('name', $plan->name ) }}" placeholder="可选" />
              </div>
              <div class="form-group">
                <label for="period"><span class="text-muted">周期</span></label>
                <select class="form-control" name="period" required>
                  @foreach(config('classification.periods') as $period)
                    <option value="{{ $period }}" {{ $plan->period == $period ? 'selected' : '' }}>{{ $period }}</option>
                  @endforeach
                </select>
              </div>
              <div class="form-group">
                <label for="period"><span class="text-danger"><span class="text-muted">总资金</span></span></label>
                <input class="form-control" type="text" name="total" value="{{ old('total', $plan->total ) }}" placeholder="" required />
              </div>
              <div class="form-group">
                <label for="lever"><span class="text-muted">杠杆</span></label>
                <select class="form-control" name="lever" required>
                  @foreach(config('classification.levers') as $lever => $name)
                    <option value="{{ $lever }}" {{ $plan->lever == $lever ? 'selected' : '' }}>{{ $name }}</option>
                  @endforeach
                </select>
              </div>
              <div class="form-group">
                <label for="ticker"><span class="text-muted">Ticker</span></label>
                <input class="form-control" type="text" name="ticker" value="{{ old('ticker', $plan->ticker ) }}" placeholder="" required />
              </div>
              <div class="form-group">
                <label for="side"><span class="text-danger">方向</span></label>
                <select class="form-control" name="side" required>
                  <option value="buy" {{ $plan->side == 'buy' ? 'selected' : '' }}>做多</option>
                  <option value="sell" {{ $plan->side == 'sell' ? 'selected' : '' }}>做空</option>
                </select>
              </div>
              <div class="form-group">
                <label for="type"><span class="text-danger">标准图</span></label>
                <select class="form-control" name="type" required>
                  <option value="pdf" {{ $plan->type == 'pdf' ? 'selected' : '' }}>破底翻</option>
                  <option value="break" {{ $plan->type == 'break' ? 'selected' : '' }}>突破</option>
                </select>
              </div>

              <div class="form-group">
                <label for="keyPrice"><span class="text-danger"><span class="text-muted">关键价位</span></span></label>
                <input class="form-control" type="text" name="keyPrice" value="{{ old('keyPrice', $plan->keyPrice ) }}" placeholder="" required />
              </div>
              <div class="form-group">
                <label for="lowestPrice"><span class="text-danger">现行低/高点</span></label>
                <input class="form-control" type="text" name="lowestPrice" value="{{ old('lowestPrice', $plan->lowestPrice ) }}" placeholder="" required />
              </div>
              <div class="form-group">
                <label for="breakevenPrice"><span class="text-danger">拉不赔目标</span></label>
                <input class="form-control" type="text" name="breakevenPrice" value="{{ old('breakevenPrice', $plan->breakevenPrice ) }}" placeholder="" required />
              </div>
              <div class="form-group">
                <label for="targetPrice"><span class="text-danger">停利目标</span></label>
                <input class="form-control" type="text" name="targetPrice" value="{{ old('targetPrice', $plan->targetPrice ) }}" placeholder="" required />
              </div>
              <div class="well well-sm pull-right">
                @if($plan->id)
                <a href="{{ route('plans.index', ['market' => $plan->market]) }}" class="btn btn-sm btn-outline-secondary">返回</a>
                @endif
                <button type="submit" class="btn btn-sm btn-outline-primary"><i class="far fa-save mr-2" aria-hidden="true"></i> 保存</button>
              </div>
            </form>
    </div>
  </div>

  </div>
@stop
