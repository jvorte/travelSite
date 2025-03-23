<?php

// app/Models/Trip.php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Trip extends Model
{
    use HasFactory;

    public function users()
{
    return $this->belongsToMany(User::class, 'favorites');
}

    // Ορίστε τα πεδία που είναι "fillable" για μαζική ανάθεση
    protected $fillable = ['name', 'description', 'image'];
}
