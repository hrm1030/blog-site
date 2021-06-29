<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class University extends Model
{
    protected $fillable = ['name', 'location','founded_date', 'decription', 'photo', 'faculties_cnt', 'professors_cnt', 'students_cnt'];
}
