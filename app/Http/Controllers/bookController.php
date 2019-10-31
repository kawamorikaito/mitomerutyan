<?php

namespace App\Http\Controllers;

use App\Book;
use Illuminate\Http\Request;

class bookController extends Controller
{
    public function index () {
        $books = Book::all();
        $name = 'kaito';
        return view('books',[
            'books' => $books
            ]
        );
    }

    public function regist (Request $request){
        $validator = $request->validate([
            'name' => 'required|max:10',
        ],
        [
            'name.required' => '名前は必須だよ！',
            'name.max' => '10文字までだよ！',
        ]
        );

        $book = new Book;
        $book->title = $request->name;
        $book->save();
        return redirect('/');
    }

    public function delete (Book $book){
        $book->delete();
        return redirect('/');
    }
}
