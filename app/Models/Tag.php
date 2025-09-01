<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;


class Tag extends Model
{
    use HasFactory;
    protected $table = 'tag';


    protected $fillable = [
        'title_tag',
        'slug_tag',
    ];

    public function berita(): BelongsToMany
    {
        return $this->belongsToMany(Berita::class, 'berita_tag', 'berita_id', 'tag_id');
    }

    public function kategoris(): BelongsToMany
    {
        return $this->belongsToMany(Kategori::class, 'kategori_tag', 'tag_id', 'category_id');
    }
}
