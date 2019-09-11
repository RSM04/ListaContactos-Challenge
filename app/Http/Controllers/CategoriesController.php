<?php

namespace App\Http\Controllers;

use App\category;
use Illuminate\Http\Request;

class CategoriesController extends Controller
{
    public function create($nombre){
        contactlist::create(['name'=>$nombre]);
        return response('todoperfecto');
    }
}
