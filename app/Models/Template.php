<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Template extends Model
{
    protected $fillable = ['name', 'file_path'];
    protected $attributes = ['file_path' => ''];
    use HasFactory;

    public function getRouteKeyName()
    {
        return 'id';
    }
}
