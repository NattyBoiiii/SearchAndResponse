<?php
require_once "dbConfig.php";
require_once "models.php";

if (isset($_POST['insertApplicantBtn'])) {
    $insertApplicant = insertNewApplicant($pdo, $_POST['first_name'], $_POST['last_name'], $_POST['gender'], $_POST['email_address'], 
    $_POST['current_address'], $_POST['age'], $_POST['ideal_timeslot']);

    if($insertApplicant['status'] == "200") {
        $_SESSION['message'] = $insertApplicant['message'];
        header('Location: ../index.php');
    } else {
        $_SESSION['message'] = "Error " . $insertApplicant['status'] . ": " . $insertApplicant['message'];
        header('Location: ../index.php');
    }
}

if (isset($_POST['editApplicantBtn'])) {
    $editApplicant = editApplicant($pdo, $_POST['first_name'], $_POST['last_name'], $_POST['gender'], $_POST['email_address'], 
    $_POST['current_address'], $_POST['age'], $_POST['ideal_timeslot'], $_GET['farmerID']);

    if($editApplicant['status'] == "200") {
        $_SESSION['message'] = $editApplicant['message'];
        header('Location: ../index.php');
    } else {
        $_SESSION['message'] = "Error " . $editApplicant['status'] . ": " . $editApplicant['message'];
        header('Location: ../index.php');
    }
}

if (isset($_POST['deleteApplicantBtn'])) {
    $deleteApplicant = deleteApplicant($pdo, $_GET['farmerID']);

    if($deleteApplicant['status'] == "200") {
        $_SESSION['message'] = $deleteApplicant['message'];
        header('Location: ../index.php');
    } else {
        $_SESSION['message'] = "Error " . $deleteApplicant['status'] . ": " . $deleteApplicant['message'];
        header('Location: ../index.php');
    }
}



