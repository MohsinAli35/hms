<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Patient extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'department_id',
        'cnic',
        'age',
        'phone',
        'gender',
    ];
    public function department(){
        return $this->belongsTo(Department::class);
    }
   
}
