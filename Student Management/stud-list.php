<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student List</title>
    <link rel="stylesheet" href="./css/styles.css">
</head>
<body>
    <h1>Student List</h1>
    <h2>BSCS 2D</h2>
    <section class="stud-list">
        <div class="stud-table">
            <table border="solid black">
                <thead>
                    <tr>
                        <th>Student ID</th>
                        <th>First Name</th>
                        <th>Last Name</th>
                        <th>M.I.</th>
                        <th>Gender</th>
                        <th>Status</th>
                        <th>Delete</th>
                    </tr>
                </thead>

                <tbody>
                    <?php 
                        include("dbconnection.php");

                        if ($conn->connect_error) {
                            die("Connection failed: " . $conn->connect_error);
                        }

                    // Output ng student data
                    $student_list = "SELECT `stud-id`, firstName, lastName, mi, `stud-gender`, `stud-status` FROM bscs2d";
                    $result = $conn->query($student_list);

                    if ($result->num_rows > 0) {
                        while ($row = $result->fetch_assoc()) {
                            echo "<tr>
                                    <td>{$row['stud-id']}</td>
                                    <td>{$row['firstName']}</td>
                                    <td>{$row['lastName']}</td>
                                    <td>{$row['mi']}</td>
                                    <td>{$row['stud-gender']}</td>
                                    <td>{$row['stud-status']}</td>
                                    <td><a class='delBtn' href='delete.php?stud-id={$row['stud-id']}' onclick='return confirm(\"Are you sure you want to delete this student?\");'>Delete</a></td>
                                </tr>";
                        }
                    } else {
                        echo "<tr><td>No students record.</td></tr>";
                    }

                    $conn->close();
                    ?>
                </tbody>
            </table>

            <!-- Form for adding or updating a student -->
            <div class="container">
                <div class="input">
                    <form action="stud-list.php" method="post">
                        <!-- dapat number lang ang allowed -->
                        <input type="text" name="stud-id" placeholder="Student ID" required value="<?php echo isset($student['stud-id']) ? $student['stud-id'] : ''; ?>">
                        <!-- wala dapat mga number -->
                        <input type="text" name="firstName" placeholder="First Name" required value="<?php echo isset($student['firstName']) ? $student['firstName'] : ''; ?>">
                        <input type="text" name="lastName" placeholder="Last Name" required value="<?php echo isset($student['lastName']) ? $student['lastName'] : ''; ?>">
                        <input type="text" name="mi" placeholder="M.I." maxlength="2" value="<?php echo isset($student['mi']) ? $student['mi'] : ''; ?>">
                        <select name="gender" required>
                            <option value="">Select Gender</option>
                            <option value="Male" <?php if (isset($student['stud-gender']) && $student['stud-gender'] == 'Male') echo 'selected'; ?>>Male</option>
                            <option value="Female" <?php if (isset($student['stud-gender']) && $student['stud-gender'] == 'Female') echo 'selected'; ?>>Female</option>
                        </select>
                        <select name="stud-status" required>
                            <option value="">Status</option>
                            <option value="Regular" <?php if (isset($student['stud-status']) && $student['stud-status'] == 'Regular') echo 'selected'; ?>>Regular</option>
                            <option value="Irregular" <?php if (isset($student['stud-status']) && $student['stud-status'] == 'Irregular') echo 'selected'; ?>>Irregular</option>
                        </select>

                        <div class="return">
                            <button type="submit" name="action" value="add">Add</button>
                            <button type="submit" name="action" value="update">Update</button>
                            <button type="button"><a href="./index.php" style="text-decoration: none;">Back</a></button>
                        </div>
                    </form>

                    <?php
                    if ($_SERVER["REQUEST_METHOD"] == "POST") {
                        include("dbconnection.php");
                        
                        $studID = $_POST["stud-id"];
                        $firstName = $_POST["firstName"];
                        $lastName = $_POST["lastName"]; 
                        $mi = $_POST["mi"];
                        $gender = $_POST["gender"];
                        $studStatus = $_POST["stud-status"];
                    
                        if ($_POST['action'] === 'add') {
                            // Check if meron ng student id
                            $check_sql = "SELECT * FROM bscs2d WHERE `stud-id` = '$studID'";
                            $check_result = $conn->query($check_sql);
                        
                            if ($check_result->num_rows > 0) {
                                // Error message pag may meron ng student ID
                                echo "<div class='error-message'>Student ID already exists. Please use a different ID.</div>";
                            } else {
                                // Maginsert sya ng data if walang kaparehong student id
                                $sql = "INSERT INTO bscs2d (`stud-id`, firstName, lastName, mi, `stud-gender`, `stud-status`) 
                                        VALUES ('$studID', '$firstName', '$lastName', '$mi', '$gender', '$studStatus')";
                        
                                if ($conn->query($sql) === TRUE) { 
                                    echo "<script> window.location.href='stud-list.php';</script>";
                                    exit();
                                } else {
                                    echo "Error: " . $sql . "<br>" . $conn->error;
                                }
                            }
                        } elseif ($_POST['action'] === 'update') {
                            // Update data
                            $update_sql = "UPDATE bscs2d SET firstName='$firstName', lastName='$lastName', mi='$mi', `stud-gender`='$gender', `stud-status`='$studStatus' WHERE `stud-id`='$studID'";
                        
                            if ($conn->query($update_sql) === TRUE) {
                                header("Location: stud-list.php");
                                exit();
                            } else {
                                echo "Error updating record: " . $conn->error;
                            }
                        }
                        
                        $conn->close();
                    }
                    ?>
                </div>
            </div>
        </div>
    </section>
</body>
</html>
