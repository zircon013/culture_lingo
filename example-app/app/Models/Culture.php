<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Culture extends Model
{
    protected $primaryKey = 'id';
    public $incrementing = false;
    protected $keyType = 'string';
    
    public $timestamps = false;

    protected $fillable = [
        'id',
        'name',
        'emoji',
        'flag_path',
        'description',
    ];

    public function questions()
    {
        return $this->hasMany(Question::class, 'culture_id', 'id');
    }
}