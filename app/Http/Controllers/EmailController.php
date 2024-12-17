<?php
namespace App\Http\Controllers;

use App\Mail\WelcomeEmail;
use Illuminate\Support\Facades\Mail;
use Illuminate\Http\Request;

class EmailController extends Controller
{
    public function sendWelcomeEmail(Request $request)
{
    $request->validate([
        'email' => 'required|email',
        'name' => 'required|string',
    ]);

    $recipientEmail = $request->email;
    $name = $request->name;

    Mail::send(new WelcomeEmail($name, $recipientEmail)); // Pass both name and email

    return response()->json([
        'message' => 'Welcome email sent successfully!',
        'email' => $recipientEmail,
    ]);
}





public function testEmail()
    {
        // Testing email functionality
        Mail::raw('This is a test email', function ($message) {
            $message->to('test@example.com') // Replace with your email for testing
                    ->subject('Test Email');
        });

        return response()->json(['message' => 'Test email sent successfully!']);

}
}
