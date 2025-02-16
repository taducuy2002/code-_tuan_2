<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Jobs\SendEmailJob;

class MailController extends Controller
{
    public function sendMail()
    {
        $email = "example@gmail.com"; // Thay bằng email cần gửi
        dispatch(new SendEmailJob($email));

        return response()->json([
            'success' => true,
            'message' => 'Email sẽ được gửi qua queue!'
        ]);
    }
}
