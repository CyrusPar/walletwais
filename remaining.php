<?php
function remainingBudget($userId) {
    date_default_timezone_set('Asia/Manila');
    global $usersFacade, $billsFacade; // Assuming $usersFacade and $billsFacade are defined elsewhere

    // Fetch the user by userId
    $fetchUserById = $usersFacade->fetchUserById($userId);

    foreach ($fetchUserById as $user) {
        // Get the wallet value and calculate allowances
        $walletValue = $user['wallet'];
        $dailyAllowance = $walletValue / 31;
        $weeklyAllowance = $walletValue / 4;

        // Get today's date and the start of the week
        $today = new DateTime();
        $startOfWeek = (clone $today)->modify('Monday this week')->format('Y-m-d');
        $todayFormatted = $today->format('Y-m-d');

        // Fetch the bills
        $fetchBillsByCode = $billsFacade->fetchBillByCode($user['user_code']);
        $todayExpenses = 0;
        $weeklyExpenses = 0;
        $todayBills = [];

        // Calculate today's expenses and total weekly expenses
        foreach ($fetchBillsByCode as $bill) {
            $billDate = new DateTime($bill['Date']);
            $billExpense = (float) $bill['expense'];

            if ($billDate->format('Y-m-d') == $todayFormatted) {
                $todayExpenses += $billExpense;
                $todayBills[] = $bill;
            }

            if ($billDate >= new DateTime($startOfWeek) && $billDate <= new DateTime($todayFormatted)) {
                $weeklyExpenses += $billExpense;
            }
        }

        // Calculate remaining allowances
        $remainingDailyAllowance = $dailyAllowance - $todayExpenses;
        $remainingWeeklyAllowance = $weeklyAllowance - $weeklyExpenses;

        // Determine colors and warning messages
        $circleColorDaily = $remainingDailyAllowance < 0 ? 'red' : '#058240';
        $circleColorWeekly = $remainingWeeklyAllowance < 0 ? 'red' : '#058240';
        $warningMessageDaily = $remainingDailyAllowance < 0 ? 'Daily expense exceeded!' : '';
        $warningMessageWeekly = $remainingWeeklyAllowance < 0 ? 'Weekly expense exceeded!' : '';

        ?>
        <h2 style="text-align: center; color: #058240; font-size: 28px; font-weight: bold; margin-bottom: 20px; margin-top:20px;">Expense Tracker</h2>

        <!-- Daily Tracker -->
        <div style="display: flex; justify-content: center; align-items: center; flex-direction: column; margin-bottom: 40px;">
            <h3 style="color: #058240; text-align: center; font-size: 24px; font-weight: bold; margin-bottom: 20px;">Daily Tracker</h3>

            <div style="width: 180px; height: 180px; border-radius: 50%; background-color: <?php echo $circleColorDaily; ?>; color: white; display: flex; justify-content: center; align-items: center; flex-direction: column; font-size: 20px; font-weight: bold; box-shadow: 0 5px 15px rgba(0, 0, 0, 0.2); margin-bottom: 10px; animation: moveUpDown 2s infinite;">
                <div><?php echo number_format($remainingDailyAllowance, 2); ?> Php</div>
                <div style="font-size: 14px; font-weight: normal;">Daily Allowance</div>
            </div>

            <?php if ($warningMessageDaily): ?>
                <div style="text-align: center; color: red; font-size: 16px; font-weight: bold;"><?php echo $warningMessageDaily; ?></div>
            <?php endif; ?>
        </div>

        <!-- Weekly Tracker -->
        <div style="display: flex; justify-content: center; align-items: center; flex-direction: column; margin-bottom: 40px;">
            <h3 style="color: #058240; text-align: center; font-size: 24px; font-weight: bold; margin-bottom: 20px;">Weekly Tracker</h3>

            <div style="width: 180px; height: 180px; border-radius: 50%; background-color: <?php echo $circleColorWeekly; ?>; color: white; display: flex; justify-content: center; align-items: center; flex-direction: column; font-size: 20px; font-weight: bold; box-shadow: 0 5px 15px rgba(0, 0, 0, 0.2); margin-bottom: 10px; animation: moveUpDown 2s infinite;">
                <div><?php echo number_format($remainingWeeklyAllowance, 2); ?> Php</div>
                <div style="font-size: 14px; font-weight: normal;">Weekly Allowance</div>
            </div>

            <?php if ($warningMessageWeekly): ?>
                <div style="text-align: center; color: red; font-size: 16px; font-weight: bold;"><?php echo $warningMessageWeekly; ?></div>
            <?php endif; ?>
        </div>

        <!-- Bills for Today -->
        <?php if (!empty($todayBills)): ?>
            <div style="background-color: #e0f9e0; padding: 20px; border-radius: 10px; box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);">
                <h3 style="color: #058240;">Bills for Today:</h3>
                <table style="width: 100%; border-collapse: collapse; color: #058240; margin-top: 10px;">
                    <thead>
                        <tr style="background-color: #d9f1e4; text-align: center;">
                            <th style="padding: 10px; border: 1px solid #058240;">Bill Name</th>
                            <th style="padding: 10px; border: 1px solid #058240;">Expense</th>
                            <th style="padding: 10px; border: 1px solid #058240;">Date</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($todayBills as $bill): ?>
                            <tr>
                                <td style="padding: 10px; border: 1px solid #058240; text-align: center;"><?php echo htmlspecialchars($bill['bill_name']); ?></td>
                                <td style="padding: 10px; border: 1px solid #058240; text-align: center;"><?php echo number_format($bill['expense'], 2); ?> Php</td>
                                <td style="padding: 10px; border: 1px solid #058240; text-align: center;"><?php echo htmlspecialchars($bill['Date']); ?></td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>

                <div style="margin-top: 20px; text-align: center;">
                    <h3 style="font-size: 20px; font-weight: bold; color: #058240;">Total Expense: </h3>
                    <div style="font-size: 24px; font-weight: bold; color: <?php echo $todayExpenses > $dailyAllowance ? 'red' : '#058240'; ?>;">
                        <?php echo number_format($todayExpenses, 2); ?> Php
                    </div>
                </div>
            </div>
        <?php else: ?>
            <div style="color: #058240; font-size: 18px; text-align: center;">No bills found for today.</div>
        <?php endif; ?>
    <?php }
}

?>

<style>
@keyframes moveUpDown {
    0% {
        transform: translateY(0);
    }
    50% {
        transform: translateY(-10px);
    }
    100% {
        transform: translateY(0);
    }
}
</style>
