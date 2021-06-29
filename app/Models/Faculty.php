<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Faculty extends Model
{
    protected $fillable = ['name', 'university_id', 'photo', 'departments_cnt', 'professors_cnt', 'students_cnt', 'description'];
}
