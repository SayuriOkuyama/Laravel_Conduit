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
              <li class="nav-item">
                <!-- 自分の一覧 -->
                @auth
                  <a class="nav-link" href="{{ route('conduit.usersArticle') }}">Your Feed</a>
                @endauth
                @guest
                  <a class="nav-link" href="{{ route('conduit.index') }}">Your Feed</a>
                @endguest
              </li>
              <li class="nav-item">
                <!-- すべてのユーザーの一覧 -->
                <a class="nav-link active" href="{{ route('conduit.index') }}">Global Feed</a>
              </li>
            </ul>
          </div>

          @if (Request::routeIs('conduit.usersArticle'))
            @foreach ($usersArticles_info as $usersArticle_info)
              <div class="article-preview">
                <div class="article-meta">
                  <a href=""><img src="http://i.imgur.com/Qr71crq.jpg" /></a>
                  <div class="info">
                    <a href="/profile/eric-simons" class="author">{{ $usersArticle_info['user']->name }}</a>
                    <span class="date">January 20th</span>
                  </div>
                  <button class="btn btn-outline-primary btn-sm pull-xs-right">
                    <i class="ion-heart"></i> 29
                  </button>
                </div>
                <a href="{{ route('conduit.show', ['id' => $usersArticle_info['article']->id]) }}" class="preview-link">
                  <h1>{{ $usersArticle_info['article']->title }}</h1>
                  <p>{{ $usersArticle_info['article']->about }}</p>
                  <span>Read more...</span>
                  <ul class="tag-list">
                    @if (isset($usersArticle_info['tag']->name))
                      <li class="tag-default tag-pill tag-outline">{{ $usersArticle_info['tag']->name }}</li>
                      <li class="tag-default tag-pill tag-outline">implementations</li>
                    @endif
                  </ul>
                </a>
              </div>
            @endforeach
          @else
            @foreach ($articles_info as $article_info)
              <div class="article-preview">
                <div class="article-meta">
                  <a href=""><img src="http://i.imgur.com/Qr71crq.jpg" /></a>
                  <div class="info">
                    <a href="/profile/eric-simons" class="author">{{ $article_info['user']->name }}</a>
                    <span class="date">January 20th</span>
                  </div>
                  <button class="btn btn-outline-primary btn-sm pull-xs-right">
                    <i class="ion-heart"></i> 29
                  </button>
                </div>
                <a href="{{ route('conduit.show', ['id' => $article_info['article']->id]) }}" class="preview-link">
                  <h1>{{ $article_info['article']->title }}</h1>
                  <p>{{ $article_info['article']->about }}</p>
                  <span>Read more...</span>
                  <ul class="tag-list">
                    @if (isset($article_info['tag']->name))
                      <li class="tag-default tag-pill tag-outline">{{ $article_info['tag']->name }}</li>
                      <li class="tag-default tag-pill tag-outline">implementations</li>
                    @endif
                  </ul>
                </a>
              </div>
            @endforeach
          @endif

          {{-- <div class="article-preview">
            <div class="article-meta">
              <a href=""><img src="http://i.imgur.com/Qr71crq.jpg" /></a>
              <div class="info">
                <a href="/profile/eric-simons" class="author">Eric Simons</a>
                <span class="date">January 20th</span>
              </div>
              <button class="btn btn-outline-primary btn-sm pull-xs-right">
                <i class="ion-heart"></i> 29
              </button>
            </div>
            <a href="" class="preview-link">
              <h1>How to build webapps that scale</h1>
              <p>This is the description for the post.</p>
              <span>Read more...</span>
              <ul class="tag-list">
                <li class="tag-default tag-pill tag-outline">realworld</li>
                <li class="tag-default tag-pill tag-outline">implementations</li>
              </ul>
            </a>
          </div>

          <div class="article-preview">
            <div class="article-meta">
              <a href="/profile/albert-pai"><img src="http://i.imgur.com/N4VcUeJ.jpg" /></a>
              <div class="info">
                <a href="/profile/albert-pai" class="author">Albert Pai</a>
                <span class="date">January 20th</span>
              </div>
              <button class="btn btn-outline-primary btn-sm pull-xs-right">
                <i class="ion-heart"></i> 32
              </button>
            </div>
            <a href="/article/the-song-you" class="preview-link">
              <h1>The song you won't ever stop singing. No matter how hard you try.</h1>
              <p>This is the description for the post.</p>
              <span>Read more...</span>
              <ul class="tag-list">
                <li class="tag-default tag-pill tag-outline">realworld</li>
                <li class="tag-default tag-pill tag-outline">implementations</li>
              </ul>
            </a>
          </div> --}}

          {{-- <ul class="pagination">
            <li class="page-item active">
              <a class="page-link" href="">1</a>
            </li>
            <li class="page-item">
              <a class="page-link" href="">2</a>
            </li>
          </ul> --}}
          {{-- @if (Request::routeIs('conduit.usersArticle'))
            {{ $usersArticles_info->links() }} --}}
          {{-- @elseif(Request::routeIs('conduit.index'))
            {{ $articles_info->links() }}
          @endif --}}
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
