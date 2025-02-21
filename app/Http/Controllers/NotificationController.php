<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Notification;

class NotificationController extends Controller
{
    public function destroy($id)
    {
        if (!auth()->check()) {
            return redirect()->back()->with('error', 'Anda harus login untuk menghapus notifikasi.');
        }

        $notification = Notification::findOrFail($id);
        
        // Pastikan hanya pemilik yang bisa menghapus
        if ($notification->notifiable_id === auth()->id()) {
            $notification->delete();
            return redirect()->back()->with('success', 'Notifikasi berhasil dihapus.');
        }

        return redirect()->back()->with('error', 'Anda tidak memiliki akses untuk menghapus notifikasi ini.');
    }
 
}