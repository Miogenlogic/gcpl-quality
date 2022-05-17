<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ChecksheetChildSection extends Model
{

    protected $table='checksheet_section_child';

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

         public function sub_child_section()
        {
            return $this->hasMany('App\Models\ChecksheetSubChildSection','child_id','id');
        }
}













