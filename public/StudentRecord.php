<?php
include_once(__DIR__ . '/../config/connectionDB.php');
?>
<?php
$headerStyle = 'active';
include 'HeaderFooter/RecordHeader.php'; ?>

<!--
----------------------
MAIN CONTENT
----------------------
-->

<div class="main-container">

    <div class="info-banner">
        <p>Info! All students records table</p>
    </div>

    <div class="filter-card">
        <form action="" method="GET" class="filter-form">
            <input type="text" name="search" placeholder="Search Record By Name Only" value="<?php if (isset($_GET['search'])) {
                                                                                                    echo htmlspecialchars($_GET['search']);
                                                                                                } ?> ">

            <select name="status">
                <option value="">Select-Admission-Status</option>
                <option value="admitted" <?php echo (($_GET['status'] ?? '') === 'admitted') ? 'selected' : ''; ?>>Admitted</option>
                <option value="undecided" <?php echo (($_GET['status'] ?? '') === 'undecided') ? 'selected' : ''; ?>>Undecided</option>
            </select>

            <select name="gender-filter">
                <option value="">Select-Gender</option>
                <option value="male" <?php echo (($_GET['gender-filter'] ?? '') === 'male') ? 'selected' : ''; ?>>Male</option>
                <option value="female" <?php echo (($_GET['gender-filter'] ?? '') === 'female') ? 'selected' : ''; ?>>Female</option>
            </select>

            <input type="text" name="jamb-filter" value="<?php if (isset($_GET['jamb-filter'])) {
                                                                echo htmlspecialchars($_GET['jamb-filter']);
                                                            } ?>" placeholder="Enter Jamb Score">

            <button type="submit" class="search-btn">Search</button>
        </form>
    </div>

    <!--
        -------------------------
                TABLE CONTAINER
        --------------------------
                             -->
    <div class="table-container">
        <table class="records-table">
            <thead>
                <tr>
                    <th>S/n</th>
                    <th style="white-space: nowrap;">Name</th>
                    <th>Gender</th>
                    <th style="white-space: nowrap;">Jamb Score</th>
                    <th style="white-space: nowrap;">Admission Status</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php
                // 1. Establish the base query and condition container array
                $baseQuery = "SELECT * FROM student";
                $conditions = array();

                //  filter search by name module
                if (isset($_GET['search']) && !empty(trim($_GET['search']))) {
                    $search = mysqli_real_escape_string($conn, trim($_GET['search']));
                    $conditions[] = "(firstName LIKE '%$search%' OR middleName LIKE '%$search%' OR lastName LIKE '%$search%' OR email LIKE '%$search%')";
                }

                //  Admission Status Dropdown
                if (isset($_GET['status']) && !empty($_GET['status'])) {
                    $status = mysqli_real_escape_string($conn, $_GET['status']);
                    $conditions[] = "admissionStatus = '$status'";
                }

                // Gender Filter Dropdown 
                if (isset($_GET['gender-filter']) && !empty($_GET['gender-filter'])) {
                    $gender = mysqli_real_escape_string($conn, $_GET['gender-filter']);
                    $conditions[] = "gender = '$gender'";
                }

                // Jamb Score Filter Module
                if (isset($_GET['jamb-filter']) && !empty(trim($_GET['jamb-filter']))) {
                    $jambFilter = mysqli_real_escape_string($conn, trim($_GET['jamb-filter']));
                    $conditions[] = "CAST(jambScore AS CHAR) LIKE '%$jambFilter%'";
                }

                // Combine conditions with AND operator if any exist
                if (count($conditions) > 0) {
                    $baseQuery .= " WHERE " . implode(' AND ', $conditions);
                }

                // Execute the query and display results
                $serialNumber = 1;
                $result = mysqli_query($conn, $baseQuery);

                if ($result && mysqli_num_rows($result) > 0) {
                    while ($row = mysqli_fetch_assoc($result)) {
                ?>
                        <tr>
                            <td><?php echo $serialNumber++; ?></td>
                            <td style="white-space: nowrap;"><?php echo htmlspecialchars($row['firstName'] . ' ' . $row['middleName'] . ' ' . $row['lastName']); ?></td>
                            <td><?php echo htmlspecialchars($row['gender']); ?></td>
                            <td><?php echo htmlspecialchars($row['jambScore']); ?></td>
                            <td>
                                <span class="status-badge <?php echo strtolower($row['admissionStatus'] ?? 'undecided'); ?>">
                                    <?php echo htmlspecialchars($row['admissionStatus'] ?? 'undecided'); ?>
                                </span>
                            </td>
                            <td>
                                <a href="profile.php?id=<?php echo $row['id'] ?>" class="view-action-btn"><i class="fa-regular fa-eye"></i></a>
                            </td>
                        </tr>
                    <?php
                    }
                } else {
                    ?>
                    <tr>
                        <td colspan="6" style="text-align: center; padding: 40px; background: #d1ecf1;">
                            <i class="fa-solid fa-folder-open" style="font-size: 48px; color: #888; margin-bottom: 15px;"></i>
                            <h3 style="color: #1e1e1e; margin-bottom: 5px;">No Student Record Found</h3>
                            <p style="color: #555; font-size: 14px;">No records matched your combined query filter options criteria.</p>
                        </td>
                    </tr>
                <?php
                }
                ?>
            </tbody>
        </table>
    </div>

</div>

<?php
$headerStyle = 'active';
include('./HeaderFooter/ProfileFooter.php'); ?>