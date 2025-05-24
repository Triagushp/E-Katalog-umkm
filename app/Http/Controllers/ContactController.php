<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Mail\ContactEmail;

class ContactController extends Controller
{
    public function contactpage()
{

    return view('contact');
}
 public function sendEmail(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email',
            'subject' => 'required|string|max:255',
            'message' => 'required|string',
        ]);

        $data = [
            'name' => $request->name,
            'email' => $request->email,
            'subject' => $request->subject,
            'message' => $request->message
        ];

        try {
            Mail::to('sikabobws@gmail.com')->send(new ContactEmail($data));
            return back()->with('status', 'Pesan berhasil dikirim!');
        } catch (\Exception $e) {
            return back()->with('error', 'Gagal mengirim pesan: ' . $e->getMessage());
        }
    }
}
