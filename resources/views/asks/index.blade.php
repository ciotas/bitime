@extends('layouts.app')

@section('title', '诊股记录')

@section('content')
  <div class="container-fluid col-lg-9 col-md-9">
    <div>
      <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="#">我的</a></li>
          <li class="breadcrumb-item active" aria-current="page">
            诊股记录
          </li>
        </ol>
      </nav>
    </div>
    <div class="card">
      <div class="card-body">
        <form action="" class="search-form">
          <div class="form-group col-md-4">
            <select class="form-control form-control-sm" name="status">
              <option value="0" disabled>状态</option>
              <option value="all">全部</option>
              <option value="todo">待处理</option>
              <option value="doing">分析中</option>
              <option value="done">已完成</option>
            </select>
          </div>
        </form>
        <table class="table table-striped">
          <thead>
          <tr>
            <th scope="col">#</th>
            <th scope="col">名称/代码</th>
            <th scope="col">总资金</th>
            <th scope="col">杠杆</th>
            <th scope="col">周期</th>
            <th scope="col">状态</th>
            <th scope="col">操作</th>
          </tr>
          </thead>
          <tbody>
          @foreach($asks as $key => $ask)
            <tr>
              <th scope="row">{{ ++$key }}</th>
              <td>{{ $ask->name }}/{{ $ask->symbol }}</td>
              <td>{{ $ask->total }}</td>
              <td>{{ $ask->lever }}x</td>
              <td>{{ $ask->period }}</td>
              <td>{!! $ask->statusName !!}</td>
              <td>
                @can('own', $ask)
                  @if($ask->status == 'todo')
                    <a class="btn btn-outline-secondary btn-sm" href="{{ route('asks.edit', ['ask'=>$ask->id]) }}" >编辑</a>
                    <form action="{{ route('asks.destroy', ['ask'=>$ask->id]) }}" method="POST"
                          onsubmit="return confirm('您确定要撤销吗？');">
                      {{ csrf_field() }}
                      {{ method_field('DELETE') }}
                      <button class="btn btn-outline-danger btn-sm" type="submit" name="button">撤销</button>
                    </form>
                  @elseif($ask->status == 'doing')
                    /
                  @elseif($ask->status == 'done')
                    <a href="{{ route('asks.show', ['ask'=>$ask->id]) }}"
                      class="btn btn-outline-success btn-sm" aria-label="Left Align">
                      查看
                    </a>
                  @endif
                @endcan
              </td>
            </tr>
          @endforeach
          </tbody>
        </table>
        <hr>
        <div class="mt-3">
          {!! $asks->appends(Request::except('page'))->render() !!}
        </div>
      </div>
    </div>
  </div>
@stop

@section('scripts')
  <script>
    var filters = {!! json_encode($filters) !!};
    $(document).ready(function () {
      $('.search-form select[name=status]').val(filters.status);
      $('.search-form select[name=status]').on('change', function() {
        $('.search-form').submit();
      });
    })
  </script>
@endsection
