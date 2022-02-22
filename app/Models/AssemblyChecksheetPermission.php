<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AssemblyChecksheetPermission extends Model
{

    protected $table='gw_master_engine_assembly_checksheet_permission';
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