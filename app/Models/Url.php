<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Url extends Model
{
    use HasFactory;

    protected $fillable = ['url', 'valid_until', 'valid_unlimited'];

    public function isValid()
    {
        return $this->valid_unlimited || time() < strtotime($this->valid_until);
    }
}
