<nav class="navbar navbar-expand-lg navbar-dark bg-dark navbar-static-top">
  <div class="container">
    <!-- Branding Image -->
    <a class="navbar-brand " href="{{ url('/') }}">
      {{ env('APP_NAME') }}
    </a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <!-- Left Side Of Navbar -->
      <ul class="navbar-nav mr-auto">
        <li class="nav-item {{ active_class(if_route('topics.index')) }}"><a class="nav-link" href="{{ route('topics.index') }}">首页</a></li>
        <li class="nav-item {{ category_nav_active(1) }}"><a class="nav-link" href="{{ route('categories.show', 1) }}">技术</a></li>
        <li class="nav-item {{ category_nav_active(2) }}"><a class="nav-link" href="{{ route('categories.show', 2) }}">随笔</a></li>
        <li class="nav-item {{ category_nav_active(3) }}"><a class="nav-link" href="{{ route('categories.show', 3) }}">人生</a></li>
        <li class="nav-item dropdown {{ active_class(category_nav_active(4) || if_route('plans.index') || if_route('plans.create')) }}">
          <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            市场
          </a>
          <div class="dropdown-menu" aria-labelledby="navbarDropdown">
            <a class="dropdown-item" href="{{ route('categories.show', 4) }}">交易笔记</a>
            <div class="dropdown-divider"></div>
            @foreach(config('classification.markets') as $market => $name)
              <a class="dropdown-item" href="{{ route('plans.index', ['market' => $market]) }}">{{ $name }}</a>
            @endforeach
          </div>
        </li>
        @can('manage_trades')
          <li class="nav-item dropdown {{ active_class(if_route('asks.create') || if_route('asks.index')) }}">
            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
              工作台
            </a>
            <div class="dropdown-menu" aria-labelledby="navbarDropdown">
              <a class="dropdown-item" href="{{ route('asks.sorts.lists', ['tab'=>'todo']) }}">待处理</a>
              <a class="dropdown-item" href="{{ route('asks.sorts.lists', ['tab'=>'doing']) }}">分析中</a>
              <a class="dropdown-item" href="{{ route('asks.sorts.lists', ['tab'=>'done']) }}">已完成</a>
              <div class="dropdown-divider"></div>
              <a class="dropdown-item" href="{{ route('plans.create') }}">发布计划</a>
            </div>
          </li>
        @else
        <li class="nav-item dropdown {{ active_class(if_route('asks.create') || if_route('asks.index')||if_route('asks.replies')||if_route('asks.show') ) }}">
          <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            诊股
          </a>
          <div class="dropdown-menu" aria-labelledby="navbarDropdown">
            <a class="dropdown-item" href="{{ route('asks.create') }}">我要诊股</a>
            <div class="dropdown-divider"></div>
            <a class="dropdown-item" href="{{ route('asks.index') }}">诊股记录</a>
            <a class="dropdown-item" href="{{ route('asks.replies') }}">分析报告</a>
{{--            <a class="dropdown-item" href="{{ route('users.income.analysis') }}">我的收益</a>--}}
          </div>
        </li>
        @endcan
      </ul>
      @if(route_class() !== 'plans-index' && route_class() !== 'plans-search')
      <form class="form-inline my-2 my-lg-0" method="get" action="{{ route('topics.search') }}" accept-charset="UTF-8">
        <div class="input-group">
          <input class="form-control form-control-sm border-right-0" type="search" name="q" value="{{ request('q') }}" placeholder="搜索文章" aria-label="Search">
          <span class="input-group-append bg-white border-left-0">
            <span class="input-group-text bg-transparent">
              <i class="fas fa-search"></i>
            </span>
        </span>
        </div>
      </form>
      @else
        <form class="form-inline my-2 my-lg-0" method="get" action="{{ route('plans.search') }}" accept-charset="UTF-8">
          <div class="input-group">
            <input class="form-control form-control-sm border-right-0" type="search" name="q" value="{{ request('q') }}" placeholder="搜索symbol" aria-label="Search">
            <span class="input-group-append bg-white border-left-0">
            <span class="input-group-text bg-transparent">
              <i class="fas fa-search"></i>
            </span>
        </span>
          </div>
        </form>
      @endif
      &nbsp;&nbsp;&nbsp;&nbsp;
      <ul class="navbar-nav navbar-right">
        @guest
          <li class="nav-item"><a class="nav-link" href="{{ route('login') }}">登录</a></li>
          <li class="nav-item"><a class="nav-link" href="{{ route('register') }}">注册</a></li>
        @else
          <li class="nav-item notification-badge">
            <a class="nav-link mr-3 badge badge-pill badge-{{ Auth::user()->notification_count > 0 ? 'hint' : 'secondary' }} text-white" href="{{ route('notifications.index') }}">
              {{ Auth::user()->notification_count }}
            </a>
          </li>
          <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
              <img src="{{ Auth::user()->avatar }}" class="img-responsive img-circle" width="20px" height="20px">
              {{ Auth::user()->name }}
            </a>

            <div class="dropdown-menu" aria-labelledby="navbarDropdown">
              @can('manage_contents')
                <a class="dropdown-item" href="{{ url(config('administrator.uri')) }}">
                  <i class="fas fa-tachometer-alt mr-2"></i>
                  管理后台
                </a>
                <div class="dropdown-divider"></div>
              @endcan
                <a class="dropdown-item" href="{{ route('users.show', Auth::id()) }}"><i class="far fa-user mr-2"></i>个人中心</a>
              <a class="dropdown-item" href="{{ route('users.edit', Auth::id()) }}"><i class="far fa-edit mr-2"></i>编辑资料</a>
              <div class="dropdown-divider"></div>
              <a class="dropdown-item" id="logout" href="#">
                <form action="{{ route('logout') }}" method="POST">
                  {{ csrf_field() }}
                  <button class="btn btn-block btn-danger btn-sm" type="submit" name="button">退出</button>
                </form>
              </a>
            </div>
          </li>
        @endguest
      </ul>
    </div>
  </div>
</nav>
