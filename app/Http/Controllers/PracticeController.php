<?php

namespace App\Http\Controllers;
use Config;
use App;
use \Debugbar;
use IanLChapman\PigLatinTranslator\Parser;


class PracticeController extends Controller
{
    public function practice5() {
        $translator = new Parser();
        $translation = $translator->translate('hello world');
        dump($translation);
    }
    
    public function practice4() {
        $data = ['foo' => 'bar'];
        Debugbar::info($data);
        Debugbar::info('Current environment:' . App::environment());
        Debugbar::error('Error!');
        Debugbar::warning('watch out');
        Debugbar::addMessage('Another message', 'mylabel');
        return 'Demoing some features of Debugbar';
    }
    
    public function practice3() {
        echo Config::get('app.supportEmail');
        dump(config('database.connections.mysql'));
    }

    public function practice1()
    {
        dump('This is the first example');
    }

    public function practice2() {
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
