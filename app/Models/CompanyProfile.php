<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

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
        'address',
        'pool_address',
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
    ];

    /**
     * Get the contacts for the company profile.
     */
    public function contacts(): HasMany
    {
        return $this->hasMany(Contact::class);
    }

    /**
     * Get active contacts for the company profile.
     */
    public function activeContacts(): HasMany
    {
        return $this->contacts()->active()->ordered();
    }

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
        $phoneContacts = $this->activeContacts()
            ->whereIn('type', ['phone', 'whatsapp'])
            ->get();

        return $phoneContacts->map(function ($contact, $index) {
            return [
                'label' => $contact->label ?: ('Telepon ' . ($index + 1)),
                'number' => $contact->value,
                'type' => $contact->type
            ];
        })->toArray();
    }

    /**
     * Get primary email.
     */
    public function getPrimaryEmailAttribute(): string
    {
        $email = $this->activeContacts()->byType('email')->primary()->first();
        return $email ? $email->value : 'Data belum diisi';
    }

    /**
     * Get email with default value (for backward compatibility).
     */
    public function getEmailAttribute(): string
    {
        return $this->getPrimaryEmailAttribute();
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
     * Scope to get the main company profile.
     */
    public function scopeMain($query)
    {
        return $query->first();
    }
}
