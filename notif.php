<?php
// notif.php
function checkNotifications($userId) {
    date_default_timezone_set('Asia/Manila');
    global $usersFacade, $billsFacade; // Assuming $usersFacade and $billsFacade are defined elsewhere

    // Fetch the user by userId
    $fetchUserById = $usersFacade->fetchUserById($userId);

    foreach ($fetchUserById as $user) {
        // Get the latest wallet value
        $walletValue = $user['wallet'];
        
        // Skip further computation if wallet value is invalid or not set
        if ($walletValue <= 0) {
            echo '<div class="alert alert-warning">';
            echo '<strong>Notice:</strong> Your wallet balance is zero or invalid. Please update your wallet.';
            echo '</div>';
            return;
        }

        // Recompute daily and weekly allowances
        $dailyAllowance = $walletValue / 31;
        $weeklyAllowance = $walletValue / 4;

        // Get today's date
        $today = new DateTime();
        $todayFormatted = $today->format('Y-m-d');

        // Calculate start and end of the week (Monday to Sunday)
        $startOfWeek = (clone $today)->modify('Monday this week')->format('Y-m-d');
        $endOfWeek = (clone $today)->modify('Sunday this week')->format('Y-m-d');

        // Fetch bills for today and the current week
        $fetchBillsByCode = $billsFacade->fetchBillByCode($user['user_code']);

        $todayExpenses = 0;
        $weeklyExpenses = 0;

        foreach ($fetchBillsByCode as $bill) {
            $billDate = new DateTime($bill['Date']);
            $billExpense = (float) $bill['expense'];

            // Check if the bill is for today
            if ($billDate->format('Y-m-d') === $todayFormatted) {
                $todayExpenses += $billExpense;
            }

            // Check if the bill falls within the current week
            if ($billDate >= new DateTime($startOfWeek) && $billDate <= new DateTime($endOfWeek)) {
                $weeklyExpenses += $billExpense;
            }
        }

        // Check if daily or weekly expenses exceeded their respective allowances
        $dailyExceeded = $todayExpenses > $dailyAllowance;
        $weeklyExceeded = $weeklyExpenses > $weeklyAllowance;

        // Display alerts based on the computed values
        if ($dailyExceeded) {
            echo '<div class="alert alert-danger" style="margin-bottom: 15px;">';
            echo '<strong>Daily Expense Exceeded:</strong> You have exceeded your daily allowance of ' 
                 . number_format($dailyAllowance, 2) . ' Php. Current Expense: ' 
                 . number_format($todayExpenses, 2) . ' Php.';
            echo '</div>';
        }

        if ($weeklyExceeded) {
            echo '<div class="alert alert-danger">';
            echo '<strong>Weekly Expense Exceeded:</strong> You have exceeded your weekly allowance of ' 
                 . number_format($weeklyAllowance, 2) . ' Php. Current Expense: ' 
                 . number_format($weeklyExpenses, 2) . ' Php.';
            echo '</div>';
        }

    }
}

// Example usage (assuming $userId is passed to this file)
if (isset($_GET['userId'])) {
    $userId = intval($_GET['userId']);
    checkNotifications($userId);
}
?>
