<?php
namespace App\Http\Controllers;
use App\Models\Crud;
use Illuminate\Http\Request;
class CrudController extends Controller
{
/**
* Display a listing of the resource.
*
* @return \Illuminate\Http\Response
*/
public function index()
{
$data['cruds'] = Crud::orderBy('id','desc')->paginate(5);
return view('index', $data);
}
/**
* Show the form for creating a new resource.
*
* @return \Illuminate\Http\Response
*/
public function create()
{
return view('create');
}
/**
* Store a newly created resource in storage.
*
* @param  \Illuminate\Http\Request  $request
* @return \Illuminate\Http\Response
*/
public function store(Request $request)
{
$request->validate([
'name' => 'required',
'email' => 'required',
'address' => 'required'
]);
$crud = new Crud;
$crud->name = $request->name;
$crud->email = $request->email;
$crud->address = $request->address;
$crud->save();
return redirect()->route('cruds.index')
->with('success','Company has been created successfully.');
}
/**
* Display the specified resource.
*
* @param  \App\crud  $crud
* @return \Illuminate\Http\Response
*/
public function show(Crud $crud)
{
return view('cruds.show',compact('crud'));
} 
/**
* Show the form for editing the specified resource.
*
* @param  \App\Crud  $crud
* @return \Illuminate\Http\Response
*/
public function edit(Crud $crud)
{
return view('edit',compact('crud'));
}
/**
* Update the specified resource in storage.
*
* @param  \Illuminate\Http\Request  $request
* @param  \App\crud  $crud
* @return \Illuminate\Http\Response
*/
public function update(Request $request, $id)
{
$request->validate([
'name' => 'required',
'email' => 'required',
'address' => 'required',
]);
$crud = Crud::find($id);
$crud->name = $request->name;
$crud->email = $request->email;
$crud->address = $request->address;
$crud->save();
return redirect()->route('cruds.index')
->with('success','Company Has Been updated successfully');
}
/**
* Remove the specified resource from storage.
*
* @param  \App\Crud  $crud
* @return \Illuminate\Http\Response
*/
public function destroy(Crud $crud)
{
$crud->delete();
return redirect()->route('cruds.index')
->with('success','Company has been deleted successfully');
}
}