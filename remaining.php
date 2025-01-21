<?php
function remainingBudget($userId) {
    date_default_timezone_set('Asia/Manila');
    global $usersFacade, $billsFacade; // Assuming $usersFacade and $billsFacade are defined elsewhere

    // Fetch the user by userId
    $fetchUserById = $usersFacade->fetchUserById($userId);

    foreach ($fetchUserById as $user) {
        // Get the wallet value and calculate daily allowance
        $walletValue = $user['wallet'];
        $dailyAllowance = $walletValue / 31;
        $weeklyAllowance = $walletValue / 4; // Weekly allowance

        // Get today's date
        $today = new DateTime();
        $todayFormatted = $today->format('Y-m-d');

        // Fetch the bills for today
        $fetchBillsByCode = $billsFacade->fetchBillByCode($user['user_code']);
        
        $todayExpenses = 0;
        $todayBills = [];

        // Loop through bills and sum the expenses for today
        foreach ($fetchBillsByCode as $bill) {
            $billDate = new DateTime($bill['Date']);
            if ($billDate->format('Y-m-d') == $todayFormatted) {
                $todayExpenses += (float) $bill['expense'];
                $todayBills[] = $bill;
            }
        }

        // Subtract today's expenses from the daily allowance
        $remainingDailyAllowance = $dailyAllowance - $todayExpenses;
        $remainingWeeklyAllowance = $weeklyAllowance - $todayExpenses; // Weekly allowance remaining

        // Set color and message for daily allowance
        $circleColorDaily = $remainingDailyAllowance < 0 ? 'red' : '#058240';
        $warningMessageDaily = $remainingDailyAllowance < 0 ? 'Daily expense exceeded' : '';

        // Set color and message for weekly allowance
        $circleColorWeekly = $remainingWeeklyAllowance < 0 ? 'red' : '#058240';
        $warningMessageWeekly = $remainingWeeklyAllowance < 0 ? 'Weekly expense exceeded' : '';

        // Display the green circle with the remaining daily allowance
        echo '<div style="display: flex; justify-content: center; align-items: center; flex-direction: column; margin-bottom: 30px;">';
        
        // Header for daily allowance circle
        echo '<h3 style="color: #058240; text-align: center; font-size: 24px; font-weight: bold;">Remaining Daily Allowance</h3>';

        // Container for the daily circle with shadow
        echo '<div style="display: flex; justify-content: center; align-items: center; margin-bottom: 20px; box-shadow: 0 5px 20px rgba(0, 0, 0, 0.15); border-radius: 10px; padding: 20px; background-color: #f9f9f9;">';
        
        // Daily allowance circle with shadow effect
        echo '<div style="width: 150px; height: 150px; border-radius: 50%; background-color: ' . $circleColorDaily . '; color: white; display: flex; justify-content: center; align-items: center; font-size: 24px; font-weight: bold; transition: background-color 0.3s; box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);">';
        echo number_format($remainingDailyAllowance, 2) . ' Php';
        echo '</div>';
        
        echo '</div>';
        echo '</div>';

        // Display warning if the expenses exceed the daily allowance
        if ($warningMessageDaily) {
            echo '<div style="text-align: center; color: red; font-size: 18px; font-weight: bold; margin-bottom: 20px;">';
            echo $warningMessageDaily;
            echo '</div>';
        }

        // Display the weekly allowance circle
        echo '<div style="display: flex; justify-content: center; align-items: center; flex-direction: column; margin-bottom: 30px;">';
        
        // Header for weekly allowance circle
        echo '<h3 style="color: #058240; text-align: center; font-size: 24px; font-weight: bold;">Remaining Weekly Allowance</h3>';

        // Container for the weekly circle with shadow
        echo '<div style="display: flex; justify-content: center; align-items: center; margin-bottom: 20px; box-shadow: 0 5px 20px rgba(0, 0, 0, 0.15); border-radius: 10px; padding: 20px; background-color: #f9f9f9;">';
        
        // Weekly allowance circle with shadow effect
        echo '<div style="width: 150px; height: 150px; border-radius: 50%; background-color: ' . $circleColorWeekly . '; color: white; display: flex; justify-content: center; align-items: center; font-size: 24px; font-weight: bold; transition: background-color 0.3s; box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);">';
        echo number_format($remainingWeeklyAllowance, 2) . ' Php';
        echo '</div>';
        
        echo '</div>';
        echo '</div>';

        // Display warning if the expenses exceed the weekly allowance
        if ($warningMessageWeekly) {
            echo '<div style="text-align: center; color: red; font-size: 18px; font-weight: bold; margin-bottom: 20px;">';
            echo $warningMessageWeekly;
            echo '</div>';
        }

        // Display the bills for today in a table
        if (!empty($todayBills)) {
            echo '<div style="background-color: #e0f9e0; padding: 20px; border-radius: 10px; box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);">';
            echo "<h3 style='color: #058240;'>Bills for Today:</h3>";
            echo '<table style="width: 100%; border-collapse: collapse; color: #058240; margin-top: 10px;">';
            echo '<thead>';
            echo '<tr style="background-color: #d9f1e4; text-align: center;">';
            echo '<th style="padding: 10px; border: 1px solid #058240;">Bill Name</th>';
            echo '<th style="padding: 10px; border: 1px solid #058240;">Expense</th>';
            echo '<th style="padding: 10px; border: 1px solid #058240;">Date</th>';
            echo '</tr>';
            echo '</thead>';
            echo '<tbody>';
            foreach ($todayBills as $bill) {
                echo '<tr>';
                echo '<td style="padding: 10px; border: 1px solid #058240; text-align: center;">' . htmlspecialchars($bill['bill_name']) . '</td>';
                echo '<td style="padding: 10px; border: 1px solid #058240; text-align: center;">' . number_format($bill['expense'], 2) . ' Php</td>';
                echo '<td style="padding: 10px; border: 1px solid #058240; text-align: center;">' . htmlspecialchars($bill['Date']) . '</td>';
                echo '</tr>';
            }
            echo '</tbody>';
            echo '</table>';

            // Add total expense for today below the table
            $totalExpenseColor = $todayExpenses > $dailyAllowance ? 'red' : '#058240';
            echo '<div style="margin-top: 20px; text-align: center;">';
            echo '<h3 style="font-size: 20px; font-weight: bold; color: #058240;">Total Expense: </h3>';

            echo '<div style="font-size: 24px; font-weight: bold; color: ' . $totalExpenseColor . ';">';
            echo number_format($todayExpenses, 2) . ' Php';
            echo '</div>';
            echo '</div>';
            
            echo '</div>'; // Close the container for bills
        } else {
            echo "<div style='color: #058240; font-size: 18px;'>No bills found for today.</div>";
        }
    }
}
?>
