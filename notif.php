<?php
function checkNotifications($userId) {
    date_default_timezone_set('Asia/Manila');
    global $usersFacade, $billsFacade;

    $fetchUserById = $usersFacade->fetchUserById($userId);

    foreach ($fetchUserById as $user) {
        $walletValue = $user['wallet'];
        
        if ($walletValue <= 0) {
            echo '<div class="alert alert-warning">';
            echo '<strong>Notice:</strong> Your wallet balance is zero or invalid. Please update your wallet.';
            echo '</div>';
            return;
        }

        $dailyAllowance = $walletValue / 31;
        $weeklyAllowance = $walletValue / 4;

        $today = new DateTime();
        $todayFormatted = $today->format('Y-m-d');

        $startOfWeek = (clone $today)->modify('Monday this week')->format('Y-m-d');
        $endOfWeek = (clone $today)->modify('Sunday this week')->format('Y-m-d');

        $fetchBillsByCode = $billsFacade->fetchBillByCode($user['user_code']);

        $todayExpenses = 0;
        $weeklyExpenses = 0;

        foreach ($fetchBillsByCode as $bill) {
            $billDate = new DateTime($bill['Date']);
            $billExpense = (float) $bill['expense'];

            if ($billDate->format('Y-m-d') === $todayFormatted) {
                $todayExpenses += $billExpense;
            }

            if ($billDate >= new DateTime($startOfWeek) && $billDate <= new DateTime($endOfWeek)) {
                $weeklyExpenses += $billExpense;
            }
        }

        $dailyExceeded = $todayExpenses > $dailyAllowance;
        $weeklyExceeded = $weeklyExpenses > $weeklyAllowance;

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

if (isset($_GET['userId'])) {
    $userId = intval($_GET['userId']);
    checkNotifications($userId);
}
?>
