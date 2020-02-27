@if (count($topics))
  <ul class="list-unstyled">
    @foreach ($topics as $topic)
      <li class="media">

        <div class="media-body">

          <div class="media-heading mt-0 mb-1">
            @if($topic->top)
              <span class="badge badge-primary">顶置</span>
            @endif
            @if($topic->forme)
              <span class="badge badge-primary">私有</span>
            @endif
            <a href="{{ $topic->link() }}" title="{{ $topic->title }}">
              {{ $topic->title }}
            </a>
{{--            <a class="float-right" href="{{ $topic->link() }}">--}}
{{--              <span class="badge badge-secondary badge-pill"> {{ $topic->reply_count }} </span>--}}
{{--            </a>--}}
          </div>

          <small class="media-body meta text-secondary">

            <a class="text-secondary" href="{{ route('categories.show', $topic->category_id) }}" title="{{ $topic->category->name }}">
              <i class="far fa-folder"></i>
              {{ $topic->category->name }}
            </a>
            @foreach($topic->tags as $key => $tag)
              <span>
              @if ($key > 0) / @else • @endif
                </span>
               <a class="text-secondary" href="{{ route('tags.show', $tag->id) }}"> {{ $tag->name }}</a>
            @endforeach
            <span> • </span>
            <a class="text-secondary" href="{{ route('users.show', [$topic->user_id]) }}" title="{{ $topic->user->name }}">
              <i class="far fa-user"></i>
              {{ $topic->user->name }}
            </a>
            <span> • </span>
            <i class="far fa-clock"></i>
            <span title="最后活跃于：{{ $topic->updated_at }}">{{ $topic->updated_at->diffForHumans() }}</span>
          </small>

        </div>
      </li>

      @if ( ! $loop->last)
        <hr>
      @endif

    @endforeach
  </ul>

@else
  暂无数据
@endif
