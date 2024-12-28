<!-- (C) Pouyan Forouzandeh -->
<!-- Update Page -->
<?php include('../components/header.php'); ?>
<main>
    <form method="POST">
        <div class="card">
            <div class="card-header">
                <h5 class="card-title">Update a Reservation</h5>
            </div>
            <div class="card-body">
                <p class="card-text mb-2">
                    Specify the Reservation you want to change:
                </p>
                <div class="input-group mb-4">
                    <label class="input-group-text">Reservation ID &nbsp;<span class="error">*</span></label>
                    <input type="number" class="form-control" id="ReservationID" name="ReservationID" required />
                </div>
                <p class="card-text mb-2">
                    Fill only the information that you want to change:
                </p>
                <div class="input-group mb-2">
                    <label class="input-group-text">Change Resrvation Date to</label>
                    <input type="datetime-local" class="form-control" name="ReservationDate" />
                </div>
                <div class="input-group mb-2">
                    <label class="input-group-text">Building Name</label>
                    <input type="text" class="form-control" id="BuildingName" name="BuildingName" />
                </div>
                <div class="input-group mb-2">
                    <label class="input-group-text">Facility Name</label>
                    <input type="text" class="form-control" id="FacilityName" name="FacilityName" />
                </div>
                <div class="input-group mb-4">
                    <label class="input-group-text">Staff ID</label>
                    <input type="number" class="form-control" id="StaffID" name="StaffID" />
                </div>
                <div class="inlineGroup">
                    <button type="submit" class="btn btn-primary" name="Submit">Update</button>
                    <div id="feedbackMessage"></div>
                </div>
            </div>
        </div>
        <?php
        $servername = "localhost";
        $username = "root";
        $password = "";
        $dbname = "Recre8MasterPouyan";

        if (isset($_POST['Submit'])) {
            try {
                $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
                $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

                // Check if the reservation exists
                $selectSql = "SELECT * FROM Reservation WHERE ReservationID = :ReservationID;";
                $stmntSelect = $conn->prepare($selectSql);
                $stmntSelect->bindParam(':ReservationID', $_POST['ReservationID']);
                $stmntSelect->execute();

                $existingReservation = $stmntSelect->fetch(PDO::FETCH_ASSOC);

                if ($existingReservation) {
                    // Set SQL string
                    $updateSql = "UPDATE Reservation SET";
                    if (!empty($_POST['ReservationDate'])) {
                        $updateSql .= " ReservationDate = :ReservationDate,";
                    }
                    if (!empty($_POST['BuildingName'])) {
                        $updateSql .= " BuildingName = :BuildingName,";
                    }
                    if (!empty($_POST['FacilityName'])) {
                        $updateSql .= " FacilityName = :FacilityName,";
                    }
                    if (!empty($_POST['StaffID'])) {
                        $updateSql .= " StaffID = :StaffID,";
                    }
                    $updateSql = rtrim($updateSql, ',');
                    $updateSql .= " WHERE ReservationID = :ReservationID;";
                
                    // Bind params
                    $stmntUpdate = $conn->prepare($updateSql);
                    $stmntUpdate->bindParam(':ReservationID', $_POST['ReservationID']);
                    if (!empty($_POST['ReservationDate'])) {
                        $stmntUpdate->bindParam(':ReservationDate', $_POST['ReservationDate']);
                    }
                    if (!empty($_POST['BuildingName'])) {
                        $stmntUpdate->bindParam(':BuildingName', $_POST['BuildingName']);
                    }
                    if (!empty($_POST['FacilityName'])) {
                        $stmntUpdate->bindParam(':FacilityName', $_POST['FacilityName']);
                    }
                    if (!empty($_POST['StaffID'])) {
                        $stmntUpdate->bindParam(':StaffID', $_POST['StaffID']);
                    }

                    $stmntUpdate->execute();
                    echo '<script type="text/javascript">
                        const ele = document.getElementById("feedbackMessage");
                        ele.className = "success";
                        ele.innerHTML = "Data Updated Successfully";
                    </script>';
                } else {
                    throw new Exception('Reservation with the provided ID does not exist.');
                }
            } catch (Exception $e) {
                echo '<script type="text/javascript">
                    const ele = document.getElementById("feedbackMessage");
                    ele.className = "error";
                    ele.innerHTML = errorMessageCreator_insert("' . $e->getMessage() . '");
                </script>';
            }
            unset($conn);
        }
        ?>
    </form>
    <br />
    <?php include('../components/resultTable.php'); ?>
</main>

<?php include('../components/footer.php'); ?>