<?php

namespace App\Models\SecondDatabase;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EconomyGdpCompositionSpecific extends Model
{
    use HasFactory;

    protected $connection= 'mysql2';

    protected $table="economy_gdp_composition_specific";
}
