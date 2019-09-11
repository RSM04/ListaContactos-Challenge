<?php

namespace App\Http\Controllers;

use App\category;
use App\contactlist;
use Illuminate\Http\Request;
class contactListController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('contact.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function crear($name,$surname,$email)
    {
        //Esta función deberia devolver un view y no almanecarlo, pero por tiempo lo hago aqui
        contactlist::create(['name'=>$name,'surname'=>$surname,'email'=>$email]);
        $contactos = contactlist::limit(5)->orderBy('id','desc')->get();
        $cantidad = contactlist::count();
        $paginastotales = ceil($cantidad/5);
        return view('partial.contactlist',compact('contactos','paginastotales'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $contact = contactlist::find($id);
        $contact->name = $request->input('name');
        $contact->surname = $request->input('surname');
        $contact->email = $request->input('email');
        $contact->categories = $request->input('categorias');
        $contact->save();
        $contactos = contactlist::limit(5)->orderBy('id','desc')->get();
        $cantidad = contactlist::count();
        $paginastotales = ceil($cantidad/5);
        return view('partial.contactlist',compact('contactos','paginastotales'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $contacto = contactlist::find($id);
        $contacto->delete();
        $contactos = contactlist::limit(5)->orderBy('id','desc')->get();
        $cantidad = contactlist::count();
        $paginastotales = ceil($cantidad/5);
        return view('partial.contactlist',compact('contactos','paginastotales'));
    }
    public function getcontacts(){
        $contactos = contactlist::limit(5)->orderBy('id','desc')->get();
        $cantidad = contactlist::count();
        $paginastotales = ceil($cantidad/5);
        return view('partial.contactlist',compact('contactos','paginastotales'));
    }
    public function totalcategories(){
        $categories = category::get();
        $categoriesname = array();
        for ($i = 0; $i < count($categories);$i++){
            array_push($categoriesname,$categories[$i]->name);
        }
        return response()->json($categoriesname);
    }
    public function paginacion($page){
        $offsetting = $page * 5;
        $cantidad = contactlist::count();
        $paginastotales = ceil($cantidad/5);
        $contactos = contactlist::orderBy('id','desc')->offset($offsetting)->limit(5)->get();
        return view('partial.contactlist',compact('contactos','paginastotales'));
    }
}
