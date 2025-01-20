<?php

// Start session management and output buffering
session_start();
ob_start();

// Array to store messages
$invalid = array();
$success = array();
$warning = array();
$info = array();
 
// Include necessary files for database connectivity and facade classes
include(__DIR__ . '/../../config/db/connector.php');
include(__DIR__ . '/../../app/models/users-facade.php');
include(__DIR__ . '/../../app/models/bills-facade.php');
include(__DIR__ . '/../../app/models/group-bills-facade.php');
include(__DIR__ . '/../../app/models/group-members-facade.php');

$usersFacade = new UsersFacade;
$billsFacade = new BillsFacade;
$groupBillsFacade = new GroupBillsFacade;
$groupMembersFacade = new GroupsMembersFacade;

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="author" content="Appworks Co.">
    <!-- Template CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/2.1.4/css/dataTables.dataTables.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link rel="stylesheet" href="./public/css/style.css">
    <title>WalletWais</title>
</head>

<body>