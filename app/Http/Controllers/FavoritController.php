<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Favorit;
use Illuminate\Support\Facades\Auth;

class FavoritController extends Controller
{
    public function toggle(Request $request)
    {
        $user   = Auth::user();
        $idBuku = $request->id_buku;

        $existing = Favorit::where('user_id', $user->id)
                            ->where('id_buku', $idBuku)
                            ->first();

        if ($existing) {
            $existing->delete();
            $status = 'removed';
        } else {
            Favorit::create([
                'user_id' => $user->id,
                'id_buku' => $idBuku,
            ]);
            $status = 'added';
        }

        return response()->json(['status' => $status]);
    }
}