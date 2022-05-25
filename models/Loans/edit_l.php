<?php
include_once("../../libreria/loan.php");

$loanManager = new LoanManager();

$loan = new Loan();


if (isset($_POST['debt']))
    $loan->debt = $_POST['debt'];

if (isset($_POST['till']))
    $loan->till = $_POST['till'];

if (isset($_POST['paid']))
    $loan->paid = $_POST['paid'];

if (isset($_POST['id']))
    $loan->id = $_POST['id'];

echo var_dump($loan);

if ($loan->validateUpdate())
    $loanManager->update($loan);
