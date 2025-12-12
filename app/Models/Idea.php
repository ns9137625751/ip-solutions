<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Idea extends Model
{
    protected $fillable = [
        'user_id', 'title', 'summary', 'stage', 'domain', 'technology_type',
        'co_applicants_needed', 'funding_requirement', 'filing_date',
        'document_path', 'status', 'is_featured', 'is_visible'
    ];

    protected $casts = [
        'filing_date' => 'date',
        'funding_requirement' => 'decimal:2',
        'is_featured' => 'boolean',
        'is_visible' => 'boolean',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function interests(): HasMany
    {
        return $this->hasMany(Interest::class);
    }

    public function scopeApproved($query)
    {
        return $query->where('status', 'approved')->where('is_visible', true);
    }

    public function scopeFeatured($query)
    {
        return $query->where('is_featured', true);
    }
}
