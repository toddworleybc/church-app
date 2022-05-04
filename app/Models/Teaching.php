<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Teaching extends Model
{
    use HasFactory;


    protected $fillable = [
        'title',
        'speaker',
        'description',
        'video_url',
        'audio_url',
        'primary_text',
        'scripture',
        'secondary_text',
        'publish_date',
        'featured_img'
    ];


}
