<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Installment extends Model
{
    use HasFactory;

    public function holder()
    {
        return $this->belongsTo(Holder::class);
    }

    public function loan()
    {
        return $this->belongsTo(Loan::class);
    }
}
