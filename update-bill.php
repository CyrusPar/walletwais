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

if ($_GET['bill_id']) {
    $billId = $_GET['bill_id'];
}

if ($_GET['bill_name']) {
    $billName = $_GET['bill_name'];
}

if (isset($_POST['update_bill'])) {
    $billId = $_POST['bill_id'];
    $billName = $_POST['bill_name'];

    if (empty($billName)) {
        array_push($invalid, "Bill Name should not be empty.");
    }
    if (count($invalid) == 0) {
        $updateBill = $billsFacade->updateBill($billId, $billName);
        if ($updateBill) {
            $message = "Bill has been updated to " . $billName . ".";
            $usersFacade->addHistory($userCode, $message);
            header("Location: bills.php");
        }
    }
}

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
                <!-- Add Click Event to Toggle Sidebar -->
                <i class="bi bi-list text-light fs-1" id="sidebarToggle"></i>
            </div>
            <div class="d-flex align-items-center text-center">
                <p class="text-light m-0 ps-2 pt-1">Welcome <br> <span><?= substr($user['email'], 0, 8) . '***' ?></span></p>
            </div>
            <div></div>
        </div>
    </div>

    <div class="app-body bg-light p-3">
        <div class="d-flex justify-content-between align-items-center">
            <h5>Add Bill</h5>
        </div>
        <form action="update-bill.php" method="post">
            <?php include realpath(__DIR__ . '/errors.php') ?>
            <div class="form-floating">
                <input type="text" class="form-control" id="billName" placeholder="Bill Name" name="bill_name" value="<?= $billName ?>">
                <label for="billName">Bill Name</label>
            </div>
            <input type="hidden" name="bill_id" value="<?= $billId ?>">
            <button class="w-100 btn btn-warning text-light mt-2" type="submit" name="update_bill">Update Bill</button>
        </form>
    </div>

    <?php include realpath(__DIR__ . '/app/layout/navbar.php') ?>

<?php } ?>

<?php include realpath(__DIR__ . '/app/layout/footer.php') ?>