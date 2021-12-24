<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\BuatResepModel;
use Illuminate\Support\Facades\Auth;

class apicontroller extends Controller
{

    public function insert_data_resep(Request $request){
        $insert_resep = new BuatResepModel;
        $insert_resep->nama_resep = $request->nama_resep;
        $insert_resep->user_id = Auth::user()->id;
        $insert_resep->lama_masakan = $request->lama_masakan;
        $insert_resep->status_lama_masakan = $request->status_lama_masakan;
        $insert_resep->pilihan = $request->pilihan;
        $insert_resep->jenis = $request->jenis;
        $insert_resep->bahan = $request->bahan;
        $insert_resep->langkah = $request->langkah;
        $insert_resep->save();
        return response()->json([
            'success'=>true,
            'message' => 'Resep Disimpan',
            'data'=>$insert_resep
        ]);
    }

    public function update_data_resep(Request $request){
        $data_resep = BuatResepModel::find($request->id);
        if(Auth::user()->id != $data_resep->user_id){
            return response()->json([
                'success'=>false,
                'message' => 'Unauthorized access'
            ]);
        }
        // $data_resep = BuatResepModel::find($id);
        $data_resep->nama_resep = $request->nama_resep;
        $data_resep->lama_masakan = $request->lama_masakan;
        $data_resep->status_lama_masakan = $request->status_lama_masakan;
        $data_resep->pilihan = $request->pilihan;
        $data_resep->jenis = $request->jenis;
        $data_resep->bahan = $request->bahan;
        $data_resep->langkah = $request->langkah;
        $data_resep->update();
        return response()->json([
            'success'=>true,
            'message' => 'Resep Diubah',
            'data'=>$data_resep
        ]);
        
        // $cek_resep = BuatResepModel::firstWhere('id', $id);
        // if($cek_resep){
        //     $data_resep = BuatResepModel::find($id);
        //     $data_resep->nama_resep = $request->nama_resep;
        //     $data_resep->lama_masakan = $request->lama_masakan;
        //     $data_resep->status_lama_masakan = $request->status_lama_masakan;
        //     $data_resep->pilihan = $request->pilihan;
        //     $data_resep->jenis = $request->jenis;
        //     $data_resep->bahan = $request->bahan;
        //     $data_resep->langkah = $request->langkah;
        //     $data_resep->save();
        //     return response()->json([
        //         'success'=>true,
        //         'message' => 'Resep Diubah',
        //         'data'=>$data_resep
        //     ]);
        // } else {
        //     return response([
        //         'status' => 'Tidak Ditemukan',
        //         'message' => 'Resep Tidak Diubah',
        //     ], 404);
        // }
    }

    public function delete_data_resep(Request $request){
        $data_resep = BuatResepModel::find($request->id);
        if(Auth::user()->id != $data_resep->user_id){
            return response()->json([
                'success'=>false,
                'message' => 'Unauthorized access'
            ]);
        }
        $data_resep->delete();
        return response()->json([
            'success'=>true,
            'message' => 'Resep Dihapus'
        ]);
    }

    public function ambil_semua_resep(Request $request){
        $show_resep = BuatResepModel::orderBy('id')->get();
        foreach($show_resep as $show){
            $show->user;
        }
        return response()->json([
            'success'=>true,
            'data'=>$show_resep
        ]);
    }

    public function ambil_satu_resep($id){
        $show_satu_resep = BuatResepModel::find($id);
        return response()->json([
            'success'=>true,
            'data'=>$show_satu_resep
        ]);
    }

    
}
