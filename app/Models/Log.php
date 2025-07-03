<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Log extends Model
{
    protected $table = "logs";
    protected $fillable = [
        "action",
        "user_id"
    ];

    //Un log pertenece a un usuario
    public function users()
    {
        return $this->belongsTo(User::class, "user_id");
    }
}
