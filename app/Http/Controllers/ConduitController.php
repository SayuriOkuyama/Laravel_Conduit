<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Article;
use App\Models\User;
use App\Models\Tag;
use Illuminate\Mail\Markdown;
use App\Http\Requests\StoreArticleRequest;
use Illuminate\Support\Facades\Auth;

class ConduitController extends Controller
{
  /**
   * Display a listing of the resource.
   */
  public function index()
  {
    $articles = Article::orderBy('updated_at', 'desc')->paginate(20);

    $articles_info = [];
    foreach ($articles as $article) {
      $user = User::find($article->user_id);
      if (Tag::where('article_id', $article->id)->first()) {
        $tag = Tag::where('article_id', $article->id)->first();
      } else {
        $tag = "";
      }

      $articles_info[] = [
        "user" => $user,
        "article" => $article,
        "tag" => $tag
      ];
    }
    return view('conduit.index', compact('articles_info'));
  }

  public function usersArticle()
  {
    $userId = Auth::id();
    $usersArticles = Article::where('user_id', $userId)->paginate(20);

    $usersArticles_info = [];
    foreach ($usersArticles as $usersArticle) {
      if (Tag::where('article_id', $usersArticle->id)->first()) {
        $tag = Tag::where('article_id', $usersArticle->id)->first();
      } else {
        $tag = "";
      }

      $usersArticles_info[] = [
        "user" => Auth::user(),
        "article" => $usersArticle,
        "tag" => $tag
      ];
    }

    return view('conduit.index', compact('usersArticles_info'));
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
      'user_id' => 1
    ]);

    $article_id = $article->id;

    Tag::create([
      'article_id' => $article_id,
      'name' => $request->tag
    ]);

    return to_route('conduit.index');
  }

  /**
   * Display the specified resource.
   */
  public function show(string $id)
  {
    $article = Article::find($id);
    $user = User::find($article->user_id);
    $content = Markdown::parse(e($article->content));
    if (Tag::where('article_id', $article->id)->first() !== null) {
      $tag = Tag::where('article_id', $article->id)->first();
    } else {
      $tag = "";
    }

    $article_info = [
      "article" => $article,
      "user" => $user,
      "tag" => $tag,
      "content" => $content
    ];
    return view('conduit.article', compact('article_info', 'content'));
  }

  /**
   * Show the form for editing the specified resource.
   */
  public function edit(string $id)
  {
    $article = Article::find($id);
    $user = User::find($article->user_id);
    $tag = Tag::find($article->id);

    $article_info = [
      "article" => $article,
      "user" => $user,
      "tag" => $tag,
    ];

    return view('conduit.editor', compact('article_info'));
  }

  /**
   * Update the specified resource in storage.
   */
  public function update(Request $request, string $id)
  {
    $article = Article::find($id);
    $article->title = $request->title;
    $article->about = $request->about;
    $article->content = $request->content;
    $article->save();

    $tag = Tag::where('article_id', $article->id)->get();

    if (isset($tag->name)) {
      $tag->name = $request->tag;
      $tag->save();
    } else {
      Tag::create([
        'article_id' => $article->id,
        'name' => $request->tag
      ]);
    }

    return to_route('conduit.index');
  }

  /**
   * Remove the specified resource from storage.
   */
  public function destroy(string $id)
  {
    $article = Article::find($id);

    $tags = Tag::where('article_id', $article->id)->get();
    foreach ($tags as $tag) {
      $tag->delete();
    }

    $article->delete();

    return to_route('conduit.index');
  }
}
