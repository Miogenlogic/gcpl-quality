<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
class MasterCheckSheetSection extends Model
{

    protected $table='gw_master_checksheet_section';

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

        public function child_section()
        {
            return $this->hasMany('App\Models\ChecksheetChildSection','section_id','id');
        }
}













