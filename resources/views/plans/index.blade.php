@extends('layouts.app')

@section('title', '我的交易计划')

@section('content')

  <div class="row mb-5">
    <div class="col-lg-9 col-md-9 topic-list">
      <ul class="nav nav-tabs">
        <li class="nav-item">
          <a class="nav-link {{ if_query('market', null) ? 'active' : '' }}" href="{{ route('plans.index') }}">全部</a>
        </li>
        @foreach(config('classification.markets') as $market => $name)
          <li class="nav-item">
            <a class="nav-link {{ if_query('market', $market) ? 'active' : '' }}" href="{{ route('plans.index', ['market' => $market]) }}">{{ $name }}</a>
          </li>
        @endforeach
      </ul>
      <br>
      @include('plans._plan_list', ['plans' => $plans])
      <div class="mt-5">

        {!! $plans->appends(Request::except('page'))->render() !!}
      </div>
    </div>

    <div class="col-lg-3 col-md-3 sidebar">
      @include('plans._sidebar', ['plan'=> $plan])
    </div>
  </div>

@endsection
