
document.getElementById('pay-bitcoin').addEventListener('click', () => {
    alert('Bitcoin payment initiated!');
});
document.getElementById('pay-bitcoin').addEventListener('click', async () => {
    try {
        // Check if MetaMask or another provider is available
        if (typeof window.ethereum !== 'undefined') {
            const provider = new ethers.providers.JsonRpcProvider('http://127.0.0.1:7545');
            await provider.send('eth_accounts', []); // Request account access

            const signer = provider.getSigner();
            const contractAddress = '0x97cfb4eE39c2432C27b6ed5604efe5D0412e444B';
            const abi = [
                'function receive() payable',
                'function getBalance() public view returns (uint)',
            ];

            const contract = new ethers.Contract(contractAddress, abi, signer);
            const amountToSend = ethers.utils.parseEther("0.2"); // Example: 0.1 ETH

            const tx = await signer.sendTransaction({
                to: contractAddress,
                value: amountToSend,
            });

            alert(`Payment successful! Transaction hash: ${tx.hash}`);
        } else {
            alert('Ethereum provider not found. Please install MetaMask.');
        }
    } catch (error) {
        console.error(error);
        alert('Payment failed. Please try again.');
    }
});
