
<table class="table table-striped">
  <thead>
  <tr>
    <th scope="col">#</th>
    <th scope="col">名称</th>
    <th scope="col">代卖</th>
    <th scope="col">操作</th>
  </tr>
  </thead>
  <tbody>
  @foreach($plans as $key => $plan)
  <tr>
    <th scope="row">{{ ++$key }}</th>
    <td>{{ $plan->name }}</td>
    <td>{{ $plan->symbol }}</td>
    <td>
      <form action="{{ route('users.subscribe.destroy') }}" method="POST"
            onsubmit="return confirm('您确定要取消订阅吗？');">
        {{ csrf_field() }}
        {{ method_field('DELETE') }}
        <input type="hidden" name="plan_id" value="{{ $plan->id }}">
        <button class="btn btn-danger btn-sm" type="submit" name="button">取消订阅</button>
      </form>
    </td>
  </tr>
  @endforeach
  </tbody>
</table>
