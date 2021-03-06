<div class="card ">
  <div class="card-body">
    <a href="{{ route('topics.create') }}" class="btn btn-success btn-sm btn-block" aria-label="Left Align">
      <i class="fas fa-pencil-alt mr-2"></i>
      @if(isset($category->id) && $category->id == 4)
        写交易笔记
        @else
        新建文章
        @endif
    </a>
  </div>
</div>

@if (count($tags))
  <div class="card mt-4">
    <div class="card-body active-users pt-2">
      <div class="text-center mt-1 mb-0 text-muted">标签</div>
      <hr class="mt-2">
      @foreach ($tags as $value)
        @if($value->topics_count > 0)
        <a class="media mt-2" href="{{ route('tags.show', $value->id) }}">
          <div class="media-body">
            <small class="media-heading {{ isset($tag) && $tag->id == $value->id ?: 'text-secondary' }}">{{ $value->name }}</small>
          </div>
          <span class="badge badge-light badge-pill">{{ $value->topics_count }}</span>
        </a>
        @endif
      @endforeach
    </div>
  </div>
@endif

{{--@if (count($active_users))--}}
{{--  <div class="card mt-4">--}}
{{--    <div class="card-body active-users pt-2">--}}
{{--      <div class="text-center mt-1 mb-0 text-muted">活跃用户</div>--}}
{{--      <hr class="mt-2">--}}
{{--      @foreach ($active_users as $active_user)--}}
{{--        <a class="media mt-2" href="{{ route('users.show', $active_user->id) }}">--}}
{{--          <div class="media-left media-middle mr-2 ml-1">--}}
{{--            <img src="{{ $active_user->avatar }}" width="24px" height="24px" class="media-object">--}}
{{--          </div>--}}
{{--          <div class="media-body">--}}
{{--            <small class="media-heading text-secondary">{{ $active_user->name }}</small>--}}
{{--          </div>--}}
{{--        </a>--}}
{{--      @endforeach--}}
{{--    </div>--}}
{{--  </div>--}}
{{--@endif--}}

@if (count($links))
  <div class="card mt-4">
    <div class="card-body pt-2">
      <div class="text-center mt-1 mb-0 text-muted">资源推荐</div>
      <hr class="mt-2 mb-3">
      @foreach ($links as $link)
        <a class="media mt-1" href="{{ $link->link }}">
          <div class="media-body">
            <span class="media-heading text-muted">{{ $link->title }}</span>
          </div>
        </a>
      @endforeach
    </div>
  </div>
@endif
