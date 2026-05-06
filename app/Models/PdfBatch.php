<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PdfBatch extends Model
{
    use HasFactory;
    protected $fillable = [
        'status', 'total', 'processed', 'file_path', 'file_type'
    ];

    
}
