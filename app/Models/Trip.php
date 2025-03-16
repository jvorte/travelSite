<?php

// app/Models/Trip.php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Trip extends Model
{
    use HasFactory;

    // Ορίστε τα πεδία που είναι "fillable" για μαζική ανάθεση
    protected $fillable = ['name', 'description', 'image'];
}
