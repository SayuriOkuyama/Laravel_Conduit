<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Article;
use App\Models\User;
use App\Models\Tag;
use App\Http\Requests\StoreArticleRequest;
use App\Models\ArticleTag;
use Illuminate\Support\Facades\Auth;

class ConduitController extends Controller
{
  /**
   * Display a listing of the resource.
   */
  public function index()
  {
    $articles = Article::with('tags')->orderBy('updated_at', 'desc')->paginate(20);

    return view('conduit.index', compact('articles'));
  }

  public function usersArticle()
  {
    $usersArticles = Article::where('user_id', Auth::id())->paginate(20);

    return view('conduit.index', compact('usersArticles'));
  }

  /**
   * Show the form for creating a new resource.
   */
  public function create()
  {
    return view('conduit.editor');
  }

  /**
   * Store a newly created resource in storage.
   */
  public function store(StoreArticleRequest $request)
  {
    $article = Article::create([
      'title' => $request->title,
      'about' => $request->about,
      'content' => $request->content,
      'user_id' => Auth::id()
    ]);

    $tags = $request->tags;
    foreach ($tags as $tag) {
      if ($tag !== null) {
        // if (count($tags)) {
        $tag_data = Tag::firstOrCreate(['name' => $tag]);
        ArticleTag::create([
          'article_id' => $article->id,
          'tag_id' => $tag_data->id
        ]);
        // }
      }
    }

    return to_route('conduit.index');
  }

  /**
   * Display the specified resource.
   */
  public function show(string $id)
  {
    $article = Article::find($id);

    return view('conduit.article', compact('article'));
  }

  /**
   * Show the form for editing the specified resource.
   */
  public function edit(string $id)
  {
    $article = Article::find($id);

    return view('conduit.editor', compact('article'));
  }

  /**
   * Update the specified resource in storage.
   */
  public function update(StoreArticleRequest $request, string $id)
  {
    $article = Article::find($id);
    $article->title = $request->title;
    $article->about = $request->about;
    $article->content = $request->content;
    $article->save();

    $tags_data = ArticleTag::where(['article_id' => $id]);
    if ($tags_data !== null) {
      $tags_data->delete();
    }

    if ($request->tags !== null) {
      foreach ($request->tags as $tag) {
        if ($tag !== null) {
          $tag_data = Tag::firstOrCreate(['name' => $tag]);
          ArticleTag::firstOrCreate([
            'article_id' => $article->id,
            'tag_id' => $tag_data->id
          ]);
        }
      }
    }

    return to_route('conduit.index');
  }

  /**
   * Remove the specified resource from storage.
   */
  public function destroy(string $id)
  {
    $article = Article::find($id);

    $article_tags = ArticleTag::where(['article_id' => $id]);
    $article_tags_data = $article_tags->get();

    if ($article_tags_data !== null) {
      foreach ($article_tags_data as $article_tag_data) {
        $tag_id = $article_tag_data->tag_id;
        $existing_article_tags = ArticleTag::where(['tag_id' => $tag_id])->get();

        if (count($existing_article_tags) === 1) {
          Tag::where('id', $tag_id)->delete();
        }
      }
      $article_tags->delete();
    }

    $article->delete();

    return to_route('conduit.index');
  }
}
