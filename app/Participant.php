<?php

namespace App;

use Illuminate\Database\Eloquent\Model;


class Participant extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'phone', 'company_id'
    ];

}
