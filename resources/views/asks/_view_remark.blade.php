<!-- Button trigger modal -->
<a href="#" class="btn btn-outline-secondary btn-sm" data-toggle="modal" data-target="#view_remark{{ $ask->id }}">
  查看
</a>

<!-- Modal -->
<div class="modal fade" id="view_remark{{ $ask->id }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">{{$ask->user->name}}关于{{ $ask->name }}的诊股备注</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        {{ $ask->remark }}
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-sm btn-secondary" data-dismiss="modal">关闭</button>
      </div>
    </div>
  </div>
</div>
