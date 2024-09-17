<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
    use HasFactory;
    public $timestamps = false;
     // Specify the table associated with the model, if different from the default
     protected $table = 'books';

     // Define the fillable attributes for mass assignment
     protected $fillable = [
         'title',
         'author',
         'description',
         'published_date',
     ];
 
     // Optionally, you can define any hidden or cast attributes here
     protected $hidden = [
         // attributes to hide
     ];
 
     protected $casts = [
         'published_date' => 'datetime',
     ];
     
}
