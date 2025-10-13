<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JobVacancy extends Model
{
    use HasFactory;

    protected $table = 'job_vacancies';

    /**
     * Mass assignable columns for job vacancies.
     */
    protected $fillable = [
        'title',
        'description',
        'location',
        'company',
        'logo',
        'salary',
    ];
}
