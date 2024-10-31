<?php
include("dbconnection.php");

    // inayos ni chatgpt
if (isset($_GET['stud-id'])) {
    $studID = $_GET['stud-id'];

    // query sa pag delete the record
    $sql = "DELETE FROM bscs2d WHERE `stud-id` = '$studID'";

    if ($conn->query($sql) === TRUE) {
        // Redirect back to the student list after deletion
        header("Location: stud-list.php");
        exit();
    } else {
        echo "Error deleting record: " . $conn->error;
    }

    $conn->close();
} else {
    echo "No student ID specified for deletion.";
}
?>
