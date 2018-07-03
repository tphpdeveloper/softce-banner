<?php

namespace Softce\Banner\Module;


use Illuminate\Database\Eloquent\Model;

class Banner extends Model
{

    use \Themsaid\Multilingual\Translatable;

    protected $fillable = ['title', 'description', 'path', 'uri'];

    public $translatable = ['title', 'description'];
    public $casts = [
        'title' => 'array',
        'description' => 'array'
    ];

}