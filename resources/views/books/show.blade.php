@extends('layouts.master')

@section('title')
    {{$book->title}}
@endsection

@push('head')
    <link href='/css/books/show.css' type='text/css' rel='stylesheet'>
@endpush

@section('content')
    <h1>{{$book->title}}</h1>
    <p>
        <div class="book cf">
            <img src="{{$book->cover_url}}" alt="" class="cover" alt="Cover image for {{$book->title}}">
            <h2>{{$book->title}}</h2>
            <p>By {{$book->author}}</p>
            <p>Published in {{$book->published_year}}</p>
            <a href="/books/{{$book->id}}">View</a> |
            <a href="{{$book->purchase_url}}">Purchase</a>
        </div>
    </p>
@endsection
