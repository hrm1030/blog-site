<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
    protected $fillable = ['fullname', 'email', 'phone', 'website', 'university_id', 'faculty_id', 'department_id', 'birthday', 'photo', 'description', 'majors', 'emp_type'];
}
