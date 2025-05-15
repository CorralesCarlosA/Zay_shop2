<?php

namespace App\Models\admin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Color extends Model
{
    use HasFactory;

    protected $table = 'colorproducto';
    protected $primaryKey = 'idColor';
    public $incrementing = false;
    protected $keyType = 'int';
    public $timestamps = false;

    protected $fillable = ['nombreColor'];

    public function products()
    {
        return $this->hasMany(\App\Models\admin\Product::class, 'idColor', 'idColor');
    }
}
