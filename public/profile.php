<?php
$headerStyle = 'active';
include 'HeaderFooter/RecordHeader.php';
include_once(__DIR__ . '/../config/connectionDB.php');

// 1. DATABASE UPDATE CONTROLLER: Runs when the status dropdown changes
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['update_status'])) {
    $student_id = intval($_GET['id']);
    $new_status = mysqli_real_escape_string($conn, $_POST['status']);

    if (!empty($new_status)) {
        $updateQuery = "UPDATE student SET admissionStatus = '$new_status' WHERE id = $student_id";
        mysqli_query($conn, $updateQuery);
        // Refresh page data state cleanly
        header("Location: profile.php?id=" . $student_id);
        exit();
    }
}
?>


<!--
----------------------
MAIN CONTENT
----------------------
                    -->
<div class="dashboard-container">
    <main class="main-content">
        <?php
        $id = intval($_GET['id']); // Sanitized ID input
        $query = "SELECT * FROM student WHERE id = $id";
        $result = mysqli_query($conn, $query);
        $row = mysqli_fetch_assoc($result);

        // Map the current database string to an readable CSS style class color label
        $currentStatus = htmlspecialchars($row['admissionStatus'] ?? 'undecided');
        $statusClass = ($currentStatus === 'admitted') ? 'approved' : 'pending';
        ?>

        <header class="content-header">
            <div class="header-title">
                <h1>Student Profile Overview</h1>
                <p>Manage and review detailed academic information</p>
            </div>
        </header>



        <!--
---------------------------
PROFILE DETAILS SECTION
---------------------------
                        -->

        <section class="profile-details-section">
            <div class="profile-card">
                <div class="profile-card-header">
                    <div class="avatar-container">
                        <img src="./img/images.png" alt="Student Avatar" id="profile-avatar">
                    </div>
                    <h2 class="student-name"><?php echo $row['firstName'] . ' ' . $row['middleName'] . ' ' . $row['lastName']; ?></h2>
                    <p class="student-email"><?php echo $row['email'] ?></p>
                </div>


                <!--
----------------------------
   STATS CARDS GRID SESSION
----------------------------
                        -->
                <section class="stats-grid">
                    <div class="stat-card">
                        <div class="stat-icon admission-icon">
                            <i class="fa-solid fa-id-card"></i>
                        </div>
                        <div class="stat-info">
                            <h3>Admission Status</h3>
                            <p class="status-text <?php echo $statusClass; ?>">
                                <?php echo ucfirst($currentStatus); ?>
                            </p>
                        </div>
                    </div>

                    <div class="stat-card">
                        <div class="stat-icon score-icon">
                            <i class="fa-solid fa-graduation-cap"></i>
                        </div>
                        <div class="stat-info">
                            <h3>JAMB Score</h3>
                            <p class="stat-number"><?php echo $row['jambScore']; ?></p>
                        </div>
                    </div>

                    <div class="stat-card">
                        <div class="stat-icon gender-icon">
                            <i class="fa-solid fa-venus-mars"></i>
                        </div>
                        <div class="stat-info">
                            <h3>Gender</h3>
                            <p class="stat-number"><?php echo $row['gender']; ?></p>
                        </div>
                    </div>
                </section>

                <div class="profile-card-body">
                    <div class="info-group">
                        <span class="label">Full Name:</span>
                        <span class="value"><?php echo $row['firstName'] . ' ' . $row['middleName'] . ' ' . $row['lastName']; ?></span>
                    </div>
                    <div class="info-group">
                        <span class="label">Phone Number:</span>
                        <span class="value"><?php echo $row['phoneNumber']; ?></span>
                    </div>
                    <div class="info-group">
                        <span class="label">Date of Birth:</span>
                        <span class="value"><?php echo $row['DOB']; ?></span>
                    </div>
                    <div class="info-group">
                        <span class="label">State of Origin:</span>
                        <span class="value"><?php echo $row['stateOfOrigin']; ?></span>
                    </div>
                    <div class="info-group">
                        <span class="label">Email:</span>
                        <span class="value"><?php echo $row['email']; ?></span>
                    </div>
                    <div class="info-group">
                        <span class="label">Local Government:</span>
                        <span class="value"><?php echo $row['localGovernment']; ?></span>
                    </div>
                    <div class="info-group">
                        <span class="label">Address:</span>
                        <span class="value"><?php echo $row['address']; ?></span>
                    </div>
                    <div class="info-group">
                        <span class="label">Next of Kin:</span>
                        <span class="value"><?php echo $row['nextOfKin']; ?></span>
                    </div>
                </div>


                <!--
-------------------------------
PROFILE CARD FOOTER SECTION
-------------------------------
                            -->
                <div class="profile-card-footer">
                    <form action="" method="POST" class="status-update-form" style="display: flex; gap: 10px;">
                        <input type="hidden" name="update_status" value="1">
                        <select name="status" onchange="this.form.submit()">
                            <option value="">Select-Admission-Status</option>
                            <option value="admitted" <?php echo ($currentStatus === 'admitted') ? 'selected' : ''; ?>>Admitted</option>
                            <option value="undecided" <?php echo ($currentStatus === 'undecided') ? 'selected' : ''; ?>>Undecided</option>
                        </select>
                    </form>
                    <a href="StudentRecord.php" class="btn btn-back">Back to List</a>
                </div>

            </div>
        </section>
    </main>
</div>

<?php
$headerStyle = 'active';
include 'HeaderFooter/ProfileFooter.php';
?>