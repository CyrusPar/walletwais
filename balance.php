<?php
// balance.php
function displayBalance($userId) {
    global $usersFacade, $billsFacade; // Assuming these are defined elsewhere

    // Fetch user by userId
    $fetchUserById = $usersFacade->fetchUserById($userId);
    
    // Initialize total expenses and wallet balance
    $totalExpenses = 0;
    $walletBalance = 0;
    
    echo "<div class='balance-section'>";
    echo "<h3>Hello Green, your User ID is: " . htmlspecialchars($userId) . "</h3>";
    
    // Loop through the user data to extract the user_code and fetch bills
    foreach ($fetchUserById as $user) {
        // Assuming the wallet balance is stored in 'wallet_balance' column for the user
        $walletBalance = (float) $user['wallet'];
        echo "<h4>User Email: " . htmlspecialchars($user['email']) . "</h4>";
        
        // Fetch bills for the user based on user_code
        $fetchBillsByCode = $billsFacade->fetchBillByCode($user['user_code']);
        
        if (!empty($fetchBillsByCode)) {
            echo "<h4>Bills for User: " . htmlspecialchars($user['email']) . "</h4>";
            echo "<ul>";
            
            // Loop through the bills and calculate the total expenses
            foreach ($fetchBillsByCode as $bill) {
                $expense = (float) $bill['expense']; // Ensure expense is a number
                $totalExpenses += $expense; // Add expense to total
                
                // Display each bill
                echo "<li><strong>" . htmlspecialchars($bill['bill_name']) . "</strong>: " 
                     . htmlspecialchars($bill['expense']) . " - Date: " 
                     . htmlspecialchars($bill['Date']) . "</li>";
            }
            echo "</ul>";
        } else {
            echo "<p>No bills found for this user.</p>";
        }
    }

    // Calculate remaining balance
    $remainingBalance = $walletBalance - $totalExpenses;

    // Display the total expenses and remaining balance
    echo "<div style='background-color: white; color: #058240; padding: 20px; border-radius: 10px; margin-top: 20px;'>";
    echo "<h4>Total Expenses: " . number_format($totalExpenses, 2) . "</h4>";
    echo "<h4>Remaining Balance: " . number_format($remainingBalance, 2) . "</h4>";
    echo "</div>";
    
    echo "</div>";
}
?>
