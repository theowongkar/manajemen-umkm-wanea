<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\UrbanVillage;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class UrbanVillageController extends Controller
{
    public function index(Request $request)
    {
        // Validasi Search Form
        $validated = $request->validate([
            'start_date' => 'nullable|date',
            'end_date' => 'nullable|date|after_or_equal:start_date',
            'search' => 'nullable|string|min:1',
        ]);

        // Ambil Nilai
        $start_date = $validated['start_date'] ?? null;
        $end_date = $validated['end_date'] ?? null;
        $search = $validated['search'] ?? null;

        // Ambil Semua Kelurahan
        $urbanVillages = UrbanVillage::when($search, function ($query, $search) {
            return $query->where('name', 'LIKE', "%{$search}%");
        })
            ->when($start_date, function ($query) use ($start_date) {
                return $query->whereDate('created_at', '>=', $start_date);
            })
            ->when($end_date, function ($query) use ($end_date) {
                return $query->whereDate('created_at', '<=', $end_date);
            })
            ->orderBy('name', 'ASC')
            ->paginate(20);

        return view('dashboard.urban-villages.index', compact('urbanVillages'));
    }

    public function store(Request $request)
    {
        // Validasi Input
        $validated = $request->validate([
            'name' => 'required|string|max:255|unique:urban_villages,name',
        ]);

        // Simpan Kelurahan
        UrbanVillage::create($validated);

        return redirect()->route('dashboard.urban-village.index')->with('success', 'Kelurahan berhasil ditambahkan.');
    }

    public function update(Request $request, string $slug)
    {
        // Cari kelurahan berdasarkan slug
        $urbanVillage = UrbanVillage::where('slug', $slug)->firstOrFail();

        // Validasi input
        $validated = $request->validate([
            'name' => [
                'required',
                'string',
                'max:255',
                Rule::unique('urban_villages', 'name')->ignore($urbanVillage->id),
            ],
        ]);

        // Update Kelurahan
        $urbanVillage->update($validated);

        return redirect()->route('dashboard.urban-village.index')->with('success', 'Kelurahan berhasil diperbarui.');
    }

    public function destroy(string $slug)
    {
        // Ambil kelurahan berdasarkan slug
        $urbanVillage = UrbanVillage::where('slug', $slug)->firstOrFail();

        // Hapus Kelurahan
        $urbanVillage->delete();

        return redirect()->route('dashboard.urban-village.index')->with('success', 'Kelurahan berhasil dihapus.');
    }
}
