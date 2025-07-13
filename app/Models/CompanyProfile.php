<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CompanyProfile extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'company_profile';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'logo_path',
        'description',
        'vision',
        'mission',
        'primary_color',
        'address',
        'pool_address',
        'phone_numbers',
        'email',
        'google_maps_embed_url',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
        'phone_numbers' => 'array',
    ];

    /**
     * Get the logo URL.
     */
    public function getLogoUrlAttribute(): ?string
    {
        return $this->logo_path ? asset('storage/' . $this->logo_path) : null;
    }

    /**
     * Get formatted phone numbers with labels.
     */
    public function getFormattedPhoneNumbersAttribute(): array
    {
        if (!$this->phone_numbers) {
            return [];
        }

        return collect($this->phone_numbers)->map(function ($phone, $index) {
            return [
                'label' => 'Telepon ' . ($index + 1),
                'number' => $phone
            ];
        })->toArray();
    }

    /**
     * Get company name with default value.
     */
    public function getNameAttribute($value): string
    {
        return $value ?: 'Data belum diisi';
    }

    /**
     * Get address with default value.
     */
    public function getAddressAttribute($value): string
    {
        return $value ?: 'Data belum diisi';
    }

    /**
     * Get pool address with default value.
     */
    public function getPoolAddressAttribute($value): string
    {
        return $value ?: 'Data belum diisi';
    }

    /**
     * Get email with default value.
     */
    public function getEmailAttribute($value): string
    {
        return $value ?: 'Data belum diisi';
    }

    /**
     * Scope to get the main company profile.
     */
    public function scopeMain($query)
    {
        return $query->first();
    }
}
