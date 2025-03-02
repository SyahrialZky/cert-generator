<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Certificate extends Model
{
    protected $fillable = ['recipient_name', 'certificate_number', 'event_name', 'issued_date', 'template_id', 'status'];
    use HasFactory;
}
