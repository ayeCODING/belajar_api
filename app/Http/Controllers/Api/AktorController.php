<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Validator;
use App\Models\Aktor;

class AktorController extends Controller
{
    public function index(){
        $aktor =Aktor::latest()->get();
        $response = [
            'success' => true,
            'message' =>'Data aktor',
            'data' => $aktor,
        ];

        return response()->json($response, 200);
    }

    public function store(Request $request)
    {
    // validast data
    $validator = Validator::make($request->all(), [
        'nama_aktor' => 'required|unique:aktors',
        'biodata' => 'required|unique:aktors',
    ], [
        'nama_aktor.required' => 'Masukan aktor',
        'nama_aktor.unique' => 'Nama aktor Sudah digunakan!',
        'biodata.required' => 'Masukan biodata',
        'biodata.unique' => 'Biodata Sudah digunakan!',
    ]);

    if ($validator->fails()) {
        return response()->json([
            'success' => false,
            'message' => 'Silahkan isi dengan benar',
            'data' => $validator->errors(),
        ], 400);
    } else {
        $aktor = new Aktor;
        $aktor->nama_aktor = $request->nama_aktor;
        $aktor->biodata = $request->biodata;
        $aktor->save();
    }

    if ($aktor) {
        return response()->json([
            'success' => true,
            'message' => 'data berhasil disimpan',
        ], 201);
    } else {
        return response()->json([
            'success' => false,
            'message' => 'data gagal disimpan',
        ], 400);
    }
}

public function show($id){
    $aktor = Aktor::find($id);

    if($aktor) {
        return response()->json([
            'success' => true,
            'message' => 'Detail aktor',
            'data' => $aktor,
        ], 200);
    } else {
        return response()->json([
            'success' => false,
            'message' => 'aktor tidak ditemukan',
            'data' => '',
        ], 404);
    }
}

public function update(Request $request, $id)
{
// validasi data
$validator = Validator::make($request->all(), [
    'nama_aktor' => 'required',
    'biodata' => 'required',
], [
    'nama_aktor.required' => 'Masukan aktor',
    'biodata.required' => 'Masukan biodata',
]);

if ($validator->fails()) {
    return response()->json([
        'success' => false,
        'message' => 'Silahkan isi dengan benar',
        'data' => $validator->errors(),
    ], 400);
} else {
    $aktor = Aktor::find($id);
    $aktor->nama_aktor = $request->nama_aktor;
    $aktor->biodata = $request->biodata;
    $aktor->save();
}

if ($aktor) {
    return response()->json([
        'success' => true,
        'message' => 'data berhasil diperbarui',
    ], 201);
} else {
    return response()->json([
        'success' => false,
        'message' => 'data gagal diperbarui',
    ], 400);
}
}

public function destroy($id){
    $aktor = Aktor::find($id);
    $aktor->delete();
    return response()->json([
        'success' => true,
        'message' => 'data ' . $aktor-> nama_aktor . 'berhasil dihapus',
    ]);
}
}
