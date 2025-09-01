<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany; // Import BelongsToMany

class Berita extends Model
{
    use HasFactory;
    protected $table = 'berita';


    protected $fillable = [
        'id_kat',
        'judul',
        'slug_berita',
        'deskripsi',
        'id_usr',
        'image',
    ];

    public function kategori(): BelongsTo
    {
        return $this->belongsTo(Kategori::class, 'id_kat');
    }


    public function user()
    {
        return $this->belongsTo(User::class, 'id_usr');
    }


    public function tags(): BelongsToMany
    {
        return $this->belongsToMany(Tag::class, 'berita_tag', 'berita_id', 'tag_id');
    }
}
