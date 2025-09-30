<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Business;
use App\Models\UrbanVillage;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;

class BusinessController extends Controller
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

        // Ambil Semua UMKM
        $businesses = Business::with('urbanVillage')
            ->when($search, function ($query, $search) {
                return $query->where(function ($query) use ($search) {
                    $query->where('owner_name', 'LIKE', "%{$search}%")
                        ->orWhere('product_name', 'LIKE', "%{$search}%");
                });
            })
            ->when($start_date, function ($query) use ($start_date) {
                return $query->whereDate('created_at', '>=', $start_date);
            })
            ->when($end_date, function ($query) use ($end_date) {
                return $query->whereDate('created_at', '<=', $end_date);
            })
            ->orderBy('created_at', 'DESC')
            ->paginate(20);

        // Ambil Kelurahan
        $urbanVillages = UrbanVillage::orderBy('name')->get();

        return view('dashboard.businesses.index', compact('businesses', 'urbanVillages'));
    }

    public function exportPdf()
    {
        // Ambil semua UMKM
        $businesses = Business::with('urbanVillage')->orderBy('created_at', 'DESC')->get();

        // Generate PDF
        $pdf = Pdf::loadView('dashboard.businesses.pdf', compact('businesses'));

        // Stream PDF ke browser (bukan langsung download)
        return $pdf->stream('umkm-' . now()->format('Y-m-d_H-i') . '.pdf');
    }

    public function store(Request $request)
    {
        // Validasi input
        $validated = $request->validate([
            'urban_village_id' => 'required|exists:urban_villages,id',
            'product_name' => 'required|string|max:255',
            'owner_name' => 'required|string|max:255',
            'owner_phone' => 'required|string|max:20',
            'address' => 'required|string|max:500',
            'status' => 'required|in:Aktif,Tidak Aktif',
        ]);

        // Simpan data UMKM
        Business::create($validated);

        return redirect()->route('dashboard.business.index')->with('success', 'UMKM berhasil ditambahkan.');
    }

    public function update(Request $request, string $id)
    {
        // Ambil UMKM berdasarkan ID
        $business = Business::findOrFail($id);

        // Validasi input
        $validated = $request->validate([
            'urban_village_id' => 'required|exists:urban_villages,id',
            'product_name' => 'required|string|max:255',
            'owner_name' => 'required|string|max:255',
            'owner_phone' => 'required|string|max:20',
            'address' => 'required|string|max:500',
            'status' => 'required|in:Aktif,Tidak Aktif',
        ]);

        // Update data UMKM
        $business->update($validated);

        return redirect()->route('dashboard.business.index')->with('success', 'UMKM berhasil diperbarui.');
    }

    public function destroy(string $id)
    {
        // Ambil UMKM berdasarkan ID
        $business = Business::findOrFail($id);

        // Hapus UMKM
        $business->delete();

        return redirect()->route('dashboard.business.index')->with('success', 'UMKM berhasil dihapus.');
    }
}
