@extends('layouts.app')

@section('title', '分析报告')

@section('content')
  <div class="container-fluid col-lg-9 col-md-9">
    <div>
      <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="#">诊股</a></li>
          <li class="breadcrumb-item active" aria-current="page">
            分析报告
          </li>
        </ol>
      </nav>
    </div>
    @if ($asks->count() > 0)
    @foreach($asks as $ask)
    <div class="card mb-2">
      <div class="card-body">
        <h6 class="card-title">
          <a class="text-muted" href="{{ route('asks.show', ['ask' => $ask->id]) }}">关于<span style="color: #f66d9b">{{ $ask->name }}({{$ask->symbol}})</span>的行情分析与操作建议</a>
        </h6>
        <p class="card-text">
          <small class="text-muted">于{{ $ask->created_at->format('m/d/Y') }}提交</small>
          &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
          <small class="text-muted">{{ $ask->updated_at->diffForHumans() }}回复更新</small>
        </p>
      </div>
    </div>
    @endforeach
      @else
      <div class="card mb-2">
        <div class="card-body">
          暂无数据
        </div>
      </div>
      @endif
  </div>
@stop
