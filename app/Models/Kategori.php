<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

use Illuminate\Database\Eloquent\Factories\HasFactory;

class Kategori extends Model
{
    use HasFactory;
    protected $table = 'kategori';

    protected $fillable = [
        'title',
        'slug',
    ];

    public function berita(): HasMany
    {
        return $this->hasMany(Berita::class, 'id_kat');
    }

    // relasi ke tag (pivot category_tag)
    public function tags(): BelongsToMany
    {
        return $this->belongsToMany(Tag::class, 'kategori_tag', 'category_id', 'tag_id');
    }
}
