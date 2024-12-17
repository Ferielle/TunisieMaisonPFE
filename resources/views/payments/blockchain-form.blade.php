@extends('layouts.app')

@section('content')
<div class="container d-flex justify-content-center align-items-center vh-100">
<div class="card shadow-sm p-4" style="max-width: 400px; width: 100%;">
<div class="container">
    <!-- Success or Error Message -->
    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @elseif(session('error'))
        <div class="alert alert-danger">
            {{ session('error') }}
        </div>
    @endif
<h2 class="card-title mb-4 text-center">please put your wallet address and the contract address provided</h2>
<form id="send-ether-form" method="POST" action="{{ route('blockchain.send') }}">
    @csrf

    <div class="form-group">
        <label for="from">Sender Address:</label>
        <input type="text" name="from" id="from" class="form-control" required>
    </div>

    <div class="form-group">
        <label for="contractAddress">Contract Address:</label>
        <input type="text" name="contractAddress" id="contractAddress" class="form-control" required>
    </div>

    <!-- Pass the dynamic amount -->
    <input type="hidden" name="amount" id="amount" value="{{ $dynamicAmount }}">

    <button type="submit" id="pay-bitcoin" class="btn btn-primary">Pay with Bitcoin</button>
</form>
</div>
</div>
<script src="https://cdn.jsdelivr.net/npm/ethers@5.7.0/dist/ethers.umd.min.js"></script>


<script>
import { ethers } from 'ethers';

document.getElementById('pay-bitcoin').addEventListener('click', async () => {
    const amount = document.getElementById('amount').value; // Get the amount from the hidden input field
    const amountToSend = ethers.utils.parseEther(amount); // Convert to Wei

    try {
        if (typeof window.ethereum !== 'undefined') {
            const provider = new ethers.providers.JsonRpcProvider('http://127.0.0.1:7545');
            await provider.send('eth_accounts', []); // Request account access

            const signer = provider.getSigner(); // Get the signer
            const contractAddress = document.getElementById('contractAddress').value; // Get contract address dynamically
            const abi = [
                'function receive() payable',
                'function getBalance() public view returns (uint)',
            ];

            const contract = new ethers.Contract(contractAddress, abi, signer);

            // Sending the transaction
            const tx = await signer.sendTransaction({
                to: contractAddress,
                value: amountToSend, // Send the amount
            });

            // Wait for the transaction to be mined
            await tx.wait();

            alert(`Payment successful! Transaction hash: ${tx.hash}`);
        } else {
            alert('Ethereum provider not found. Please install MetaMask.');
        }
    } catch (error) {
        console.error(error);
        alert('Payment failed. Please try again.');
    }
});




</script>
@endsection
