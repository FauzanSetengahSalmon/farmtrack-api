<?php

namespace App\Http\Controllers;

use App\Models\Livestock;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class LivestockController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $email = $request->query('user_email');

        $data = Livestock::where(
            'user_email',
            $email
        )
            ->latest()
            ->get();

        return response()->json($data);
    }
    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try {

            $request->validate([

                'user_email' => 'required',
                'name' => 'required',
                'type' => 'required',
                'age' => 'required',
                'weight' => 'required',
                'photo' => 'required|image'
            ]);

            $path = $request
                ->file('photo')
                ->store(
                    'livestock',
                    'public'
                );

            Livestock::create([

                'user_email' =>
                $request->user_email,

                'name' =>
                $request->name,

                'type' =>
                $request->type,

                'age' =>
                $request->age,

                'weight' =>
                $request->weight,

                'photo' =>
                $path
            ]);

            return response()->json([
                'status' => 'success'
            ]);
        } catch (Exception $e) {

            return response()->json([
                'status' => 'failed',
                'message' => $e->getMessage()
            ]);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Livestock $livestock)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Livestock $livestock)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(
        Request $request,
        $id
    ) {
        try {
            $data =
                Livestock::findOrFail($id);
            $data->update([
                'name' =>
                $request->name,
                'type' =>
                $request->type,
                'age' =>
                $request->age,
                'weight' =>
                $request->weight
            ]);
            return response()->json([
                'status' => 'success'
            ]);
        } catch (Exception $e) {
            return response()->json([
                'status' => 'failed',
                'message' => $e->getMessage()
            ]);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        try {
            $data =
                Livestock::findOrFail($id);
            Storage::disk('public')
                ->delete($data->photo);
            $data->delete();
            return response()->json([
                'status' => 'success'
            ]);
        } catch (Exception $e) {
            return response()->json([
                'status' => 'failed',
                'message' => $e->getMessage()
            ]);
        }
    }
}
