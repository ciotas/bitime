
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
          <form action="{{ route('asks.destroy', ['ask'=>$ask->id]) }}" method="POST"
                onsubmit="return confirm('您确定要撤销吗？');">
            {{ csrf_field() }}
            {{ method_field('DELETE') }}
            <button class="btn btn-outline-danger btn-sm" type="submit" name="button">撤销</button>
          </form>
        @elseif($ask->status == 'doing')
          /
        @elseif($ask->status == 'done')
          <button
            data-toggle="modal" data-target="#ask_{{$ask->id}}"
            class="btn btn-outline-success btn-sm" aria-label="Left Align">
            查看
          </button>
        @endif
          @endcan
      </td>
    </tr>
  @endforeach
  </tbody>
</table>
