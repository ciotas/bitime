@extends('layouts.app')

@section('title',
    request('tab') == 'todo'?'待处理':(request('tab') == 'doing'?'分析中':'已完成').'诊股'
)

@section('content')
  <div class="container-fluid col-lg-12 col-md-12">
    <div>
      <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="#">工作台</a></li>
          <li class="breadcrumb-item active" aria-current="page">
            {{request('tab') == 'todo'?'待处理':(request('tab') == 'doing'?'分析中':'已完成')}}
          </li>
        </ol>
      </nav>
    </div>
    <div class="card">
      <div class="card-body">
        @if($asks->count() > 0)
        <table class="table table-striped">
          <thead>
          <tr>
            <th scope="col">#</th>
            <th scope="col">用户</th>
            <th scope="col">名称 / Symbol</th>
            <th scope="col">市场</th>
            <th scope="col">周期</th>
            <th scope="col">总资金</th>
            <th scope="col">杠杆</th>
            <th scope="col">备注</th>
            <th scope="col">操作</th>
          </tr>
          </thead>
          <tbody>
          @foreach($asks as $key=>$ask)
          <tr>
            <th scope="row">{{ ++$key }}</th>
            <td>{{ $ask->user->name }}</td>
            <td>{{ $ask->name }}/ {{ $ask->symbol }}</td>
            <td>{{ config('classification.markets')[$ask->market] }}</td>
            <td>{{ $ask->period }}</td>
            <td>{{ $ask->total }}{{$ask->unit}}</td>
            <td>{{ $ask->lever }}x</td>
            <td>
              @if($ask->remark)
                @include('asks._view_remark', [ 'ask'=> $ask ])
              @else
                /
              @endif
            </td>
            <td>
              @include('asks._reply', [ 'ask'=>$ask ])
            </td>
          </tr>
          @endforeach
          </tbody>
        </table>
          <div class="mt-3">
            {!! $asks->appends(Request::except('page'))->render() !!}
          </div>
          @else
          暂无数据
        @endif
      </div>
    </div>
  </div>
@stop
