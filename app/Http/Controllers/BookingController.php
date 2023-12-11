<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use Illuminate\Http\Request;
use PhpParser\Node\Expr\Cast\Bool_;

class BookingController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        try{
            $booking = Booking::all();
            return response()->json([
                "status" => true,
                "message" => 'Berhasil ambil data',
                "data" => $booking
            ], 200); //status code 200 = success
        }
        catch(\Exception $e){
            return response()->json([
                "status" => false,
                "message" => $e->getMessage(),
                "data" => []
            ], 400); //status code 400 = bad request
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try{
            //$request->all() untuk mengambil semua input dalam request body
            $booking = Booking::create($request->all());
            return response()->json([
                "status" => true,
                "message" => 'Berhasil insert data',
                "data" => $booking
            ], 200);//status code 200 = success
        }
        catch(\Exception $e){
            return response()->json([
                "status" => false,
                "message" => $e->getMessage(),
                "data" => []
            ], 400); //status code 400 = ad request
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        try{
            $booking = Booking::find($id);

            if(!$booking) throw new \Exception("Booking tidak ditemukan");

            return response()->json([
                "status" => true,
                "message" => 'Berhasil ambil data',
                "data" => $booking
            ], 200); //status code 200 = success
        }
        catch(\Exception $e){
            return response()->json([
                "status" => false,
                "message" => $e->getMessage(),
                "data" => []
            ], 400); //status code 400 = bad request
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        try{
            $booking = Booking::find($id);

            if(!$booking) throw new \Exception("Booking tidak ditemukan");

            $booking->update($request->all());

            return response()->json([
                "status" => true,
                "message" => 'Berhasil update data',
                "data" => $booking
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
            $booking = Booking::find($id);

            if(!$booking) throw new \Exception("Booking tidak ditemukan");

            $booking->delete();

            return response()->json([
                "status" => true,
                "message" =>'Berhasil delete data',
                "data" => $booking
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
}
