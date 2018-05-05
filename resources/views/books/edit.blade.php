@extends('layouts.master')

@section('title')
    Edit {{$book->title}}
@endsection

@section('content')
    <h1>Edit {{$book->title}}</h1>
<form method='POST' action='/books/{{$book->id}}'>
        {{ method_field('put') }}
        {{ csrf_field() }}

        @include('books.bookFormInputs')
    
        <input type="submit" value="Save Changes" class="btn btn-primary">
    </form>
@endsection
