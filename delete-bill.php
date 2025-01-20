<?php

include realpath(__DIR__ . '/app/layout/header.php');

if ($_GET['user_code']) {
    $userCode = $_GET['user_code'];
}

if ($_GET['bill_id']) {
    $billId = $_GET['bill_id'];
}

if ($_GET['bill_name']) {
    $billName = $_GET['bill_name'];
}

$deleteBill = $billsFacade->deleteBill($billId);
if ($deleteBill) {
    $message = "Bill named " . $billName . " has been deleted.";
    $usersFacade->addHistory($userCode, $message);
    header("Location: bills.php");
}
