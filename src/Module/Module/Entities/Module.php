<?php

namespace Modules\Module\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Module extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'image',
        'slug',
        'description',
        'columns',
        'form_inputs',

    ];

    protected static function newFactory()
    {
        return \Modules\Module\Database\factories\ModuleFactory::new();
    }
}
