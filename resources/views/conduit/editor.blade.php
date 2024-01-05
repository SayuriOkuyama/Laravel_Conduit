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
          @if ($errors->any())
            <div>
              <ul>
                @foreach ($errors->all() as $error)
                  <li>{{ $error }}</li>
                @endforeach
              </ul>
            </div>
          @endif
          @if (Request::routeIs('conduit.create'))
            <form method="POST" action="{{ route('conduit.store') }}">
            @else
              <form method="POST" action="{{ route('conduit.update', ['id' => $article->id]) }}">
          @endif
          @csrf
          <fieldset>
            <fieldset class="form-group">
              @if (Request::routeIs('conduit.create'))
                <input name="title" type="text" class="form-control form-control-lg" placeholder="Article Title" />
              @else
                <input name="title" type="text" class="form-control form-control-lg" placeholder="Article Title"
                  value="{{ old('title', $article->title) }}" />
              @endif
            </fieldset>

            <fieldset class="form-group">
              @if (Request::routeIs('conduit.create'))
                <input name="about" type="text" class="form-control" placeholder="What's this article about?" />
              @else
                <input name="about" type="text" class="form-control" placeholder="What's this article about?"
                  value="{{ old('about', $article->about) }}" />
              @endif
            </fieldset>

            <fieldset class="form-group">
              @if (Request::routeIs('conduit.create'))
                <textarea name="content" class="form-control" rows="8" placeholder="Write your article (in markdown)"></textarea>
              @else
                <textarea name="content" class="form-control" rows="8" placeholder="Write your article (in markdown)">{{ old('content', $article->content) }}</textarea>
              @endif
            </fieldset>

            <fieldset class="form-group">
              <input id="tag-input" name="tags[]" type="text" class="form-control" placeholder="Enter tags" />
              <div class="tag-list">
                @if (Request::routeIs('conduit.edit'))
                  @if (count($article->tags))
                    @foreach ($article->tags as $key => $tag)
                      <label class="tag-label" for="input_{{ $key }}}">
                        <span class="tag-default tag-pill">
                          <i class="ion-close-round"></i>
                          {{ $tag->name }}
                        </span>
                      </label>
                      <input id="input_{{ $key }}}" name="tags[]" type="text" hidden
                        value="{{ $tag->name }}">
                    @endforeach
                  @endif
                @endif
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
  <script src="{{ asset('/js/editor.js') }}"></script>
</body>

</html>
