<?php


namespace App\Http\Controllers;


use App\Models\News;

class NewsController extends Controller
{
    public function list()
    {
        return view('news_list', [
            'news' => News::all()
        ]);
    }

    public function item(int $id)
    {
        return view('news_item', [
            'newsItem' => News::findOrFail($id)
        ]);
    }
}
