<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $user = User::all();
        
        return response()->json([
            'message' => 'Retrieve All User',
            'data' => $user,
        ], 200);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try{
            $user = User::create($request->all());
            return response()->json([
                "status" => true,
                "message" => 'Register Success',
                "data" => $user,
            ], 200);
        }catch(\Exception $e){
            return response()->json([
                "status" => false,
                "message" => $e->getMessage(),
                "data" => [],
            ], 400);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        try{
            $user = User::find($id);

            if(!$user) throw new \Exception("User tidak ditemukan");
            
            return response()->json([
                "status" => true,
                "message" => 'Berhasil ambil data',
                "data" => $user,
            ], 200);
        }catch(\Exception $e){
            return response()->json([
                "status" => false,
                "message" => $e->getMessage(),
                "data" => [],
            ], 400);
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        try{
            $user = User::find($id);

            if(!$user) throw new \Exception("User tidak ditemukan");

            $user->update($request->all());

            return response()->json([
                "status" => true,
                "message" => 'Berhasil update data',
                "data" => $user,
            ], 200);
        }
        catch(\Exception $e){
            return response()->json([
                "status" => false,
                "message" => $e->getMessage(),
                "data" => []
            ], 400);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try{
            $user = User::find($id);

            if(!$user) throw new \Exception("User tidak ditemukan");

            $user->delete();

            return response()->json([
                "status" => true,
                "message" => 'Berhasil delete data',
                "data" => $user,
            ], 200);
        }
        catch(\Exception $e){
            return response()->json([
                "status" => false,
                "message" => $e->getMessage(),
                "data" => []
            ], 400);
        }
    }

    public function login(Request $request){
        $loginData = $request->all();
        
        $validate = Validator::make($loginData,[
            'username' => 'required',
            'password' => 'required'
        ]);

        if($validate->fails()){
            return response()->json(['message' => $validate->errors()], 400);
        }

        if(!Auth::attempt($loginData)){
            return response()->json([
                'status' => false,
                'message' => 'Invalid Credential'], 401);
        }

        $user = Auth::user();
        
        return response([
            'status' => true,
            'message' => 'Login Success',
            'user' => $user,
        ]);
    }
}
