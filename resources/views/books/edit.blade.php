@extends('layouts.master')

@section('title')
    Edit {{$book->title}}
@endsection

@section('content')
    <h1>Edit {{$book->title}}</h1>
<form method='POST' action='/books/{{$book->id}}'>
        {{ method_field('put') }}
        {{ csrf_field() }}

        <div class="details">* Required Fields</div>
        
        <div class="title">* Title</div>
        <input type="text" name="title" id="title" value='{{old('title', $book->title)}}'>
        {{-- @include('modules.error-field', ['field' => 'title']) --}}
        
        <div class="author">* Author</div>
        <input type="text" name="author" id="author" value='{{old('author', $book->author)}}'>
        {{-- @include('modules.error-field', ['field' => 'author']) --}}
        
        <div class="published_year">* Published Year (YYYY)</div>
        <input type="text" name="published_year" id="published_year" value='{{old('published_year', $book->published_year)}}'>
        {{-- @include('modules.error-field', ['field' => 'published_year']) --}}
        
        <div class="cover_url">* Cover URL</div>
        <input type="text" name="cover_url" id="cover_url" value='{{old('cover_url', $book->cover_url)}}'>
        {{-- @include('modules.error-field', ['field' => 'cover_url']) --}}
        
        <div class="purchase_url">* Purchase URL</div>
        <input type="text" name="purchase_url" id="purchase_url" value='{{old('purchase_url', $book->purchase_url)}}'>
        {{-- @include('modules.error-field', ['field' => 'purchase_url']) --}}
        
        <input type="submit" value="Save Changes" class="btn btn-primary">
    </form>
@endsection
