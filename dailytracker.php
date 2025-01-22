<?php
function dailyTracker($userId, $startDate = null, $endDate = null) {
    global $usersFacade, $billsFacade;

    if (!$startDate || !$endDate) {
        $currentDate = new DateTime();
        $currentDate->modify('this week');
        $startDate = $currentDate->format('Y-m-d');
        $endDate = (new DateTime($startDate))->modify('Sunday this week')->format('Y-m-d');
    }

    $fetchUserById = $usersFacade->fetchUserById($userId);

    $daysOfWeek = ['Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday', 'Sunday'];
    $weeklyExpenses = array_fill(0, 7, 0);

    foreach ($fetchUserById as $user) {
        $weeklyAllowance = $user['wallet'] / 4;
        $fetchBillsByCode = $billsFacade->fetchBillByCode($user['user_code']);
        ?>
        <div style="text-align: left; margin-top: 20px;">
            <button id="showDetailsBtn" onclick="toggleDetails()" style="background-color: #058240; color: white; padding: 10px 20px; border: none; border-radius: 5px;">
                Todays Week Tracker
            </button>
        </div>

        <div id="bills" style="display:none; margin-top: 10px;">
            <h3 style="color: #058240;">Bills (From <?= $startDate ?> to <?= $endDate ?>):</h3>
            <?php if (!empty($fetchBillsByCode)) { ?>
                <table style="width: 100%; border-collapse: collapse; color: #058240; margin-top: 10px;">
                    <thead>
                        <tr style="background-color: #d9f1e4; text-align: center;">
                            <th style="padding: 10px; border: 1px solid #058240;">Bill Name</th>
                            <th style="padding: 10px; border: 1px solid #058240;">Expense</th>
                            <th style="padding: 10px; border: 1px solid #058240;">Date</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($fetchBillsByCode as $bill) { 
                            $expense = (float) $bill['expense'];
                            $billDate = new DateTime($bill['Date']);
                            if ($billDate >= new DateTime($startDate) && $billDate <= new DateTime($endDate)) {
                                $dayOfWeek = $billDate->format('N') - 1;
                                $weeklyExpenses[$dayOfWeek] += $expense;
                                ?>
                                <tr>
                                    <td style="padding: 10px; border: 1px solid #058240;"><?= htmlspecialchars($bill['bill_name']) ?></td>
                                    <td style="padding: 10px; border: 1px solid #058240; text-align: center;"><?= number_format($expense, 2) ?> Php</td>
                                    <td style="padding: 10px; border: 1px solid #058240; text-align: center;"><?= htmlspecialchars($bill['Date']) ?></td>
                                </tr>
                                <?php
                            }
                        } ?>
                    </tbody>
                </table>

                <?php 
                $totalWeeklyExpense = array_sum($weeklyExpenses);
                $weeklyExpenseColor = $totalWeeklyExpense > $weeklyAllowance ? 'red' : '#058240'; 
                ?>
                <div style="margin-top: 20px; text-align: center;">
                    <h3 style="font-size: 20px; font-weight: bold; color: #058240;">Total Weekly Expense:</h3>
                    <div style="font-size: 24px; font-weight: bold; color: <?= $weeklyExpenseColor; ?>;">
                        <?= number_format($totalWeeklyExpense, 2); ?> Php
                    </div>
                </div>

                <canvas id="billChart" width="400" height="200" style="margin-top: 20px;"></canvas>
            <?php } else { ?>
                <p style="color: #058240;">No bills found for this user within the selected week.</p>
            <?php } ?>
        </div>

        <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
        <script>
            function toggleDetails() {
                var billsElement = document.getElementById('bills');
                billsElement.style.display = (billsElement.style.display === "none" || billsElement.style.display === "") 
                    ? "block" 
                    : "none";
            }

            var ctx = document.getElementById('billChart').getContext('2d');
            var billChart = new Chart(ctx, {
                type: 'bar',
                data: {
                    labels: <?php echo json_encode($daysOfWeek); ?>,
                    datasets: [{
                        label: 'Bill Expenses (by Day)',
                        data: <?php echo json_encode($weeklyExpenses); ?>,
                        backgroundColor: 'rgba(5, 130, 64, 0.5)',
                        borderColor: 'rgba(5, 130, 64, 1)',
                        borderWidth: 1
                    }]
                },
                options: {
                    responsive: true,
                    scales: {
                        y: {
                            beginAtZero: true
                        }
                    }
                }
            });
        </script>
        <?php
    }
}

if (isset($_GET['selectedDate'])) {
    $selectedDate = $_GET['selectedDate'];
    list($startDate, $endDate) = getWeekStartEndDates($selectedDate);
    dailyTracker($userId, $startDate, $endDate);
}
?>
