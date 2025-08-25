<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Mcq extends Model
{
    use HasFactory;
    protected $guarded = [];

    protected function questionImage(): Attribute
    {
        return Attribute::make(
            get: fn($value) => $value ? asset('storage/mcq-image/' . $value) : null
        );
    }

    public function chapter()
    {
        return $this->belongsTo(Chapter::class, 'chapter_id');
    }
}
