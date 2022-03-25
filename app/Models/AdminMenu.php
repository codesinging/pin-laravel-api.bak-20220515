<?php

namespace App\Models;

use App\Support\Model\BaseModel;
use Kalnoy\Nestedset\NodeTrait;

class AdminMenu extends BaseModel
{
    use NodeTrait;

    protected $fillable = [
        'name',
        'path',
        'url',
        'icon',
        'sort',
        'default',
        'opened',
        'status',
    ];

    protected $casts = [
        'default' => 'boolean',
        'opened' => 'boolean',
        'status' => 'boolean',
    ];
}