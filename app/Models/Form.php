<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Form extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'date',
        'subject',
        'request_details',
        'status',
        'guest_salutation',
        'guest_name',
        'guest_age',
        'guest_phone',
        'guest_house_number',
        'guest_village',
        'guest_subdistrict',
        'guest_district',
        'guest_province',
        'admin_name_verifier'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function attachments()
    {
        return $this->hasMany(FormAttachment::class);
    }

    public function replies()
    {
        return $this->hasMany(Reply::class);
    }
}
