<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EmployeeSaved extends Model
{
    use HasFactory;
    protected $fillable = [
        'employee_post_id',
        'user_id',
    ];

    public function employeePost()
    {
        return $this->belongsTo(EmployeePost::class, 'employee_post_id');
    }
}