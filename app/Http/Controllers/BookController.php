<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Config;
use Log;
use App;
use \Debugbar;
use IanLChapman\PigLatinTranslator\Parser;

class BookController extends Controller
{
    public function index() {
        return view('books.index');
    }

    public function show($title) {
        return view('books.show')->with(['title' => $title]);
    }
    /** 
     * GET /books/search
     * @Todo: Refactor to use db instead of books.json
     * @Todo: Outsource logic to a class
     */
    public function search(Request $request) {
        $searchResults = [];
        $searchTerm = $request->input('searchTerm', null);
        if ($searchTerm) {
            $booksRawData = file_get_contents(database_path('/books.json'));
            $books = json_decode($booksRawData, true);
            foreach($books as $title => $book) {
                if ($request->has('caseSensitive')) {
                    $match = $title == $searchTerm;
                } else {
                    $match = strtolower($title) == strtolower($searchTerm);
                }
                if ($match) {
                    $searchResults[$title] = $book;
                }
            }
        }
        return view('books.search')->with([
            'searchTerm'    => $searchTerm,
            'caseSensitive' => $request->has('caseSensitive'),
            'searchResults' => $searchResults
        ]);
    }
    /**
     * GET /books/create
     * 
     */
    public function create() {
        return view('books.create');
    }

    /**
     * POST /books
     */
    public function store(Request $request) {
        // dump($request->all());
        Log::info('add the book ' . $request->input('title'));
        return redirect('/books');
    }

    public function test($title = null) {
        dump($title);
        return view('books.show');
    }
}
