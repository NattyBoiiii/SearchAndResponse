<?php
function getAllApplicants($pdo) {
    $sql = "SELECT * FROM searchFarmerApplicants ORDER BY first_name ASC";
    $stmt = $pdo->prepare($sql);
    $executeQuery = $stmt->execute();

    if($executeQuery) {
        $response = array("status" => "200", "querySet" => $stmt -> fetchAll());
    } else {
        $response = array("status" => "400", "message" => "Failed to get informations");
    }
    return $response;
}

function getApplicantByID($pdo, $farmerID) {
    $sql = "SELECT * FROM searchFarmerApplicants WHERE farmerID =?";
    $stmt = $pdo->prepare($sql);
    $executeQuery = $stmt->execute([$farmerID]);

    if($executeQuery) {
        $response = array("status" => "200", "querySet" => $stmt -> fetch());
    } else {
        $response = array("status" => "400", "message" => "Failed to get the information " . $farmerID . "!");
    }
    return $response;
}

function searchForAApplicant($pdo, $searchInput) {
    $sql = "SELECT * FROM searchFarmerApplicants WHERE 
            CONCAT(first_name, last_name, gender, email_address, current_address, age, ideal_timeslot, last_edited, date_added) 
            LIKE ?";
    $stmt = $pdo->prepare($sql);
    $executeQuery = $stmt->execute(["%".$searchInput."%"]);

    if($executeQuery) {
        $response = array("status" => "200", "querySet" => $stmt -> fetchAll());
    } else {
        $response = array("status" => "400", "message" => "Failed to search for applications!");
    }
    return $response;
}


function insertNewApplicant($pdo, $first_name, $last_name, $gender, $email_address, $current_address, $age, $ideal_timeslot) {

    $sql = "INSERT INTO searchFarmerApplicants
            (
                first_name,
                last_name,
                gender,
                email_address,
                current_address,
                age,
                ideal_timeslot
            )
            VALUES (?,?,?,?,?,?,?)
            ";

    $stmt = $pdo->prepare($sql);
    $executeQuery = $stmt->execute([$first_name, $last_name, $gender, $email_address, $current_address, $age, $ideal_timeslot]);

    if ($executeQuery) {
        $response = array("status" => "200", "message" => "Application submitted successfully!");
    } else {
        $response = array("status" => "400", "message" => "Failed to submit application!");
    }
    return $response;
}

function editApplicant($pdo, $first_name, $last_name, $gender, $email_address, $current_address, $age, $ideal_timeslot, $farmerID) {

    $sql = "UPDATE searchFarmerApplicants
                SET first_name = ?,
                    last_name = ?,
                    gender = ?,
                    email_address = ?,
                    current_address = ?,
                    age = ?,
                    ideal_timeslot = ?
                WHERE farmerID = ?";

    $stmt = $pdo->prepare($sql);
    $executeQuery = $stmt->execute([$first_name, $last_name, $gender, $email_address, $current_address, $age, $ideal_timeslot, $farmerID]);

    if ($executeQuery) {
        $response = array(
            "status" => "200",
            "message" => "Application " . $farmerID . " edited successfully!"
        );
    } else {
        $response = array(
            "status" => "400",
            "message" => "Failed to edit application " . $farmerID . "!"
        );
    }
    return $response;
}

function deleteApplicant($pdo, $farmerID) {
    $sql = "DELETE FROM searchFarmerApplicants WHERE farmerID = ?";
    $stmt = $pdo->prepare($sql);
    $executeQuery = $stmt->execute([$farmerID]);

    if($executeQuery) {
        $response = array(
            "status" => "200",
            "message" => "Application " . $farmerID . " has been deleted!"
        );
    } else {
        $response = array(
            "status" => "400",
            "message" => "Failed to delete application " . $farmerID . "!"
        );
    }
    return $response;
}

?>