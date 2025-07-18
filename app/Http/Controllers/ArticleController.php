<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Article;

class ArticleController extends Controller
{
    public function showList() {
        $model = new Article();
        $articles = $model->getList();
        return view('list', ['articles' => $articles]);
    }
}