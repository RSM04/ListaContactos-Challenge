<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class contactlist extends Model
{
    protected $table = 'contactlist';

    protected $fillable = [
        'name', 'surname', 'email','category_id'
    ];
}
