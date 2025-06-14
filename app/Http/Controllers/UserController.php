<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Layanan;
use App\Models\Request as RequestModel;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    /**
     * Display the homepage
     */
    public function home()
    {
        return view('user.home');
    }

    /**
     * Display all services
     */
    public function services(Request $request)
    {
        $query = Layanan::query();
        
        // Search functionality
        if ($request->has('search') && !empty($request->search)) {
            $searchTerm = $request->search;
            $query->where(function($q) use ($searchTerm) {
                $q->where('nama_layanan', 'LIKE', '%' . $searchTerm . '%')
                  ->orWhere('deskripsi', 'LIKE', '%' . $searchTerm . '%');
            });
        }
        
        $services = $query->get();
        
        return view('user.services', compact('services'));
    }

    /**
     * Display contact page
     */
    public function contact()
    {
        $services = Layanan::all();
        return view('user.contact', compact('services'));
    }

    /**
     * Handle contact form submission
     */
    public function submitContact(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'layanan_id' => 'nullable|exists:layanan,id',
            'nama' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'telepon' => 'required|string|max:20',
            'perusahaan' => 'nullable|string|max:255',
            'pesan' => 'required|string|max:1000',
        ], [
            'layanan_id.exists' => 'Layanan yang dipilih tidak valid.',
            'nama.required' => 'Nama wajib diisi.',
            'nama.max' => 'Nama tidak boleh lebih dari 255 karakter.',
            'email.required' => 'Email wajib diisi.',
            'email.email' => 'Format email tidak valid.',
            'email.max' => 'Email tidak boleh lebih dari 255 karakter.',
            'telepon.required' => 'Nomor telepon wajib diisi.',
            'telepon.max' => 'Nomor telepon tidak boleh lebih dari 20 karakter.',
            'perusahaan.max' => 'Nama perusahaan tidak boleh lebih dari 255 karakter.',
            'pesan.required' => 'Pesan wajib diisi.',
            'pesan.max' => 'Pesan tidak boleh lebih dari 1000 karakter.',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        try {
            $newRequest = RequestModel::create([
                'layanan_id' => $request->layanan_id,
                'nama' => $request->nama,
                'email' => $request->email,
                'telepon' => $request->telepon,
                'perusahaan' => $request->perusahaan,
                'pesan' => $request->pesan,
                'status' => 'pending',
            ]);

            return redirect()->back()->with([
                'success' => 'Pesan Anda telah berhasil dikirim! Kode pesanan Anda: ' . $newRequest->order_code,
                'order_code' => $newRequest->order_code
            ]);
        } catch (\Exception $e) {
            \Log::error('Contact form submission error: ' . $e->getMessage());
            \Log::error('Stack trace: ' . $e->getTraceAsString());
            return redirect()->back()
                ->with('error', 'Terjadi kesalahan saat mengirim pesan. Error: ' . $e->getMessage())
                ->withInput();
        }
    }

    /**
     * Check order status
     */
    public function checkOrder(Request $request)
    {
        $orderCode = $request->input('order_code');
        $order = null;
        
        if ($orderCode) {
            $order = RequestModel::where('order_code', $orderCode)->with('layanan')->first();
        }
        
        return view('user.check-order', compact('order', 'orderCode'));
    }
}