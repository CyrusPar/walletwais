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

if (isset($_POST['add_expense_individual'])) {
    $userCode = $_POST['user_code'];
    $billName = $_POST['bill_name'];
    $expense = $_POST['expense'];

    if ($billName == 'None') {
        array_push($invalid, "Bill Name should not be empty.");
    }
    if (empty($expense)) {
        array_push($invalid, "Expense should not be empty.");
    } else {
        $updateBillWithExpense = $billsFacade->updateBillWithExpense($userCode, $billName, $expense);
        if ($updateBillWithExpense) {
            $billId = $billName;
            $fetchBillByBillId = $billsFacade->fetchBillByBillId($billId);
            foreach ($fetchBillByBillId as $bills) {
                $billName = $bills["bill_name"];
            }
            array_push($success, "Expense has been added successfully.");
            $message = "Bill named " . $billName . " has been paid with the amount of " . $expense . ".";
            $usersFacade->addHistory($userCode, $message);
        }
    }
}

if (isset($_POST['add_expense_group'])) {
    $userCode = $_POST['user_code'];
    $billName = $_POST['bill_name'];
    $expense = $_POST['expense'];

    if ($billName == 'None') {
        array_push($invalid, "Bill Name should not be empty.");
    }
    if (empty($expense)) {
        array_push($invalid, "Expense should not be empty.");
    } else {
        $updateBillWithExpense = $groupMembersFacade->updateBillWithExpense($userCode, $billName, $expense);
        if ($updateBillWithExpense) {
            $groupId = $billName;
            $fetchGroupBillByUserCode = $groupBillsFacade->fetchGroupBillByUserCode($userCode);
            foreach ($fetchGroupBillByUserCode as $groupBills) {
                $groupBillName = $groupBills["bill_name"];
            }
            array_push($success, "Expense has been added successfully.");
            $message = "Bill named " . $groupBillName . " has been paid with the amount of " . $expense . ".";
            $usersFacade->addHistory($userCode, $message);
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
        <?php include realpath(__DIR__ . '/errors.php') ?>
        <div class="d-flex justify-content-between align-items-center">
            <h5>Individual</h5>
        </div>

        <div class="card">
            <div class="card-body">
                <form action="expense.php" method="post">
                    <div class="form-floating">
                        <select class="form-select" id="billName" name="bill_name">
                            <option value="None" selected>Select Bill</option>
                            <?php
                            $fetchBillByCode = $billsFacade->fetchBillByCode($userCode);
                            foreach ($fetchBillByCode as $bill) { ?>
                                <option value="<?= $bill["id"] ?>"><?= $bill["bill_name"] ?></option>
                            <?php } ?>
                        </select>
                        <label for="billName">Bill</label>
                    </div>
                    <div class="form-floating mt-1">
                        <input type="text" class="form-control" id="expense" placeholder="Expense" name="expense">
                        <label for="expense">Expense</label>
                    </div>
                    <input type="hidden" name="user_code" value="<?= $userCode ?>">
                    <button class="w-100 btn btn-warning text-light mt-2" type="submit" name="add_expense_individual">Add Expense</button>
                </form>
            </div>
        </div>

        <div class="d-flex justify-content-between align-items-center mt-2">
            <h5>Group</h5>
        </div>
        <div class="card">
            <div class="card-body">
                <form action="expense.php" method="post">
                    <div class="form-floating">
                        <select class="form-select" id="billName" name="bill_name">
                            <option value="None" selected>Select Bill</option>
                            <?php
                            $fetchGroupBillByUserCode = $groupMembersFacade->fetchGroupBillByUserCode($userCode);
                            foreach ($fetchGroupBillByUserCode as $bill) { ?>
                                <option value="<?= $bill["id"] ?>"><?= $bill["bill_name"] ?></option>
                            <?php } ?>
                        </select>
                        <label for="billName">Bill</label>
                    </div>
                    <div class="form-floating mt-1">
                        <input type="text" class="form-control" id="expense" placeholder="Expense" name="expense">
                        <label for="expense">Expense</label>
                    </div>
                    <input type="hidden" name="user_code" value="<?= $userCode ?>">
                    <button class="w-100 btn btn-warning text-light mt-2" type="submit" name="add_expense_group">Add Expense</button>
                </form>
            </div>
        </div>
    </div>

    <?php include realpath(__DIR__ . '/app/layout/navbar.php') ?>

<?php } ?>

<?php include realpath(__DIR__ . '/app/layout/footer.php') ?>