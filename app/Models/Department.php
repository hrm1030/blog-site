<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Department extends Model
{
    protected $fillable = ['name', 'university_id', 'faculty_id', 'professors_cnt', 'students_cnt', 'description'];
}
