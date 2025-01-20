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

if (isset($_POST['add_group'])) {
    $groupId = rand(00000000, 99999999);
    $userCode = $_POST['user_code'];
    $billName = $_POST['bill_name'];
    $expense = $_POST['expense'];

    if (empty($billName)) {
        array_push($invalid, "Bill Name should not be empty.");
    }
    if (empty($expense)) {
        array_push($invalid, "Expense should not be empty.");
    }
    if (count($invalid) == 0) {
        $addGroup = $groupBillsFacade->addGroup($groupId, $userCode, $billName, $expense);
        if ($addGroup) {
            array_push($success, "Group Bill has been added successfully.");
            // Add admin into the group members
            $isAdmin = 1;
            $addAdminMember = $groupMembersFacade->addAdminMember($groupId, $userCode, $billName, $isAdmin);
            $message = "Group Bill named " . $billName . " has been added.";
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
        <div class="d-flex justify-content-between align-items-center">
            <h5>Add Group</h5>
        </div>
        <form action="add-group.php" method="post">
            <?php include realpath(__DIR__ . '/errors.php') ?>
            <div class="form-floating">
                <input type="text" class="form-control" id="billName" placeholder="Bill Name" name="bill_name">
                <label for="billName">Bill Name</label>
            </div>
            <div class="form-floating mt-1">
                <input type="text" class="form-control" id="expense" placeholder="Expense" name="expense">
                <label for="expense">Expense</label>
            </div>
            <input type="hidden" name="user_code" value="<?= $userCode ?>">
            <button class="w-100 btn btn-warning text-light mt-2" type="submit" name="add_group">Add Group</button>
        </form>
    </div>

    <?php include realpath(__DIR__ . '/app/layout/navbar.php') ?>

<?php } ?>

<?php include realpath(__DIR__ . '/app/layout/footer.php') ?>