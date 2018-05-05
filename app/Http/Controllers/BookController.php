<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Config;
use Log;
use App;
use App\Book;
use App\Author;
use \Debugbar;
use IanLChapman\PigLatinTranslator\Parser;

class BookController extends Controller
{
    public function index() {
        $books = Book::orderBy('title')->get();
        $newBooks = $books->sortByDesc('created_at')->take(3);

        return view('books.index')->with([
            'books' => $books,
            'newBooks' => $newBooks
        ]);
    }

    public function show($id) {
        $book = Book::find($id);
        if (!$book) {
            return redirect('/books')->with(['alert' => 'Book ' . $id . ' not found.']);
        }   
        return view('books.show')->with(['book' => $book]);
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
        return view('books.create')
            ->with([
                'book' => new Book(),
                'authorsForDropdown' => Author::getAuthorsForDropdown()
            ]);
    }

    /**
     * POST /books
     */
    public function store(Request $request) {
        $this->validate($request, [
            'title' => 'required',
            'author_id' => 'required',
            'published_year' => 'required|digits:4|numeric',
            'cover_url' => 'required|url',
            'purchase_url' => 'required|url'
        ]);

        $title = $request->input('title');

        $book = new Book();
        $book->title = $title;
        $book->author_id = $request->author_id;
        $book->published_year = $request->published_year;
        $book->cover_url = $request->cover_url;
        $book->purchase_url = $request->purchase_url;
        $book->save();
        
        Log::info('add the book ' . $request->input('title'));
        return redirect('/books/create')
            ->with(['alert' => 'Your book ' . $title . ' was added.']);
    }

    public function edit($id) {
        $book = Book::find($id);
        if (!$book) {
            return redirect('/books')->with(['alert' => 'Book ' . $id . ' not found.']);
        }   
        return view('books.edit')->with([
            'book' => $book,
            'authorsForDropdown' => Author::getAuthorsForDropdown()
        ]);
    }

    public function update(Request $request, $id) {
        $this->validate($request, [
            'title' => 'required',
            'published_year' => 'required|digits:4|numeric',
            'cover_url' => 'required|url',
            'purchase_url' => 'required|url',
            'author_id' => 'required'
        ]);
        
        $book = Book::find($id);
        $book->title = $request->title;
        $book->published_year = $request->published_year;
        $book->author_id = $request->author_id;
        $book->cover_url = $request->cover_url;
        $book->purchase_url = $request->purchase_url;
        $book->save();
        return redirect('/books/' . $id . '/edit')
            -> with(['alert' => 'Your changes were saved']);
    }


    // GET books/{id}/delete
    // Confirmation page 
    public function delete($id) {
        $book = Book::find($id);
        if (!book) {
            return redirect('/books')->with('alert', 'Book not found');
        }
        return view('books.delete')->with(['book' => $book]);
    }

    // DELETE books/{id}/delete
    public function destroy($id) {
        $book = Book::find($id);
        $book->delete();
        return redirect('/books')
            ->with(['alert' => '"' . $book . '" was removed.']);
    }
    
    public function test($title = null) {
        dump($title);
        return view('books.show');
    }
}
