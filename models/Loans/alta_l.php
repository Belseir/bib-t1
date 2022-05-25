<?php
include_once("../../libreria/loan.php");

$loanManager = new LoanManager();

$loan = new Loan();

echo var_dump($_POST);

if (isset($_POST['user_id']))
    $loan->user_id = $_POST['user_id'];

if (isset($_POST['book_id']))
    $loan->book_id = $_POST['book_id'];

if (isset($_POST['since'])) {
    $since = strtotime($_POST['since']);
    $mysqldate = date('Y-m-d', $since);
    $loan->since = $mysqldate;
}

if (isset($_POST['till'])) {
    $till = strtotime($_POST['till']);
    $mysqldate = date('Y-m-d', $till);
    $loan->till = $mysqldate;
}

if (isset($_POST['debt']))
    $loan->debt = $_POST['debt'];


if ($loan->validateSave())
    $loanManager->save($loan);

Header('Location: ../../views/loans.php');
