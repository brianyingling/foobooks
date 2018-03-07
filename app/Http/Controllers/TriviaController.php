<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class TriviaController extends Controller
{
    public function index() {
        return 'show the question and the form';
    }

    public function checkAnswer() {
        return 'Check the answer and redirect the user back to the index page';
    }
}
