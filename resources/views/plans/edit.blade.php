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
              @include('plans._plan_form', ['plan'=>$plan, 'ask'=>null])
              <div class="well well-sm pull-right">
                @if($plan->id)
                <a href="{{ route('plans.index', ['market' => $plan->market]) }}" class="btn btn-sm btn-outline-secondary">返回</a>
                @endif
                <button type="submit" class="btn btn-sm btn-outline-success"><i class="far fa-save mr-2" aria-hidden="true"></i> 保存</button>
              </div>
            </form>
    </div>
  </div>

  </div>
@stop
