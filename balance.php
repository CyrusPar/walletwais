<?php
// balance.php
function displayBalance($userId) {
    global $usersFacade, $billsFacade; // Assuming these are defined elsewhere

    // Fetch user by userId
    $fetchUserById = $usersFacade->fetchUserById($userId);
    
    // Initialize total expenses and wallet balance
    $totalExpenses = 0;
    $walletBalance = 0;

    // Loop through the user data to extract the user_code and fetch bills
    foreach ($fetchUserById as $user) {
        // Assuming the wallet balance is stored in 'wallet_balance' column for the user
        $walletBalance = (float) $user['wallet'];
        
        // Fetch bills for the user based on user_code
        $fetchBillsByCode = $billsFacade->fetchBillByCode($user['user_code']);
        
        // Loop through the bills and calculate the total expenses
        foreach ($fetchBillsByCode as $bill) {
            $expense = (float) $bill['expense']; // Ensure expense is a number
            $totalExpenses += $expense; // Add expense to total
        }
    }

    // Calculate remaining balance
    $remainingBalance = $walletBalance - $totalExpenses;
    ?>
    <!-- Displaying the total expenses and remaining balance -->
    <div class="balance-section">
        <div style="background-color: white; color: #058240; padding: 20px; border-radius: 10px; margin-top: 20px;">
            <h4>Total Expenses: <strong><?php echo number_format($totalExpenses, 2); ?> Php</strong></h4>
            <h4>Balance: <strong><?php echo number_format($remainingBalance, 2); ?> Php</strong></h4>
        </div>
    </div>
    <?php
}
?>
