<?php

namespace App\Http\Controllers;

use App\Models\Rekomendasi;
use App\Models\Saran;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class RekomendasiController extends Controller
{
    public function index(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'umur' => 'required',
            'frekuensi' => 'required',
            'berat_badan' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json(
                [
                    'message' => $validator->errors()->first(),
                ],
                422,
            );
        }

        try {
            $data = 'Rekomendasi hanya untuk bayi umur 6 sampai 59 bulan';
            $umur = $request->umur;
            if ($umur >= 6 and $umur <= 8) {
                $saran = Saran::whereIn('id', [1, 2])->pluck('image');
                $data = $saran;
            } elseif ($umur >= 9 and $umur <= 11) {
                $saran = Saran::whereIn('id', [3, 4])->pluck('image');
                $data = $saran;
            } elseif ($umur >= 12 and $umur <= 23) {
                $saran = Saran::whereIn('id', [5, 6])->pluck('image');
                $data = $saran;
            } elseif ($umur >= 24 and $umur <= 59) {
                $saran = Saran::whereIn('id', [7, 8])->pluck('image');
                $data = $saran;
            }

            Rekomendasi::create([
                'umur' => $request->umur,
                'frekuensi' => $request->frekuensi,
                'berat_badan' => $request->berat_badan,
            ]);

            return response()->json(
                [
                    'data' => $data,
                ],
                200,
            );
        } catch (\Throwable $th) {
            return response()->json([
                'message' => 'Terjadi kesalahan',
            ]);
        }
    }
}
