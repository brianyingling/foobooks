<?php

namespace App\Http\Controllers;

use App;
use App\Author;
use App\Book;
use Config;
use IanLChapman\PigLatinTranslator\Parser;
use \Debugbar;

class PracticeController extends Controller
{
    public function practice22()
    {
        $books = Book::with('author')->get();
        foreach ($books as $book) {
            dump($book->author->first_name . " " . $book->author->last_name . " is the author of " . $book->title);
        }
    }
    public function practice21()
    {
        $book = Book::latest()->first();
        dd($book);
    }

    public function practice20()
    {
        $author = Author::where('first_name', '=', 'J.K.')->first();
        $book = new Book;
        $book->title = "Fantastic Beasts and Where to Find Them";
        $book->published_year = 2017;
        $book->cover_url = 'http://prodimage.images-bn.com/pimages/9781338132311_p0_v2_s192x300.jpg';
        $book->purchase_url = 'http://www.barnesandnoble.com/w/fantastic-beasts-and-where-to-find-them-j-k-rowling/1004478855';
        $book->author()->associate($author); # <--- Associate the author with this book
        $book->save();
        dump($book->toArray());
    }

    // Remove any/all books by the author “J.K. Rowling”.
    public function practice16()
    {
        $books = Book::all();
        echo $books;
        // $books = Book::where('author', '=', 'J.K. Rowling')->get();
        if (!$books) {
            dump('no books');
        } else {
            dump($books->toArray());
        }
    }

    // Retrieve all the books in descending order according to published date.
    public function practice15()
    {
        $books = Book::orderBy('published_year', 'desc')->get();
        if (!$books) {
            dump('no books');
        } else {
            dump($books->toArray());
        }
    }

    //Retrieve all the books in alphabetical order by title.
    public function practice14()
    {
        $books = Book::orderBy('title')->get();
        if (!$books) {
            dump('no books');
        } else {
            dump($books->toArray());
        }
    }

    // Retrieve all the books published after 1950.
    public function practice13()
    {
        $books = Book::where('published_year', '>', 1950)->get();
        if (!$books) {
            dump('no books');
        } else {
            dump($books->toArray());
        }
    }

    // Retrieve the last 2 books that were added to the books table.
    public function practice12()
    {
        $books = Book::orderBy('created_at', 'desc')->take(2)->get();
        if (!$books) {
            dump('no books');
        } else {
            dump($books->toArray());
        }
    }

    public function practice11()
    {
        $book = Book::where('author', '=', 'F. Scott Fitzgerald')->first();
        if (!$book) {
            dump('Did not delete the book');
        } else {
            $book->delete();
            dump('deleted; check the db');
        }
    }

    public function practice10()
    {
        $book = Book::where('author', '=', 'F. Scott Fitzgerald')->first();
        if (!$book) {
            dump('Book not found, can\'t update');
        } else {
            $book->title = 'The Really Great Gatsby';
            $book->published_year = 2025;
            $book->save();
            dump('update complete; check the db');
        }

    }
    public function practice9()
    {
        $books = Book::where('title', 'LIKE', '%Harry Potter%')->get();
        if ($books->isEmpty()) {
            dump('No matches found');
        } else {
            foreach ($books as $book) {
                dump($book->title);
            }
        }
    }

    public function practice8()
    {
        $book = new Book();
        $books = $book->where('title', 'LIKE', '%Harry Potter%')->get();
        if ($books->isEmpty()) {
            dump('No matches found');
        } else {
            foreach ($books as $book) {
                dump($book->title);
            }
        }
    }

    public function practice7()
    {
        $book = new Book();
        $book->title = 'Harry Potter and the Sorcerer\'s Stone';
        $book->author = 'J.K. Rowling';
        $book->published_year = 1997;
        $book->cover_url = 'http://prodimage.images-bn.com/pimages/9780590353427_p0_v1_s484x700.jpg';
        $book->purchase_url = 'http://www.barnesandnoble.com/w/harry-potter-and-the-sorcerers-stone-j-k-rowling/1100036321?ean=9780590353427';

        # Invoke the Eloquent `save` method to generate a new row in the
        # `books` table, with the above data
        $book->save();
        dump($book);
        // dump('Added: '.$book->title);

    }

    public function practice5()
    {
        $translator = new Parser();
        $translation = $translator->translate('hello world');
        dump($translation);
    }

    public function practice4()
    {
        $data = ['foo' => 'bar'];
        Debugbar::info($data);
        Debugbar::info('Current environment:' . App::environment());
        Debugbar::error('Error!');
        Debugbar::warning('watch out');
        Debugbar::addMessage('Another message', 'mylabel');
        return 'Demoing some features of Debugbar';
    }

    public function practice3()
    {
        echo Config::get('app.supportEmail');
        dump(config('database.connections.mysql'));
    }

    public function practice1()
    {
        dump('This is the first example');
    }

    public function practice2()
    {
        dump(['a' => '123', 'b' => '456']);
    }

    public function index($n = null)
    {
        $methods = [];
        if (is_null($n)) {
            foreach (get_class_methods($this) as $method) {
                if (strstr($method, 'practice')) {
                    $methods[] = $method;
                }
            }
            return view('practice')->with(['methods' => $methods]);
        } else {
            $method = 'practice' . $n;
            return (method_exists($this, $method)) ? $this->$method() : abort(404);
        }

    }
}
