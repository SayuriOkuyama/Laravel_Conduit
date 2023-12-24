<x-head />
<!-- 記事投稿・編集ページ -->

<body>
  <x-header />
  <div class="editor-page">
    <div class="container page">
      <div class="row">
        <div class="col-md-10 offset-md-1 col-xs-12">
          <ul class="error-messages">
            <li>That title is required</li>
          </ul>

          @if (Request::routeIs('conduit.create'))
            <form method="POST" action="{{ route('conduit.store') }}">
            @else
              <form method="POST" action="{{ route('conduit.update', ['id' => $article_info['article']->id]) }}">
          @endif
          @csrf
          <fieldset>
            <fieldset class="form-group">
              @if (Request::routeIs('conduit.create'))
                <input name="title" type="text" class="form-control form-control-lg" placeholder="Article Title" />
              @else
                <input name="title" type="text" class="form-control form-control-lg" placeholder="Article Title"
                  value="{{ $article_info['article']->title }}" />
              @endif
            </fieldset>

            <fieldset class="form-group">
              @if (Request::routeIs('conduit.create'))
                <input name="about" type="text" class="form-control" placeholder="What's this article about?" />
              @else
                <input name="about" type="text" class="form-control" placeholder="What's this article about?"
                  value="{{ $article_info['article']->about }}" />
              @endif
            </fieldset>

            <fieldset class="form-group">
              @if (Request::routeIs('conduit.create'))
                <textarea name="content" class="form-control" rows="8" placeholder="Write your article (in markdown)"></textarea>
              @else
                <textarea name="content" class="form-control" rows="8" placeholder="Write your article (in markdown)">{{ $article_info['article']->content }}</textarea>
              @endif
            </fieldset>

            <fieldset class="form-group">
              @if (Request::routeIs('conduit.create'))
                <input id="tag-input" name="tag" type="text" class="form-control" placeholder="Enter tags" />
              @else
                <input id="tag-input" name="tag" type="text" class="form-control" placeholder="Enter tags"
                  value="{{ $article_info['tag']->name }}" />
              @endif
              <div class="tag-list">
                <span class="tag-default tag-pill"> <i class="ion-close-round"></i> tag </span>
              </div>
            </fieldset>

            <button class="btn btn-lg pull-xs-right btn-primary" type="button" onClick="submit();">
              Publish Article
            </button>
          </fieldset>
          </form>
        </div>
      </div>
    </div>
  </div>
  <x-footer />
  <script src="{{ asset('/js/main.js') }}"></script>
</body>

</html>
