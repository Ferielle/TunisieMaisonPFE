// contracts/SimpleWallet.sol
pragma solidity ^0.8.0;

contract SimpleWallet {
    uint public totalReceived;

    // Receive function to accept Ether
    receive() external payable {
        totalReceived += msg.value; // Track total received Ether
    }

    // Function to check contract balance
    function getBalance() public view returns (uint) {
        return address(this).balance;
    }
}
