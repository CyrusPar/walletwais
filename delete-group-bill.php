<?php

include realpath(__DIR__ . '/app/layout/header.php');

if ($_GET['user_code']) {
    $userCode = $_GET['user_code'];
}

if ($_GET['group_id']) {
    $groupId = $_GET['group_id'];
}

if ($_GET['bill_name']) {
    $billName = $_GET['bill_name'];
}

$deleteGroupBill = $groupBillsFacade->deleteGroupBill($groupId);
$groupMembersFacade->deleteGroupByGroupId($groupId);
if ($deleteGroupBill) {
    $message = "Group Bill named " . $billName . " has been deleted.";
    $usersFacade->addHistory($userCode, $message);
    header("Location: group-budgeting.php");
}
