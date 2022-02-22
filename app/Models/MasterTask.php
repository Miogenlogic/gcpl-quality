<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MasterTask extends Model
{

    protected $table='machine_modelwise_task';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        // 'name', 'email', 'password',
    ];


    /*
        protected $primaryKey = "";
        public $incrementing = false;
        public $timestamps = false;
    */
}
