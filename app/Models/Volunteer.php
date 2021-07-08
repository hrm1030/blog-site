<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Volunteer extends Model
{
    protected $fillable = ['fullname', 'email', 'phone', 'website', 'university', 'faculty', 'department', 'birthday', 'photo', 'description', 'majors'];
}
