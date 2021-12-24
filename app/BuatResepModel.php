<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\User;

class BuatResepModel extends Model
{
    protected $table = 'tb_resep';

    protected $primaryKey = 'id';

    public function user(){
        return $this->belongsTo(User::class);
    }
}
