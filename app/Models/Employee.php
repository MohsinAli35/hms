<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'dob',
        'employee_id',
        'role_id',
        'cnic',
        'd_i',
        'd_e',
        'blood',
        'office_no',
        'contact_no',
        'address',
        'account_no',
        'image',
    ];
    public function role(){
        return $this->belongsTo(Role::class);
    }
}

