<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Profile extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'real_name',
        'picture',
        'tlp',
        'jens_kel',
        'tgl_lahir',
        'alamat',
        'status',
        'tentang',
        'facebook',
        'instagram',
        'twitter',
        'tiktok'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
