<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use App\Services\GanacheService;

class BlockchainController extends Controller
{
    protected $ganacheService;

    public function __construct(GanacheService $ganacheService)
    {
        $this->ganacheService = $ganacheService;
    }

    public function sendEther(Request $request)
    {
        \Log::info($request->all());

        // Validate input data
        $validated = $request->validate([
            'from' => 'required|string', // Ensure 'from' is present and a string
            'contractAddress' => 'required|string', // Ensure contract address is a string
            'amount' => 'required|numeric', // Ensure amount is numeric
        ]);

        // Extract the validated values
        $from = $validated['from'];
        $contractAddress = $validated['contractAddress'];
        $amount = $validated['amount'];

        // Validate Ethereum address format
        if (!preg_match('/^0x[a-fA-F0-9]{40}$/', $from)) {
            return back()->with('error', 'Invalid sender address.');
        }

        if (!is_string($contractAddress) || !preg_match('/^0x[a-fA-F0-9]{40}$/', $contractAddress)) {
            return back()->with('error', 'Invalid contract address.');
        }

        // Check if amount is a valid numeric value
        if (!is_numeric($amount) || $amount <= 0) {
            return back()->with('error', 'Invalid Ether value.');
        }

        // Convert Ether to Wei (smallest unit of Ether)
        $amountInWei = '0x' . dechex((int)($amount * 1e18)); // Multiply by 1e18 to convert Ether to Wei

        try {
            // Call your service to send Ether to the contract
            $result = $this->ganacheService->sendEtherToContract($from, $contractAddress, $amountInWei);

            // Return success response or handle based on your application's need
            return back()->with('success', 'Payment successful! Your transaction has been processed.');


        } catch (\Exception $e) {
            // Log error and return failure message
            \Log::error('Blockchain transaction failed: ' . $e->getMessage());
            return back()->with('error', 'Oops! Something went wrong. Please try again later.');

        }
    }


    public function showBlockchainForm($dynamicAmount)
    {
        return view('payments.blockchain-form', compact('dynamicAmount'));
    }




    // Method to get the balance of a contract
    public function getContractBalance(Request $request)
    {
        $contractAddress = $request->input('contractAddress');

        $balanceInWei = $this->ganacheService->getBalance($contractAddress);
        $balanceInEther = hexdec($balanceInWei) / (10 ** 18); // Convert wei to Ether

        return response()->json(['balance' => $balanceInEther]);
    }
}
