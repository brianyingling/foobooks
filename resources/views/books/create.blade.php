@extends('layouts.master')

@section('title')
    New book
@endsection

@section('content')
    <h1>Add a new book</h1>
    <form method='POST' action='/books'>
        {{ csrf_field() }}

        <div class="details">* Required Fields</div>
        
        <div class="title">* Title</div>
        <input type="text" name="title" id="title" value='{{old('title', 'Green Eggs & Ham')}}'>
        {{-- @include('modules.error-field', ['field' => 'title']) --}}
        
        <div class="author">* Author</div>
        <input type="text" name="author" id="author" value='{{old('author', 'Dr. Seuss')}}'>
        {{-- @include('modules.error-field', ['field' => 'author']) --}}
        
        <div class="published_year">* Published Year (YYYY)</div>
        <input type="text" name="published_year" id="published_year" value='{{old('published_year', '1960')}}'>
        {{-- @include('modules.error-field', ['field' => 'published_year']) --}}
        
        <div class="cover_url">* Cover URL</div>
        <input type="text" name="cover_url" id="cover_url" value='{{old('cover_url', '//')}}'>
        {{-- @include('modules.error-field', ['field' => 'cover_url']) --}}
        
        <div class="purchase_url">* Purchase URL</div>
        <input type="text" name="purchase_url" id="purchase_url" value='{{old('purchase_url', '//')}}'>
        {{-- @include('modules.error-field', ['field' => 'purchase_url']) --}}
        
        <input type="submit" value="Add Book" class="btn btn-primary">
            Add Book
        </input>
    </form>
@endsection
