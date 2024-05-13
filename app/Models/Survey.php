<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Survey extends Model
{
    protected $table = 'survey';
    protected $fillable = [
        'pertanyaan1', 'pertanyaan2', 'pertanyaan3'
    ];
    public function answers()
{
    return $this->hasMany(Answer::class);
}
}
