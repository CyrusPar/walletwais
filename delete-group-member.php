<?php

include realpath(__DIR__ . '/app/layout/header.php');

if ($_GET['group_id']) {
    $groupId = $_GET['group_id'];
}

if ($_GET['bill_name']) {
    $billName = $_GET['bill_name'];
}

$deleteGroup = $groupMembersFacade->deleteGroup($groupId);
if ($deleteGroup) {
    header("Location: group-members.php?group_id=" . $groupId . "&bill_name=" . $billName);
    $message = "Group Bill named " . $billName . " has been deleted.";
    $usersFacade->addHistory($userCode, $message);
}
