<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Question extends Model
{
    protected $fillable = ['culture_id', 'question_text'];

    public function culture()
    {
        return $this->belongsTo(Culture::class, 'culture_id', 'id');
    }

    public function answers()
    {
        return $this->hasMany(Answer::class);
    }
}