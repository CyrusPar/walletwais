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

if ($_GET['group_id']) {
    $groupId = $_GET['group_id'];
}
if ($_GET['bill_name']) {
    $billName = $_GET['bill_name'];
}

if (isset($_POST['add_member'])) {
    $groupId = $_POST['group_id'];
    $userCode = $_POST['user_code'];
    $billName = $_POST['bill_name'];

    if (empty($userCode)) {
        array_push($invalid, "User Code should not be empty.");
    }
    if (count($invalid) == 0) {

        $verifyUserCode = $usersFacade->verifyUserCode($userCode);

        if ($verifyUserCode == 1) {
            $addMember = $groupMembersFacade->addMember($groupId, $userCode, $billName);
            if ($addMember) {
                array_push($success, "User Code has been invited successfully.");
                $message = "You have been invited to bill named " . $billName . ".";
                $usersFacade->addHistory($userCode, $message);
                header("Location: group-members.php?group_id=" . $groupId . "&bill_name=" . $billName);
            }
        } else {
            array_push($invalid, "There is no registered user with that user code.");
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
            <h5>Add Member</h5>
        </div>
        <form action="add-member.php?bill_name=<?= $billName ?>" method="post">
            <?php include realpath(__DIR__ . '/errors.php') ?>
            <div class="form-floating">
                <input type="text" class="form-control" id="userCode" placeholder="User Code" name="user_code">
                <label for="userCode">User Code</label>
            </div>
            <input type="hidden" name="bill_name" value="<?= $billName ?>">
            <input type="hidden" name="group_id" value="<?= $groupId ?>">
            <button class="w-100 btn btn-warning text-light mt-2" type="submit" name="add_member">Add Member</button>
        </form>
    </div>

    <?php include realpath(__DIR__ . '/app/layout/navbar.php') ?>

<?php } ?>

<?php include realpath(__DIR__ . '/app/layout/footer.php') ?>