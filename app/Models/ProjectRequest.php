<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProjectRequest extends Model
{
    use HasFactory;

    protected $fillable = ['client_id', 'title', 'category', 'description', 'status'];

    public function client()
    {
        return $this->belongsTo(User::class, 'client_id');
    }
}