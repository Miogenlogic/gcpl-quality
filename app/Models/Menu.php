<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Menu extends Model
{

    protected $table='menus';

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



