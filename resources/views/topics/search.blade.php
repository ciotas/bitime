@extends('layouts.app')

@section('title', isset($category) ?  $category->name : '搜索列表')

@section('content')

  <div class="row mb-5">
    <div class="col-lg-9 col-md-9 topic-list">
      @if (isset($category) && !empty($category->description))
        <div class="alert alert-info" role="alert">
          {{ $category->name }} ：{{ $category->description }}
        </div>
      @endif
      <div class="card ">
        <div class="card-header bg-transparent">
          <i class="fas fa-search"></i>
          为您找到 {{ $topics->count() }} 条关于
          <span class="badge badge-light">{{ $q }}</span>
           的内容
        </div>
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
