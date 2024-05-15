<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
// リレーションするモデル
use App\Models\User;
use App\Models\Seal;

class Package extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
    ];

    // リレーション
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function seals()
    {
        return $this->hasMany(Seal::class);
    }
}
