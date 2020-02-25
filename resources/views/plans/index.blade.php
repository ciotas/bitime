@extends('layouts.app')

@section('title', '我的交易计划')

@section('content')
  <div class="row mb-5">
    <div class="col-lg-12 col-md-12">
    <nav aria-label="breadcrumb">
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="#">交易</a></li>
        <li class="breadcrumb-item active" aria-current="page">{{ config('classification.markets')[request('market')] }}</li>
      </ol>
    </nav>
  </div>
    <div class="col-lg-12 col-md-12 topic-list">
      <br>
      @include('plans._plan_list', ['plans' => $plans])
      <div class="mt-5">
        {!! $plans->appends(Request::except('page'))->render() !!}
      </div>
    </div>
  </div>

@endsection
