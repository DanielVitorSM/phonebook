<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class Contact extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [
        'name',
        'image',
        'user_id',
        'cell',
        'phone',
        'email'
    ];

    /**
     * Format cell number on Brazil pattern with DDD
     */
    public function getCellFormatted() {
        return preg_replace("/(\d{2})(\d{4,5})(\d{4})/m", '($1) $2-$3', $this->cell);
    }

    /**
     * Format phone number on Brazil pattern with DDD
     */
    public function getPhoneFormatted() {
        return preg_replace("/(\d{2})(\d{4})(\d{4})/m", '($1) $2-$3', $this->phone);
    }

    use HasFactory;
}
