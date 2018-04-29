@extends('layouts.master')

@section('title')
    All the books
@endsection

@push('head')
    <link href='/css/books/show.css' type='text/css' rel='stylesheet'>
@endpush

@section('content')
    @if(count($newBooks) > 0)
        <aside id="newBooks">
            <ul>
                @foreach($newBooks as $book) 
                    <li>
                        <a href="/books/{{$book->id}}">
                            {{$book->title}}            
                        </a>
                    </li>
                @endforeach
            </ul>
        </aside>
    @endif
    
    <h1>All Books</h1>
    @if(count($newBooks) > 0)
        @foreach($books as $book)
            <div class="book cf">
                <img src="{{$book->cover_url}}" alt="" class="cover" alt="Cover image for {{$book->title}}">
                <h2>{{$book->title}}</h2>
                <p>By {{$book->author}}</p>
                <p>Published in {{$book->published_year}}</p>
                <a href="/books/{{$book->id}}">View</a> |
                <a href="{{$book->purchase_url}}">Purchase</a>
            </div>
        @endforeach
    @endif
@endsection
