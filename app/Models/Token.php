<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Support\Carbon;

class Token extends Model
{
    use HasFactory;
    protected $fillable=[
        'date',
        'token',
        'paitent_id',
        'paitent_name',
        'department_id',
    ];
    protected function schedule(Schedule $schedular){
        $schedular->command('token:reset')->dailyAt('00:00');

    }
public function handle(){
    Token::whereData('created_at','<',Carbon::today()->toDateString())
    ->delete();
}
     // public static function generateToken($paitent_id,$p_name,$department){

    //     $currentData = Carbon::now()->format('Y-m-d');
    //     $l_Token = Token::where('date',$currentData)->latest()->first();
    //     if($l_Token){
    //         $newToken = $l_Token->token + 1;
    //     }else{
    //         $newToken =1;
    //     }

    //     Token::create(
    //         [
    //             'date'=>$currentData,
    //             'token'=>$newToken,
    //             'paitent_id'=>$paitent_id,
    //             'paitent_name'=>$p_name,
    //             'departement'=>$department
    //         ]
    //         );
    //         return $newToken;
    // }
}
