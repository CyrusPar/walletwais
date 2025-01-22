<?php

include realpath(__DIR__ . '/app/layout/header.php');

$userId = 0;
if ($_SESSION['user_id']) {
    $userId = $_SESSION['user_id'];
}
if ($_SESSION['user_code']) {
    $userCode = $_SESSION['user_code'];
}

if ($userId == 0) {
    header("Location: splash.php");
}

$host = 'localhost';
$db = 'walletwais';
$user = 'root';
$pass = '';

$pdo = new PDO("mysql:host=$host;dbname=$db", $user, $pass);

$dailyBillQuery = "SELECT DAYOFWEEK(Date) AS day_of_week, SUM(expense) AS total_expense 
                   FROM tbl_bills 
                   WHERE user_code = '$userCode' 
                   GROUP BY day_of_week 
                   ORDER BY day_of_week";
$dailyBillStmt = $pdo->query($dailyBillQuery);

$dailyBillLabels = ['Sunday', 'Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday'];
$dailyBillExpenses = [0, 0, 0, 0, 0, 0, 0];

while ($dailyBillRow = $dailyBillStmt->fetch(PDO::FETCH_ASSOC)) {
    $dailyBillExpenses[$dailyBillRow['day_of_week'] - 1] = $dailyBillRow['total_expense'];
}

$daily_bill_expenses_json = json_encode($dailyBillExpenses);

$weeklyBillQuery = "SELECT WEEK(Date) AS week_of_year, SUM(expense) AS total_expense 
                    FROM tbl_bills 
                    WHERE user_code = '$userCode' 
                    GROUP BY week_of_year 
                    ORDER BY week_of_year";
$weeklyBillStmt = $pdo->query($weeklyBillQuery);

$weeklyBillLabels = [];
$weeklyBillExpenses = [];

while ($weeklyBillRow = $weeklyBillStmt->fetch(PDO::FETCH_ASSOC)) {
    $weeklyBillLabels[] = "Week " . $weeklyBillRow['week_of_year'];
    $weeklyBillExpenses[] = $weeklyBillRow['total_expense'];
}

$weekly_bill_labels_json = json_encode($weeklyBillLabels);
$weekly_bill_expenses_json = json_encode($weeklyBillExpenses);

$monthlyBillQuery = "SELECT MONTH(Date) AS month_of_year, SUM(expense) AS total_expense 
                     FROM tbl_bills 
                     WHERE user_code = '$userCode' 
                     GROUP BY month_of_year 
                     ORDER BY month_of_year";
$monthlyBillStmt = $pdo->query($monthlyBillQuery);

$monthlyBillLabels = ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'];
$monthlyBillExpenses = array_fill(0, 12, 0);

while ($monthlyBillRow = $monthlyBillStmt->fetch(PDO::FETCH_ASSOC)) {
    $monthlyBillExpenses[$monthlyBillRow['month_of_year'] - 1] = $monthlyBillRow['total_expense'];
}

$monthly_bill_labels_json = json_encode($monthlyBillLabels);
$monthly_bill_expenses_json = json_encode($monthlyBillExpenses);

$yearlyBillQuery = "SELECT YEAR(Date) AS year_of_expense, SUM(expense) AS total_expense 
                    FROM tbl_bills 
                    WHERE user_code = '$userCode' 
                    GROUP BY year_of_expense 
                    ORDER BY year_of_expense";
$yearlyBillStmt = $pdo->query($yearlyBillQuery);

$yearlyBillLabels = ['2020', '2021', '2022', '2023', '2024', '2025'];
$yearlyBillExpenses = array_fill(0, 6, 0);

while ($yearlyBillRow = $yearlyBillStmt->fetch(PDO::FETCH_ASSOC)) {
    $yearIndex = $yearlyBillRow['year_of_expense'] - 2020;
    $yearlyBillExpenses[$yearIndex] = $yearlyBillRow['total_expense'];
}

$yearly_bill_expenses_json = json_encode($yearlyBillExpenses);

$fetchUserById = $usersFacade->fetchUserById($userId);
foreach ($fetchUserById as $user) { ?>

    <style>
        body {
            background-color: #058240;
        }
    </style>

    <?php include realpath(__DIR__ . '/app/layout/sidebar.php') ?>

    <div class="container">
        <div class="app-header d-flex justify-content-between">
            <div class="d-flex align-items-center">
                <i class="bi bi-list text-light fs-1" id="sidebarToggle"></i>
            </div>
            <div class="d-flex align-items-center text-center">
                <p class="text-light m-0 ps-2 pt-1">Welcome <br> <span><?= substr($user['email'], 0, 8) . '***' ?></span></p>
            </div>
            <div></div>
        </div>
    </div>

    <div class="app-body bg-light p-3">
        <h5>Analytics</h5>

        <div class="card mt-2">
            <div class="card-header">
                <h6 class="m-0">Daily Expenses</h6>
            </div>
            <div class="card-body">
                <div style="width: 70%; margin: auto;">
                    <canvas id="dailyExpensesChart"></canvas>
                </div>
            </div>
        </div>

        <div class="card mt-2">
            <div class="card-header">
                <h6 class="m-0">Weekly Expenses</h6>
            </div>
            <div class="card-body">
                <div style="width: 70%; margin: auto;">
                    <canvas id="weeklyExpensesChart"></canvas>
                </div>
            </div>
        </div>

        <div class="card mt-2">
            <div class="card-header">
                <h6 class="m-0">Monthly Expenses (Jan-Dec)</h6>
            </div>
            <div class="card-body">
                <div style="width: 70%; margin: auto;">
                    <canvas id="monthlyExpensesChart"></canvas>
                </div>
            </div>
        </div>

        <div class="card mt-2">
            <div class="card-header">
                <h6 class="m-0">Yearly Expenses (2020-2025)</h6>
            </div>
            <div class="card-body">
                <div style="width: 70%; margin: auto;">
                    <canvas id="yearlyExpensesChart"></canvas>
                </div>
            </div>
        </div>

    </div>

    <?php include realpath(__DIR__ . '/app/layout/navbar.php') ?>

<?php } ?>

<?php include realpath(__DIR__ . '/app/layout/footer.php') ?>

<script>
    var dailyExpenses = <?php echo $daily_bill_expenses_json; ?>;
    var dailyLabels = ['Sunday', 'Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday'];

    var ctx = document.getElementById('dailyExpensesChart').getContext('2d');
    var dailyExpensesChart = new Chart(ctx, {
        type: 'bar',
        data: {
            labels: dailyLabels,
            datasets: [{
                label: 'Daily Expenses',
                data: dailyExpenses,
                backgroundColor: 'rgba(75, 192, 192, 0.6)',
                borderColor: 'rgba(75, 192, 192, 1)',
                borderWidth: 1
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            scales: {
                y: {
                    beginAtZero: true
                }
            }
        }
    });

    var weeklyExpenses = <?php echo $weekly_bill_expenses_json; ?>;
    var weeklyLabels = <?php echo $weekly_bill_labels_json; ?>;

    var ctx = document.getElementById('weeklyExpensesChart').getContext('2d');
    var weeklyExpensesChart = new Chart(ctx, {
        type: 'bar',
        data: {
            labels: weeklyLabels,
            datasets: [{
                label: 'Weekly Expenses',
                data: weeklyExpenses,
                backgroundColor: 'rgba(255, 99, 132, 0.6)',
                borderColor: 'rgba(255, 99, 132, 1)',
                borderWidth: 1
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            scales: {
                y: {
                    beginAtZero: true
                }
            }
        }
    });

    var monthlyExpenses = <?php echo $monthly_bill_expenses_json; ?>;
    var monthlyLabels = <?php echo $monthly_bill_labels_json; ?>;

    var ctx = document.getElementById('monthlyExpensesChart').getContext('2d');
    var monthlyExpensesChart = new Chart(ctx, {
        type: 'bar',
        data: {
            labels: monthlyLabels,
            datasets: [{
                label: 'Monthly Expenses',
                data: monthlyExpenses,
                backgroundColor: 'rgba(153, 102, 255, 0.6)',
                borderColor: 'rgba(153, 102, 255, 1)',
                borderWidth: 1
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            scales: {
                y: {
                    beginAtZero: true
                }
            }
        }
    });

    var yearlyExpenses = <?php echo $yearly_bill_expenses_json; ?>;
    var yearlyLabels = ['2020', '2021', '2022', '2023', '2024', '2025'];

    var ctx = document.getElementById('yearlyExpensesChart').getContext('2d');
    var yearlyExpensesChart = new Chart(ctx, {
        type: 'bar',
        data: {
            labels: yearlyLabels,
            datasets: [{
                label: 'Yearly Expenses',
                data: yearlyExpenses,
                backgroundColor: 'rgba(255, 159, 64, 0.6)',
                borderColor: 'rgba(255, 159, 64, 1)',
                borderWidth: 1
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            scales: {
                y: {
                    beginAtZero: true
                }
            }
        }
    });
</script>
