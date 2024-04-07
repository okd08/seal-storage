<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
// リレーションするモデル
use App\Models\Package;
use App\Models\Tag;

class Seal extends Model
{
    use HasFactory;

    // リレーション
    public function package()
    {
        return $this->belongsTo(Package::class);
    }

    public function tags()
    {
        return $this->hasMany(Tag::class);
    }
}
