<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Article;
use Illuminate\Http\Request;

class ArticleController extends Controller
{
  public function index()
  {
    $articles = Article::latest()->paginate(10);
    return view('admin.articles.index', compact('articles'));
  }

  public function show(Article $article)
  {
    return view('admin.articles.show', compact('article'));
  }

  public function create()
  {
    return view('admin.articles.create');
  }

  public function store(Request $request)
  {
    $validated = $request->validate([
      'title' => 'required|string|max:255',
      'excerpt' => 'nullable|string|max:255',
      'content' => 'required|string',
      'image' => 'nullable|image|mimes:jpg,jpeg,png,gif|max:5120',
      'category' => 'nullable|string|max:100',
      'read_time' => 'nullable|string|max:20',
    ]);

    if ($request->hasFile('image')) {
      $path = $request->file('image')->store('articles', 'public');
      $validated['image'] = '/storage/' . $path;
    }

    Article::create($validated);
    return redirect()->route('admin.articles.index')->with('success', 'Artikel berhasil ditambahkan!');
  }

  public function edit(Article $article)
  {
    return view('admin.articles.edit', compact('article'));
  }

  public function update(Request $request, Article $article)
  {
    $validated = $request->validate([
      'title' => 'required|string|max:255',
      'excerpt' => 'nullable|string|max:255',
      'content' => 'required|string',
      'image' => 'nullable|image|mimes:jpg,jpeg,png,gif|max:5120',
      'category' => 'nullable|string|max:100',
      'read_time' => 'nullable|string|max:20',
    ]);

    if ($request->hasFile('image')) {
      $path = $request->file('image')->store('articles', 'public');
      $validated['image'] = '/storage/' . $path;
    }

    $article->update($validated);
    return redirect()->route('admin.articles.index')->with('success', 'Artikel berhasil diperbarui!');
  }

  public function destroy(Article $article)
  {
    $article->delete();
    return redirect()->route('admin.articles.index')->with('success', 'Artikel berhasil dihapus!');
  }
}
