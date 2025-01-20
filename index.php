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

// Message variables to display alerts
$message = null;
$messageType = null;

if (isset($_POST['addAmount'])) {
    $amountToAdd = floatval($_POST['amount']);
    if ($amountToAdd > 0) {
        // Call the updateWallet method to add the amount to the wallet
        $updateResult = $usersFacade->updateWallet($userId, $amountToAdd);

        if ($updateResult) {
            $message = "Amount added successfully!";
            $messageType = "success";
        } else {
            $message = "Failed to add amount. Please try again.";
            $messageType = "danger";
        }
    } else {
        $message = "Invalid amount. Please enter a valid number.";
        $messageType = "danger";
    }
}

$fetchUserById = $usersFacade->fetchUserById($userId);
foreach ($fetchUserById as $user) { ?>

    <style>
        body {
            background-color: #058240;
        }
        .alert {
            margin-top: 10px;
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
        <div class="d-flex flex-column align-items-center justify-content-center text-center">
            <!-- Display Wallet Amount -->
            <p class="text-light m-0 mb-2">Wallet: <?= number_format($user['wallet'], 2) ?></p>
            <!-- Add Amount Button -->
            <button class="btn btn-light btn-sm">Add Amount</button>
        </div>
    </div>
</div>


    <div class="app-body bg-light p-3">
                <!-- Alert Section -->
                <?php if ($message) { ?>
            <div class="alert alert-<?= $messageType ?> alert-dismissible fade show" role="alert">
                <?= $message ?>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        <?php } ?>
        <div class="d-flex justify-content-between align-items-center">
            <h5>My Bills</h5>
        </div>
        <div class="row mx-0">
            <?php
            $fetchBillByCode = $billsFacade->fetchBillByCode($userCode);
            foreach ($fetchBillByCode as $bill) { ?>
                <div class="col-4 d-flex align-items-center justify-content-center p-0">
                    <div class="card w-100 h-100">
                        <div class="card-body d-flex align-items-center justify-content-center text-center">
                            <div>
                                <h6 class="m-0"><?= $bill["bill_name"] ?></h6>
                                <h4 class="m-0"><?= number_format($bill["expense"], 2) ?></h4>
                            </div>
                        </div>
                    </div>
                </div>
            <?php } ?>
        </div>
        <div class="d-flex justify-content-between align-items-center mt-3">
            <h5>Group Bills</h5>
        </div>
        <div class="row mx-0">
            <?php
            $fetchGroupBillByCode = $groupMembersFacade->fetchGroupBillByUserCode($userCode);
            foreach ($fetchGroupBillByCode as $bill) { ?>
                <div class="col-4 d-flex align-items-center justify-content-center p-0">
                    <div class="card w-100 h-100">
                        <div class="card-body d-flex align-items-center justify-content-center text-center">
                            <div>
                                <h6 class="m-0"><?= $bill["bill_name"] ?></h6>
                                <?php
                                $fetchGroupMembersByBillName = $groupMembersFacade->fetchGroupMembersByUserCodeBillName($userCode, $bill["bill_name"]);
                                foreach ($fetchGroupMembersByBillName as $member) { ?>
                                    <h4 class="m-0"><?= number_format($member["contribution"], 2) ?></h4>
                                <?php } ?>
                                <?php
                                $fetchGroupBillByBillName = $groupBillsFacade->fetchGroupBillByBillName($bill["bill_name"]);
                                foreach ($fetchGroupBillByBillName as $bill) {
                                    $toPay = $bill["expense"] * $member["percentage"] / 100;
                                    echo $toPay;
                                } ?>
                            </div>
                        </div>
                    </div>
                </div>
            <?php } ?>
        </div>
    </div>

    <!-- Modal for Adding Amount -->
    <div id="addAmountModal" style="display: none; position: fixed; top: 0; left: 0; width: 100%; height: 100%; background: rgba(0, 0, 0, 0.5); z-index: 1000; justify-content: center; align-items: center;">
        <div style="background: #fff; padding: 20px; border-radius: 8px; width: 300px; text-align: center;">
            <h5>Add Amount to Wallet</h5>
            <form method="POST" action="">
                <input type="number" name="amount" placeholder="Enter amount" required style="width: 100%; padding: 8px; margin-bottom: 15px; border: 1px solid #ccc; border-radius: 5px;">
                <button type="submit" name="addAmount" style="padding: 8px 16px; background-color: #058240; color: #fff; border: none; border-radius: 5px;">Add</button>
                <button type="button" onclick="hideAddAmountModal()" style="padding: 8px 16px; background-color: #ccc; color: #333; border: none; border-radius: 5px; margin-left: 10px;">Cancel</button>
            </form>
        </div>
    </div>

    <script>
        function showAddAmountModal() {
            document.getElementById('addAmountModal').style.display = 'flex';
        }

        function hideAddAmountModal() {
            document.getElementById('addAmountModal').style.display = 'none';
        }
    </script>

    <?php include realpath(__DIR__ . '/app/layout/navbar.php') ?>

<?php } ?>

<?php include realpath(__DIR__ . '/app/layout/footer.php') ?>
