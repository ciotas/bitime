@extends('layouts.app')

@section('title', '搜索交易计划')

@section('content')
  <div class="row mb-5">
    <div class="col-lg-12 col-md-12 topic-list">
      <div class="card-header bg-transparent">
        <i class="fas fa-search"></i>
        为您找到 {{ $plans->count() }} 条关于
        <span class="badge badge-light">{{ $q }}</span>
        的内容
      </div>
      <br>
      @include('plans._plan_list', ['plans' => $plans])
      <div class="mt-5">
        {!! $plans->appends(Request::except('page'))->render() !!}
      </div>
    </div>
  </div>

@endsection
