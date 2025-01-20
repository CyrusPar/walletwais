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

if (isset($_POST['update'])) {
    $groupId = $_POST['group_id'];
    $billName = $_POST['bill_name'];
    $percentage = $_POST['percentage'];

    // Check if percentage is not empty and is a valid number
    if ($percentage === "") {
        array_push($invalid, "Percentage should not be empty.");
    } elseif ($percentage < 0 || $percentage > 100) {
        array_push($invalid, "Percentage must be between 0 and 100.");
    }

    if (count($invalid) == 0) {
        // Verify if the new percentage should not exceed 100%
        $totalPercentage = $groupMembersFacade->sumPercentage($billName);

        // If the user inputs 0, it will reset the percentage for this group member
        if ($percentage == 0) {
            // Reset the percentage to 0 and update it
            $updatePercentage = $groupMembersFacade->updatePercentage($groupId, 0);
            if ($updatePercentage) {
                array_push($success, "Percentage has been reset to 0 successfully.");
            }
        } else {
            // Calculate the new total percentage after adding the user input
            $newTotalPercentage = $totalPercentage + $percentage;

            // Check if the new total percentage does not exceed 100%
            if ($newTotalPercentage <= 100) {
                $updatePercentage = $groupMembersFacade->updatePercentage($groupId, $percentage);
                if ($updatePercentage) {
                    array_push($success, "Percentage has been updated successfully.");
                }
            } else {
                array_push($invalid, "Total percentage should not exceed 100%. The current total is " . $totalPercentage . "%.");
            }
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
            <h5>Update Percentage</h5>
        </div>
        <form action="update-percentage.php?group_id=<?= $groupId ?>&bill_name=<?= $billName ?>" method="post">
            <?php include realpath(__DIR__ . '/errors.php') ?>
            <div class="form-floating">
                <input type="text" class="form-control" id="percentage" placeholder="Percentage" name="percentage">
                <label for="percentage">Percentage</label>
            </div>
            <input type="hidden" name="group_id" value="<?= $groupId ?>">
            <input type="hidden" name="bill_name" value="<?= $billName ?>">
            <button class="w-100 btn btn-warning text-light mt-2" type="submit" name="update">Update</button>
        </form>
    </div>

    <?php include realpath(__DIR__ . '/app/layout/navbar.php') ?>

<?php } ?>

<?php include realpath(__DIR__ . '/app/layout/footer.php') ?>