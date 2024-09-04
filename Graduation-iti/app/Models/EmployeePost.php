<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EmployeePost extends Model
{
    use HasFactory;
    protected $fillable = [
        'title', 'employee_class_id', 'employment_type_id', 'vacancy', 'salary',
        'location', 'description', 'benefits', 'responsibility', 'qualifications',
        'keywords', 'experience', 'company_name', 'company_location', 'company_website' ,
        'user_id' , 'isFeatured', 'status'
    ];
    public function employeeType()
    {
        return $this->belongsTo(Employeetype::class, 'employment_type_id');
    }

    public function employeeClass()
    {
        return $this->belongsTo(Employeeclass::class, 'employee_class_id');
    }
    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function employer()
    {
    return $this->belongsTo(User::class, 'user_id');
    }
    public function applications(){
        return $this->hasMany(EmployeeApplication::class);
    }


}
