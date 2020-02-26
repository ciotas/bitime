@extends('layouts.app')

@section('content')

  <div class="container">
    <div class="col-md-10 offset-md-1">
      <div class="card ">

        <div class="card-body">
          <h2 class="">
            <i class="far fa-edit"></i>
            @if($topic->id)
              编辑文章
            @else
              新建文章
            @endif
          </h2>
          <hr>
          <!-- Material checked -->
          @if($topic->id)
            <form action="{{ route('topics.update', $topic->id) }}" method="POST" accept-charset="UTF-8">
              <input type="hidden" name="_method" value="PUT">
              @else
                <form action="{{ route('topics.store') }}" method="POST" accept-charset="UTF-8">
                  @endif

                  <input type="hidden" name="_token" value="{{ csrf_token() }}">

                  @include('shared._error')

                  <div class="form-group">
                    <input class="form-control" type="text" name="title" value="{{ old('title', $topic->title ) }}" placeholder="请填写标题" required />
                  </div>

                  <div class="form-group">
                    <select class="form-control" name="category_id" required>
                      <option value="" disabled {{ $topic->id ? '' : 'selected' }}>请选择分类</option>
                      @foreach ($categories as $value)
                        <option value="{{ $value->id }}" {{ $topic->category_id == $value->id ? 'selected' : '' }}>{{ $value->name }}</option>
                      @endforeach
                    </select>
                  </div>

                  <div class="form-group">
                    <select id="select2" class="form-control" name="tags[]" multiple>
                      <option value="" disabled>请选择标签</option>
                      @foreach ($tags as $value)
                          <option value="{{ $value->id }}" {{ in_array($value->id, $choose_tags)? 'selected' : '' }}>{{ $value->name }}</option>
                      @endforeach
                    </select>
                  </div>
                  <div class="form-group">
                    @can('manage_contents')
                    <div class="form-check form-check-inline custom-switch">
                      <input type="checkbox" name="top" {{ isset($topic->top) ? ($topic->top?'checked':'') : '' }} class="custom-control-input" id="topset">
                      <label class="custom-control-label" for="topset">顶置</label>
                    </div>
                    @endcan
                    <div class="form-check form-check-inline custom-switch">
                      <input type="checkbox" name="forme" {{ isset($topic->forme) ? ($topic->forme?'checked':'') : '' }} class="custom-control-input" id="forme">
                      <label class="custom-control-label" for="forme">仅对自己可见</label>
                    </div>
                  </div>
{{--                  <div class="form-group ">--}}
{{--                    <select class="form-control" name="top" required>--}}
{{--                      <option value="" disabled>顶置</option>--}}
{{--                        <option value="1" {{ $topic->top == 1 ? 'selected' : '' }}>是</option>--}}
{{--                        <option value="0" {{ $topic->top == 0 ? 'selected' : '' }}>否</option>--}}
{{--                    </select>--}}
{{--                  </div>--}}

                  <div class="form-group">
                    <div id="div1" class="wangeditor-body">
                      {!! old('body', $topic->body) !!}
                    </div>
                    <textarea name="body" id="editor" style="width:100%; height:200px; display: none">
                    </textarea>
                  </div>

                  <div class="well well-sm">
                    @if($topic->id)
                      <a  href="{{ route('topics.show', ['topic'=>$topic->id]) }}" class="btn btn-sm btn-outline-secondary">
                        <i class="fas fa-chevron-left"></i> 返回</a>
                    @else
                      <a href="{{ route('topics.index') }}" class="btn btn-sm btn-outline-secondary">
                        <i class="fas fa-chevron-left"></i> 返回</a>
                    @endif
                    <button type="submit" class="btn btn-sm btn-outline-success"><i class="far fa-save mr-2" aria-hidden="true"></i> 保存</button>
                  </div>
                </form>
        </div>
      </div>
    </div>
  </div>

@endsection

@section('styles')
  <link href="https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/css/select2.min.css" rel="stylesheet" />
@stop

@section('scripts')
  <script src="https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/js/select2.min.js"></script>
  <script>
    var editor = new E('#div1')
    var $text1 = $('#editor')
    editor.customConfig.onchange = function (html) {
      // 代码块
      var doc_pre = $("#div1 pre");
      doc_pre.each(function(){
        var lan_class = 'language-markup';
        if (! $(this).hasClass(lan_class))
        {
          $(this).attr("class",lan_class);
        }
      });

      // 个性化table
      var doc_table = $("#div1 table");
      doc_table.each(function () {
        var table_class = 'table table-bordered'
        if (! $(this).hasClass(table_class))
        {
          $(this).attr("class",table_class);
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

    $(document).ready(function() {
      $('#select2').select2();
    });
  </script>
@stop
