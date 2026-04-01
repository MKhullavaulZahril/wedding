<?php

namespace App\Http\Controllers;

use App\Models\Promo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class PromoController extends Controller
{
    public function index()
    {
        $promos = Promo::latest()->get();
        return response()->json(['success' => true, 'data' => $promos]);
    }

    public function store(Request $request)
    {
        try {
            $data = $request->json()->all();
            $code = strtoupper(trim($data['code'] ?? ''));

            if (empty($code) || empty($data['reward_value'])) {
                return response()->json(['success' => false, 'message' => 'Kode dan nilai diskon wajib diisi'], 422);
            }

            if (Promo::where('code', $code)->exists()) {
                return response()->json(['success' => false, 'message' => "Kode promo \"$code\" sudah digunakan"], 422);
            }

            $promo = Promo::create([
                'code'         => $code,
                'type'         => in_array($data['type'] ?? '', ['percentage', 'fixed']) ? $data['type'] : 'percentage',
                'reward_value' => (float) $data['reward_value'],
                'usage_limit'  => isset($data['usage_limit']) && $data['usage_limit'] !== '' ? (int) $data['usage_limit'] : null,
                'expires_at'   => isset($data['expires_at']) && $data['expires_at'] !== '' ? $data['expires_at'] : null,
                'is_active'    => (bool) ($data['is_active'] ?? true),
            ]);

            return response()->json(['success' => true, 'promo' => $promo]);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'message' => $e->getMessage()], 500);
        }
    }

    public function update(Request $request, $id)
    {
        try {
            $promo = Promo::findOrFail($id);
            $data  = $request->json()->all();
            $code  = strtoupper(trim($data['code'] ?? ''));

            if (Promo::where('code', $code)->where('id', '!=', $id)->exists()) {
                return response()->json(['success' => false, 'message' => "Kode promo \"$code\" sudah digunakan"], 422);
            }

            $promo->update([
                'code'         => $code ?: $promo->code,
                'type'         => in_array($data['type'] ?? '', ['percentage', 'fixed']) ? $data['type'] : $promo->type,
                'reward_value' => isset($data['reward_value']) ? (float) $data['reward_value'] : $promo->reward_value,
                'usage_limit'  => isset($data['usage_limit']) && $data['usage_limit'] !== '' && $data['usage_limit'] !== null ? (int) $data['usage_limit'] : null,
                'expires_at'   => isset($data['expires_at']) && $data['expires_at'] !== '' ? $data['expires_at'] : null,
                'is_active'    => (bool) ($data['is_active'] ?? $promo->is_active),
            ]);

            return response()->json(['success' => true, 'promo' => $promo->fresh()]);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'message' => $e->getMessage()], 500);
        }
    }

    public function destroy($id)
    {
        try {
            Promo::findOrFail($id)->delete();
            return response()->json(['success' => true]);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'message' => $e->getMessage()], 500);
        }
    }

    public function toggleActive($id)
    {
        try {
            $promo = Promo::findOrFail($id);
            $promo->is_active = !$promo->is_active;
            $promo->save();
            return response()->json(['success' => true, 'is_active' => $promo->is_active]);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'message' => $e->getMessage()], 500);
        }
    }

    public function validatePromo(Request $request)
    {
        $code  = strtoupper(trim($request->input('code', '')));
        $promo = Promo::where('code', $code)->where('is_active', true)->first();

        if (!$promo) {
            return response()->json(['valid' => false, 'message' => 'Kode promo tidak valid atau sudah tidak aktif']);
        }
        if ($promo->expires_at && $promo->expires_at->endOfDay()->isPast()) {
            return response()->json(['valid' => false, 'message' => 'Kode promo sudah kadaluarsa']);
        }
        if ($promo->usage_limit !== null && $promo->usage_count >= $promo->usage_limit) {
            return response()->json(['valid' => false, 'message' => 'Kode promo sudah mencapai batas pemakaian']);
        }

        return response()->json([
            'valid'        => true,
            'type'         => $promo->type,
            'reward_value' => $promo->reward_value,
            'message'      => 'Promo aktif! Diskon ' . ($promo->type === 'percentage' ? $promo->reward_value . '%' : 'Rp ' . number_format($promo->reward_value, 0, ',', '.')),
        ]);
    }
}
