<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Contracts\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Word extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable = ['term', 'definition', 'technology', 'slug'];

    public function links()
    {
        return $this->hasMany(Link::class);
    }

    public function tags()
    {
        return $this->belongsToMany(Tag::class);
    }

    public function getFormattedDate($column, $format = 'd-m-Y')
    {
        return Carbon::create($this->$column)->format($format);
    }

    ////////////// Filtri ////////////////////

    // Filtro per i tag
    public function scopeTag(Builder $query, $tag_id)
    {
        if (!$tag_id) return $query;
        return $query->whereHas('tags', function ($query) use ($tag_id) {
            $query->where('tags.id', $tag_id);
        });
    }

    // Filtro per i pubblicati
    public function scopePublic(Builder $query, $status)
    {
        if (!$status) return $query;
        $value = $status === 'published';
        return $query->whereIsPublished($value);
    }
}
