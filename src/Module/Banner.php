<?php

namespace Softce\Banner\Module;


use Illuminate\Database\Eloquent\Model;

class Banner extends Model
{
    protected $fillable = ['path', 'uri'];
}