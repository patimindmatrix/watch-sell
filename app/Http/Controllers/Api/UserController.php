<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\User;
use App\Http\Resources\UserController as UserResource;
use App\Helper\Functions;

class UserController extends Controller
{
    /**
     * Display the specified resource.
     * Not display password and remember_token because in User model was hidden these
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    public function index()
    {
        $users =  User::where('status', 'active')->get();

        foreach ($users as $key => $user){
            if($user -> picture){
                $user -> picture = Functions::getImage("user", $user -> picture);
            }
        }

        return UserResource::collection($users);
    }

    public function store(Request $request)
    {
        if(DB::table('user')->insert($request->all())){
            return response()->json("User has been created",201);
        }
        else{
            return response()->json("Can not create");
        }
    }

    public function show($id)
    {
        //
    }

    public function update(Request $request, $id)
    {
        //
    }

    public function destroy($id)
    {
        //
    }
}
