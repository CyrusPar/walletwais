<?php
function displayBalance($userId) {
    global $usersFacade, $billsFacade;

    $fetchUserById = $usersFacade->fetchUserById($userId);
    
    $totalExpenses = 0;
    $walletBalance = 0;

    foreach ($fetchUserById as $user) {
        $walletBalance = (float) $user['wallet'];
        
        $fetchBillsByCode = $billsFacade->fetchBillByCode($user['user_code']);
        
        foreach ($fetchBillsByCode as $bill) {
            $expense = (float) $bill['expense'];
            $totalExpenses += $expense;
        }
    }

    $remainingBalance = $walletBalance - $totalExpenses;
    ?>
    <div class="balance-section">
        <div style="background-color: white; color: #058240; padding: 20px; border-radius: 10px; margin-top: 20px;">
            <h4>Total Expenses: <strong><?php echo number_format($totalExpenses, 2); ?> Php</strong></h4>
            <h4>Balance: <strong><?php echo number_format($remainingBalance, 2); ?> Php</strong></h4>
        </div>
    </div>
    <?php
}
?>
