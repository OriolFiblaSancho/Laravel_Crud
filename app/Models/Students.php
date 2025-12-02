<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
class Students extends Model
{
    use HasFactory;
    protected $fillable = ['name', 'email', 'course_id'];

    public function course()
    {
        return $this->belongsTo(Courses::class);
    }
}
