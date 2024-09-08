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
        'price',
        'remark',
    ];
    public function token()
    {
        return $this->hasmany(Token::class);
    }
    public function department(){
        return $this->belongsTo(Department::class);
    }
    
   
}
