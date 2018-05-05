<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Author extends Model
{
    public function books()
    {
        return $this->hasMany('App\Book');
    }

    public static function getAuthorsForDropdown() {
        $authors = self::orderBy('last_name')->get();
        $authorsForDropdown = [];
        foreach($authors as $author) {
            $name = $author->last_name . ', ' . $author->first_name;
            $authorsForDropdown[$author->id] = $name;
        }
        return $authorsForDropdown;
    }
}
