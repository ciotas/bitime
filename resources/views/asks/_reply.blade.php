<!-- Button trigger modal -->
<a href="#" class="btn btn-outline-primary btn-sm" onclick="resetParam({{$ask->id}})" data-toggle="modal" data-target="#ask_reply{{ $ask->id }}">
  行情分析
</a>

<!-- Modal -->
<div class="modal fade" id="ask_reply{{ $ask->id }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title"><span class="text-muted">分析</span>{{ $ask->name }}/{{ $ask->symbol }}
          ({{ config('classification.markets')[$ask->market] }})<span class="text-muted">在</span>{{ $ask->period }}<span class="text-muted">的行情</span></h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        @if($ask->analyzer && $ask->analyzer->id)
        <form action="{{ route('analyzers.update', $ask->analyzer->id) }}" method="POST" accept-charset="UTF-8">
          <input type="hidden" name="_method" value="PUT">
          <input type="hidden" name="plan_id" value="{{ isset($ask->analyzer->plan)?$ask->analyzer->plan->id:0 }}">
          @else
            <form action="{{ route('analyzers.store') }}" method="POST" accept-charset="UTF-8">
              @endif
              <input type="hidden" name="_token" value="{{ csrf_token() }}">
              <input type="hidden" name="ask_id" value="{{ $ask->id }}">
              @include('shared._error')

              <div class="form-group">
                <div id="div{{$ask->id}}" class="wangeditor-body">
                  {!! old('body', $ask->analyzer ? $ask->analyzer->body : '') !!}
                </div>
                <textarea name="body" id="editor{{$ask->id}}" style="width:100%; height:200px; display: none">
                        </textarea>
              </div>

            <div class="form-group">
              <div class="form-check form-check-inline custom-switch">
                <input type="checkbox" name="use_plan" {{ $ask->analyzer ? ($ask->analyzer->use_plan ?'checked':'') : '' }} class="custom-control-input" id="use_plan{{$ask->id}}">
                <label class="custom-control-label" for="use_plan{{$ask->id}}">设置计划</label>
              </div>
            </div>
              <div id="showPlan{{$ask->id}}">
              @include('plans._plan_form', ['plan'=>$ask->analyzer->plan??$ask])
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-sm btn-secondary" data-dismiss="modal">关闭</button>
                @if ($ask->status == 'doing')
                <a href="{{ route('asks.over', ['ask'=>$ask->id]) }}" class="btn btn-sm btn-outline-primary">完成</a>
                @endif
                  <button type="submit" class="btn btn-sm btn-outline-success">提交</button>
              </div>
          </form>
      </div>

    </div>
  </div>
</div>
@section('scripts')
<script>
  var askIds=[]
  function resetParam (askId) {
    if ($("#use_plan"+askId).is(":checked"))
    {
      $('#showPlan'+askId).show()
    } else {
      $('#showPlan'+askId).hide()
    }
    if (askIds.indexOf(askId) === -1)
    {
      askIds.push(askId)
    } else {
      return
    }

    var editor = new E('#div'+askId)
    var $text1 = $('#editor'+askId)
    editor.customConfig.onchange = function (html) {
      // 代码块
      var doc_pre = $("#div"+askId+" pre")
      doc_pre.each(function(){
        var lan_class = 'language-markup'
        if (! $(this).hasClass(lan_class))
        {
          $(this).attr("class",lan_class)
        }
      });

      // 个性化table
      var doc_table = $("#div"+askId+" table")
      doc_table.each(function () {
        var table_class = 'table table-bordered'
        if (! $(this).hasClass(table_class))
        {
          $(this).attr("class",table_class)
        }
      });

      // 监控变化，同步更新到 textarea
      var html = editor.txt.html()
      $text1.val(html)
    }
    editor.customConfig.zIndex = 1
    editor.customConfig.uploadImgServer = '{{ route('topics.upload_image') }}'
    // 默认限制图片大小是 5M
    editor.customConfig.uploadImgMaxSize = 5 * 1024 * 1024
    // 默认为 10000 张（即不限制），需要限制可自己配置
    editor.customConfig.uploadImgMaxLength = 1
    editor.customConfig.uploadFileName = 'upload_file'
    editor.customConfig.uploadImgParams = {
      _token: '{{ csrf_token() }}'
    }

    editor.customConfig.menus = [
      'head',  // 标题
      'bold',  // 粗体
      'fontSize',  // 字号
      'fontName',  // 字体
      // 'italic',  // 斜体
      // 'underline',  // 下划线
      // 'strikeThrough',  // 删除线
      'foreColor',  // 文字颜色
      // 'backColor',  // 背景颜色
      'link',  // 插入链接
      'list',  // 列表
      'justify',  // 对齐方式
      'quote',  // 引用
      'code',  // 插入代码
      'emoticon',  // 表情
      'image',  // 插入图片
      'table',  // 表格
      // 'video',  // 插入视频
      // 'undo',  // 撤销
      // 'redo'  // 重复
    ]

    editor.create()
    // 初始化 textarea 的值
    $text1.val(editor.txt.html())

    $("#use_plan"+askId).click(function () {
      if($("input:checkbox:checked").val() === 'on')
      {
        $('#showPlan'+askId).show()
      } else {
        $('#showPlan'+askId).hide()
      }
    })
  }

</script>
@endsection
