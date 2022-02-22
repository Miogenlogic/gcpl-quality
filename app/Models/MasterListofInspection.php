<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MasterListofInspection extends Model
{

    protected $table='gw_master_list_of_inspection_report';

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
