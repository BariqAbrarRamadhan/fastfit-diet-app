<?php

namespace App\Http\Controllers;

use App\Models\Article;
use Illuminate\Http\Request;

class ArticleController extends Controller
{
  /**
   * Display a listing of published articles for users
   */
  public function index(Request $request)
  {
    $search = $request->get('search');
    $category = $request->get('category');

    $articles = Article::query()
      ->when($search, function ($query, $search) {
        return $query->where('title', 'like', "%{$search}%")
          ->orWhere('content', 'like', "%{$search}%")
          ->orWhere('excerpt', 'like', "%{$search}%");
      })
      ->when($category, function ($query, $category) {
        return $query->where('category', $category);
      })
      ->orderBy('created_at', 'desc')
      ->paginate(9);

    $categories = Article::select('category')
      ->whereNotNull('category')
      ->distinct()
      ->pluck('category');

    return view('user.articles.index', compact('articles', 'categories', 'search', 'category'));
  }

  /**
   * Display the specified article
   */
  public function show(Article $article)
  {
    // Increment views (you might want to add a views column to articles table later)
    // $article->increment('views');

    $relatedArticles = Article::where('category', $article->category)
      ->where('id', '!=', $article->id)
      ->limit(3)
      ->get();

    return view('user.articles.show', compact('article', 'relatedArticles'));
  }
}
