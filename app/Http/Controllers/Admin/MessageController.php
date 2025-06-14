<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request as HttpRequest;
use App\Models\Request;

class MessageController extends Controller
{
    /**
     * Display incoming messages
     */
    public function index()
    {
        $requests = Request::with('layanan')->orderBy('created_at', 'desc')->get();
        return view('admin.pesan.order', compact('requests'));
    }

    /**
     * Update request status
     */
    public function updateStatus(HttpRequest $httpRequest, $id)
    {
        $request = Request::findOrFail($id);
        
        $httpRequest->validate([
            'status' => 'required|in:pending,requested,approved,rejected'
        ]);
        
        $request->update([
            'status' => $httpRequest->status
        ]);
        
        return redirect()->back()->with('success', 'Status berhasil diupdate!');
    }

    /**
     * Delete request
     */
    public function destroy($id)
    {
        $request = Request::findOrFail($id);
        $request->delete();
        
        return redirect()->back()->with('success', 'Pesan berhasil dihapus!');
    }
}