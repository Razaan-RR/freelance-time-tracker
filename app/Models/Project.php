<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    protected $fillable = ['client_id', 'title', 'description', 'status', 'deadline'];

    public function client()
    {
        return $this->belongsTo(Client::class);
    }
}

