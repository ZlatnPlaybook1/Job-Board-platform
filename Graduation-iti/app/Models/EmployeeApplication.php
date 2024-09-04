<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EmployeeApplication extends Model
{
    use HasFactory;
    protected $fillable = [
        'employee_post_id' ,
        'user_id' ,
        'occupation_id' ,
        'applied_date'
    ];
    public function employeepost()
    {
        return $this->belongsTo(EmployeePost::class, 'employee_post_id');
    }
    public function user(){
        return $this->belongsTo(User::class);
    }

    public function occupation()
    {
        return $this->belongsTo(User::class, 'occupation_id');
    }
}