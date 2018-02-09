<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class EmailLogin extends Model
{
    public $fillable = ['id', 'token'];
    
    /*
    public function user()
    {
        return $this->hasOne(\App\User::class, 'id', 'id');
    }
    */
    
    public static function createForEmail($id)
    {
        return self::create([
            'id' => $id,
            'token' => str_random(20)
        ]);
    }

    public static function validFromToken($token)
    {
        return self::where('token', $token)
            ->where('created_at', '>', Carbon::parse('-15 minutes'))
            ->firstOrFail();
    }
}
