<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Code;
use Validator;
use Redirect;
use Session;
class CodeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $code=Code::all();    
        return view('index' ,compact('code'));


    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
     return view('add');
 }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $rule= array('first_name' =>'required' ,'last_name'=>'required','email'=>'required','image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048','city'=>'required','country'=>'required','job_title'=>'required' );

        $v=Validator::make($request->all(),$rule);
        if($v->fails()){
            return redirect('code/create')
            ->withErrors($v)
            ->withInput();
        }

        $imageName = time().'.'.request()->image->getClientOriginalExtension();

        request()->image->move(public_path('images'), $imageName);

        $input = array('fname' => $request->first_name,'lname' => $request->last_name,'email'=>$request->email,'image'=>$imageName,'city' => $request->city,'country'=>$request->country,'job'=>$request->job_title );

        $User=Code::create($input);

        Session::flash('success', 'Success! insert successfully!');
        return redirect('code');

         }    /**
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
       $code = Code::find($id);
       return view('update', compact('code'));    
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
        $rule= array('first_name' =>'required' ,'last_name'=>'required','email'=>'required','city'=>'required','country'=>'required','job_title'=>'required' );


        $imageName = $request->hidden_image;

        $image = $request->file('image');
        if($image != '')
        {
           $rule= array('first_name' =>'required' ,'last_name'=>'required','email'=>'required','image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048','city'=>'required','country'=>'required','job_title'=>'required' );

           $imageName = time().'.'.request()->image->getClientOriginalExtension();

           request()->image->move(public_path('images'), $imageName);       
            }
           else
           {
            $rule= array('first_name' =>'required' ,'last_name'=>'required','email'=>'required','city'=>'required','country'=>'required','job_title'=>'required' );
        }


        $v=Validator::make($request->all(),$rule);
        if($v->fails()){
            return redirect('code/'.$id.'/edit')
            ->withErrors($v)
            ->withInput();
        }


        $input = array('fname' => $request->first_name,'lname' => $request->last_name,'email'=>$request->email,'image'=>$imageName,'city' => $request->city,'country'=>$request->country,'job'=>$request->job_title );

        $User=Code::where('id',$id)->update($input);

        Session::flash('success', 'Success! update successfully!');
        return redirect('code');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {

       $code = Code::find($id);
       $code->delete();
       $response=['success'=>'sucess',
       'mgs'=>'delete sucessfully'];

       return json_encode($response);
   }
}
