@extends('layouts.master')

@section('title')
    New book
@endsection

@section('content')
    <h1>Add a new book</h1>
    <form method='POST' action='/books'>
        {{ csrf_field() }}
        <label for='title'>Title</label>
        <input type='text' name='title' id='title'>
        <input type='submit' value='Add book'>
    </form>
@endsection
