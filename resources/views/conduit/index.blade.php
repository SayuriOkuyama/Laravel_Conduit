<x-head />
<!-- 一覧ページ -->

<body>
  <x-header />
  <div class="home-page">
    <div class="banner">
      <div class="container">
        <h1 class="logo-font">conduit</h1>
        <p>A place to share your knowledge.</p>
      </div>
    </div>

    <div class="container page">
      <div class="row">
        <div class="col-md-9">
          <div class="feed-toggle">
            <ul class="nav nav-pills outline-active">
              @if (Request::routeIs('conduit.usersArticle'))
                <li class="nav-item">
                  <!-- 自分の記事一覧 -->
                  @auth
                    <a class="nav-link active" href="{{ route('conduit.usersArticle') }}">Your Feed</a>
                  @endauth
                </li>
                <li class="nav-item">
                  <!-- 全ユーザーの記事一覧 -->
                  <a class="nav-link" href="{{ route('conduit.index') }}">Global Feed</a>
                </li>
              @else
                <li class="nav-item">
                  <!-- 自分の記事一覧 -->
                  @auth
                    <a class="nav-link" href="{{ route('conduit.usersArticle') }}">Your Feed</a>
                  @endauth
                </li>
                <li class="nav-item">
                  <!-- 全ユーザーの記事一覧 -->
                  <a class="nav-link active" href="{{ route('conduit.index') }}">Global Feed</a>
                </li>
              @endif
            </ul>
          </div>

          @if (Request::routeIs('conduit.usersArticle'))
            {{-- 自分の記事一覧 --}}
            @foreach ($usersArticles as $usersArticle)
              <div class="article-preview">
                <div class="article-meta">
                  <a href=""><img src="http://i.imgur.com/Qr71crq.jpg" /></a>
                  <div class="info">
                    <a href="/profile/eric-simons" class="author">{{ $usersArticle->user->name }}</a>
                    <span class="date">January 20th</span>
                  </div>
                  <button class="btn btn-outline-primary btn-sm pull-xs-right">
                    <i class="ion-heart"></i> 29
                  </button>
                </div>
                <a href="{{ route('conduit.show', ['id' => $usersArticle->id]) }}" class="preview-link">
                  <h1>{{ $usersArticle->title }}</h1>
                  <p>{{ $usersArticle->about }}</p>
                  <span>Read more...</span>
                  <ul class="tag-list">
                    @if (count($usersArticle->tags))
                      @foreach ($usersArticle->tags as $tag)
                        <li class="tag-default tag-pill tag-outline">{{ $tag->name }}</li>
                      @endforeach
                      <li class="tag-default tag-pill tag-outline">implementations</li>
                    @endif
                  </ul>
                </a>
              </div>
            @endforeach
          @else
            {{-- 全ユーザーの記事一覧 --}}
            @foreach ($articles as $article)
              <div class="article-preview">
                <div class="article-meta">
                  <a href=""><img src="http://i.imgur.com/Qr71crq.jpg" /></a>
                  <div class="info">
                    <a href="/profile/eric-simons" class="author">{{ $article->user->name }}</a>
                    <span class="date">January 20th</span>
                  </div>
                  <button class="btn btn-outline-primary btn-sm pull-xs-right">
                    <i class="ion-heart"></i> 29
                  </button>
                </div>
                <a href="{{ route('conduit.show', ['id' => $article->id]) }}" class="preview-link">
                  <h1>{{ $article->title }}</h1>
                  <p>{{ $article->about }}</p>
                  <span>Read more...</span>
                  <ul class="tag-list">
                    @if (count($article->tags))
                      @foreach ($article->tags as $tag)
                        <li class="tag-default tag-pill tag-outline">{{ $tag->name }}</li>
                      @endforeach
                    @endif
                  </ul>
                </a>
              </div>
            @endforeach
          @endif

          {{-- ページネーション --}}
          @if (Request::routeIs('conduit.usersArticle'))
            {{ $usersArticles->links('pagination::bootstrap-5') }}
          @elseif(Request::routeIs('conduit.index'))
            {!! $articles->links('pagination::bootstrap-5') !!}
          @endif
        </div>

        <div class="col-md-3">
          <div class="sidebar">
            <p>Popular Tags</p>

            <div class="tag-list">
              <a href="" class="tag-pill tag-default">programming</a>
              <a href="" class="tag-pill tag-default">javascript</a>
              <a href="" class="tag-pill tag-default">emberjs</a>
              <a href="" class="tag-pill tag-default">angularjs</a>
              <a href="" class="tag-pill tag-default">react</a>
              <a href="" class="tag-pill tag-default">mean</a>
              <a href="" class="tag-pill tag-default">node</a>
              <a href="" class="tag-pill tag-default">rails</a>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <x-footer />
</body>

</html>
