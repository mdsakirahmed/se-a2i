<?php

namespace App\Models\SecondDatabase;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ImportCountry extends Model
{
    use HasFactory;

    protected $connection= 'mysql2';

    protected $table="economy_import_country";
}
