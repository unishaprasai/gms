<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use App\Models\Payments;
use App\Models\Plans;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Members;
use Illuminate\Support\Facades\Log;




class PaymentController extends Controller
{
    public function verifyPayment(Request $request)
    {
        $token = $request->token;

        $args = http_build_query(array(
            'token' => $token,
            'amount'  => 1000
        ));

        $url = "https://khalti.com/api/v2/payment/verify/";

        # Make the call using API.
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS,$args);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        $secret_key = config('app.khalti_secret_key');

        $headers = ["Authorization: Key $secret_key"];
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);

        // Response
        $response = curl_exec($ch);
        $status_code = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        curl_close($ch);
        return $response;
    }


    public function storePayment(Request $request)
    {
        Log::info('Received payment response', ['response' => $request->response]);
    
        // Convert the JSON string to an associative array
        $response = json_decode($request->response, true);
    
        if (!$response) {
            Log::error('Invalid payment response format');
            return response()->json(['error' => 'Invalid payment response format'], 400);
        }
    
        // Get the authenticated user's email
        $userEmail = auth()->user()->email;
        Log::info('Authenticated user email', ['email' => $userEmail]);
    
        // Fetch the member's details from the members table
        $member = Members::where('email', $userEmail)->first();
        Log::info('Fetched member details', ['member' => $member]);
    
        if (!$member) {
            Log::error('Member not found', ['email' => $userEmail]);
            return response()->json(['error' => 'Member not found'], 404);
        }
    
        // Store payment data in the database
        $payment = new Payments();
        $payment->member_id = $member->id;
        $payment->member_name = $member->name;
        $payment->payment_date = now();
        $payment->amount = $response['amount'] / 100; // converting paisa to rupees
        $payment->status = 'completed'; // You can set the status based on your logic
        $payment->payment_mode = 'Khalti';
        $payment->membership_type = $member->membership_type; // Set the membership type from member details
    
        Log::info('Payment data to be saved', ['payment' => $payment]);
    
        try {
            $payment->save();
            Log::info('Payment stored successfully');
            return response()->json(['message' => 'Payment stored successfully']);
        } catch (\Exception $e) {
            Log::error('Error storing payment', ['error' => $e->getMessage()]);
            return response()->json(['error' => 'Failed to store payment', 'message' => $e->getMessage()], 500);
        }


    }

    public function index()
    {
        // Get the authenticated user's email
        $email = auth()->user()->email;
    
        // Retrieve the user's ID based on their email
        $member = Members::where('email', $email)->first();

        if ($member) {
            // If member exists, retrieve their history based on their ID
            $memberId = $member->id;
            $paymentData = Payments::where('member_id', $memberId)->get();
        } else {
            // Handle case where trainer does not exist
            return null;
        }
    
        return view('frontend.Payments',compact('paymentData'));
    }
    

    public function adminview()
    {
        $plans = Plans::all(); // Fetch all plan from the database    

        $payment = Payments::all(); // Fetch all plan from the database    
        return view('backend.viewpayments',compact('payment','plans'));
    }

    public function store(Request $request)
    {
        // Validate the request data
        $request->validate([
            'memberid' => 'required|string|max:255',
            'membername' => 'required|string|max:255',
            'PaymentDate' => 'required|date|before_or_equal:today',
            'amount' => 'required|numeric|min:0',
            'status' => 'required|string',
            'paymentmode' => 'required|string',
            'membershiptype' => 'required|string',
        ]);

        // Create a new payment record
        $payment = new Payments();
        $payment->member_id = $request->input('memberid');
        $payment->member_name = $request->input('membername');
        $payment->payment_date = $request->input('PaymentDate');
        $payment->amount = $request->input('amount');
        $payment->status = $request->input('status');
        $payment->payment_mode = $request->input('paymentmode');
        $payment->membership_type = $request->input('membershiptype');
        $payment->save();

        // Return a JSON response for AJAX handling
        return response()->json([
            'success' => true,
            'message' => 'Payment added successfully!'
        ]);
    }
    
    
    

    
}