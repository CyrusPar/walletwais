<?php
// Function to calculate the start and end date of the week for a given date
function getWeekStartEndDates($date) {
    $dt = new DateTime($date);
    $dt->modify('Monday this week'); // Start of the week (Monday)
    $startDate = $dt->format('Y-m-d'); // Start of the week in 'Y-m-d' format

    $dt->modify('Sunday this week'); // End of the week (Sunday)
    $endDate = $dt->format('Y-m-d'); // End of the week in 'Y-m-d' format

    return [$startDate, $endDate];
}

function dailyTracker($userId, $startDate = null, $endDate = null) {
    global $usersFacade, $billsFacade; // Assuming $usersFacade and $billsFacade are defined elsewhere

    // If no specific week is provided, calculate the start and end of the current week
    if (!$startDate || !$endDate) {
        $currentDate = new DateTime();
        $currentDate->modify('this week'); // Get the start of the current week (Monday)
        $startDate = $currentDate->format('Y-m-d');
        $endDate = (new DateTime($startDate))->modify('Sunday this week')->format('Y-m-d');
    }

    // Fetch the user by userId
    $fetchUserById = $usersFacade->fetchUserById($userId);

    // Initialize arrays for the bill names, expenses, and days of the week
    $billNames = [];
    $expenses = [];
    $daysOfWeek = ['Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday', 'Sunday'];
    $weeklyExpenses = array_fill(0, 7, 0);  // Initialize array to hold expenses for each day of the week

    foreach ($fetchUserById as $user) {
        // Fetch bills using the user_code from the fetched user data
        $fetchBillsByCode = $billsFacade->fetchBillByCode($user['user_code']); // Pass the user_code here

        // Display the button to show the details
        ?>
        <div style="text-align: left; margin-top: 20px;">
            <button id="showDetailsBtn" onclick="toggleDetails()" style="background-color: #058240; color: white; padding: 10px 20px; border: none; border-radius: 5px;">
                Todays Week Tracker
            </button>
        </div>

        <!-- Bills section -->
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
                            $billNames[] = $bill['bill_name'];
                            $expense = (float) $bill['expense'];

                            // Get the date of the bill and check if it falls within the selected week
                            $billDate = new DateTime($bill['Date']);
                            if ($billDate >= new DateTime($startDate) && $billDate <= new DateTime($endDate)) {
                                // Get the day of the week (0 = Monday, 6 = Sunday)
                                $dayOfWeek = $billDate->format('N') - 1;

                                // Add the expense to the corresponding day of the week
                                $weeklyExpenses[$dayOfWeek] += $expense;
                            }
                        ?>
                        <tr>
                            <td style="padding: 10px; border: 1px solid #058240;"><?= htmlspecialchars($bill['bill_name']) ?></td>
                            <td style="padding: 10px; border: 1px solid #058240; text-align: center;"><?= number_format($expense, 2) ?> Php</td>
                            <td style="padding: 10px; border: 1px solid #058240; text-align: center;"><?= htmlspecialchars($bill['Date']) ?></td>
                        </tr>
                        <?php } ?>
                    </tbody>
                </table>

                <!-- Bar Chart for bills by day of the week -->
                <canvas id="billChart" width="400" height="200" style="margin-top: 20px;"></canvas>
            <?php } else { ?>
                <p style="color: #058240;">No bills found for this user within the selected week.</p>
            <?php } ?>
        </div>

        <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
        <script>
            // Function to toggle the visibility of the bills
            function toggleDetails() {
                var billsElement = document.getElementById('bills');
                billsElement.style.display = (billsElement.style.display === "none" || billsElement.style.display === "") 
                    ? "block" 
                    : "none";
            }

            // Render the bar chart for bills by day of the week
            var ctx = document.getElementById('billChart').getContext('2d');
            var billChart = new Chart(ctx, {
                type: 'bar',
                data: {
                    labels: <?php echo json_encode($daysOfWeek); ?>,  // Days of the week (Monday to Sunday)
                    datasets: [{
                        label: 'Bill Expenses (by Day)',
                        data: <?php echo json_encode($weeklyExpenses); ?>, // Weekly expenses
                        backgroundColor: 'rgba(5, 130, 64, 0.5)',  // Green color for bars
                        borderColor: 'rgba(5, 130, 64, 1)',  // Darker green for border
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

// If a user selects a specific date, calculate the week and display the bills
if (isset($_GET['selectedDate'])) {
    $selectedDate = $_GET['selectedDate'];
    list($startDate, $endDate) = getWeekStartEndDates($selectedDate);
    dailyTracker($userId, $startDate, $endDate);
}
?>
