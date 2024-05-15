<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
// リレーションするモデル
use App\Models\Seal;

class Tag extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
    ];

    // リレーション
    public function seal()
    {
        return $this->belongsTo(Seal::class);
    }
}
