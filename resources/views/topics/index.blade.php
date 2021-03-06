@extends('layouts.app')

@section('title', isset($category) ?  $category->name : '话题列表')

@section('content')

  <div class="row mb-5">
    <div class="col-lg-9 col-md-9 topic-list">
{{--      @if (isset($category) && !empty($category->description))--}}
{{--        <div class="alert alert-info" role="alert">--}}
{{--          {{ $category->name }} ：{{ $category->description }}--}}
{{--        </div>--}}
{{--      @endif--}}

      @if(isset($category) && $category->id == 4)
        <nav aria-label="breadcrumb">
          <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="#">市场</a></li>
            <li class="breadcrumb-item active" aria-current="page">
              交易记录
            </li>
          </ol>
        </nav>
      @endif
      <div class="card">
{{--        排序--}}
{{--        <div class="card-header bg-transparent">--}}
{{--          <ul class="nav">--}}
{{--            <li class="nav-item">--}}
{{--              <a class="nav-link {{ active_class(! if_query('order', 'recent')) }}" href="{{ Request::url() }}?order=default">最后回复</a>--}}
{{--            </li>--}}
{{--            <li class="nav-item">--}}
{{--              <a class="nav-link {{ active_class(  if_query('order', 'recent')) }}" href="{{ Request::url() }}?order=recent">最新发布</a>--}}
{{--            </li>--}}
{{--          </ul>--}}
{{--        </div>--}}

        <div class="card-body">
          {{-- 话题列表 --}}
          @include('topics._topic_list', ['topics' => $topics])
          {{-- 分页 --}}
          <div class="mt-5">
            {!! $topics->appends(Request::except('page'))->render() !!}
          </div>
        </div>
      </div>
    </div>

    <div class="col-lg-3 col-md-3 sidebar">
      @include('topics._sidebar')
    </div>
  </div>

@endsection
