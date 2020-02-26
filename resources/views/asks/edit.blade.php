@extends('layouts.app')

@section('title', '我要诊股')

@section('content')
  <div class="container-fluid col-lg-9 col-md-9">
    <div>
      <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="#">交易</a></li>
          <li class="breadcrumb-item active" aria-current="page">
            我要诊股
          </li>
        </ol>
      </nav>
    </div>
    <div class="card">
      <div class="card-body">
        @if($ask->id)
          <form action="{{ route('asks.update', ['ask'=>$ask->id]) }}" method="POST" accept-charset="UTF-8">
            {{ method_field('PUT') }}
          @else
              <form action="{{ route('asks.store') }}" method="POST" accept-charset="UTF-8">
            @endif
          <input type="hidden" name="_token" value="{{ csrf_token() }}">
          @include('shared._error')
          <div class="form-group">
            <label for="market"><span class="text-muted">市场</span></label>
            <select class="form-control" name="market" required>
              @foreach(config('classification.markets') as $market => $name)
                <option value="{{ $market }}" {{ $market == $ask->$market ? 'selected': ''}}>{{ $name }}</option>
              @endforeach
            </select>
          </div>
          <div class="form-group">
            <label for="name"><span class="text-danger">*</span><span class="text-muted">名称</span></label>
            <input class="form-control" type="text" name="name" value="{{ old('name', $ask->name) }}" placeholder="如：比特币、阿里巴巴、黄金" required/>
          </div>
          <div class="form-group">
            <label for="symbol"><span class="text-danger">*</span><span class="text-muted">代码</span></label>
            <input class="form-control" type="text" name="symbol" value="{{ old('symbol', $ask->symbol) }}" placeholder="如：BTCUSDT、700、300033" required />
          </div>

          <div class="form-group">
            <label for="period"><span class="text-muted">周期</span></label>
            <select class="form-control" name="period" required>
              @foreach(config('classification.periods') as $period)
                <option value="{{ $period }}" {{ $period == $ask->$period?'selected':'' }}>{{ $period }}</option>
              @endforeach
            </select>
          </div>
          <div class="form-group">
            <label for="total"><span class="text-muted">可投总资金</span></label>
            <input class="form-control" type="text" name="total" value="{{ old('total', $ask->total) }}" placeholder="数字" required />
          </div>
          <div class="form-group">
            <label for="unit"><span class="text-muted">资金单位</span></label>
            <input class="form-control" type="text" name="unit" value="{{ old('unit', $ask->unit) }}" placeholder="如btc、usdt、人民币、美金" required />
          </div>
          <div class="form-group">
            <label for="lever"><span class="text-muted">杠杆</span></label>
            <select class="form-control" name="lever" required>
              @foreach(config('classification.levers') as $lever => $name)
                <option value="{{ $lever }}" {{ $lever == $ask->lever }}>{{ $name }}</option>
              @endforeach
            </select>
          </div>
          <div class="form-group">
            <label for="remark"><span class="text-muted">备注(选填)</span></label>
            <textarea class="form-control" name="remark" rows="3">{{ old('remark', $ask->remark) }}</textarea>
          </div>
          <div class="well well-sm pull-right">
            @if($ask->id)
              <a href="{{ route('asks.index') }}" class="btn btn-sm btn-outline-secondary">返回</a>
            @endif
            <button type="submit" class="btn btn-sm btn-outline-primary"><i class="far fa-save mr-2" aria-hidden="true"></i> 保存</button>
          </div>
        </form>
      </div>
    </div>
  </div>
@endsection
