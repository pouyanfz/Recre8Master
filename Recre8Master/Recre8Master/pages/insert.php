<!-- (C) Pouyan Forouzandeh -->
<!-- Insert Page -->
<?php include('../components/header.php'); ?>
<main>
    <form method="POST">
        <div class="card">
            <div class="card-header">
                <h5 class="card-title">Add a Reservation</h5>
            </div>
            <div class="card-body">
                <p class="card-text">
                    Enter information of a new Reservation:
                </p>
                <div class="input-group mb-2">
                    <label for="NoOfGuest" class="input-group-text">Number of Guests &nbsp;<span class="error">*</span></label>
                    <input type="number" class="form-control" id="NoOfGuest" name="NoOfGuest" required />
                </div>
                <div class="input-group mb-2">
                    <label class="input-group-text">
                        Showing Up?
                        &nbsp;
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="ShowingUp" id="ShowingUpYes" value="1" />
                            <label class="form-check-label" for="inlineRadio1">Yes</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="ShowingUp" id="ShowingUpNo" value="0" />
                            <label class="form-check-label" for="inlineRadio2">No</label>
                        </div>
                    </label>
                </div>
                <div class="input-group mb-2">
                    <label for="TimeInterval" class="input-group-text">Time Interval (minutes) &nbsp;<span class="error">*</span></label>
                    <input type="number" class="form-control" id="TimeInterval" name="TimeInterval" required />
                </div>
                <div class="input-group mb-2">
                    <label for="ReservationDate" class="input-group-text">Reservation Date and Time &nbsp;<span class="error">*</span></label>
                    <input type="datetime-local" class="form-control" name="ReservationDate" required />
                </div>
                <div class="input-group mb-2">
                    <label for="BuildingName" class="input-group-text">Building Name &nbsp;<span class="error">*</span></label>
                    <input type="text" class="form-control" id="BuildingName" name="BuildingName" required />
                </div>
                <div class="input-group mb-2">
                    <label for="FacilityName" class="input-group-text">Facility Name &nbsp;<span class="error">*</span></label>
                    <input type="text" class="form-control" id="FacilityName" name="FacilityName" required />
                </div>
                <div class="input-group mb-4">
                    <label for="StaffID" class="input-group-text">Staff ID &nbsp;<span class="error">*</span></label>
                    <input type="number" class="form-control" id="StaffID" name="StaffID" required />
                </div>
                <div class="inlineGroup">
                    <button type="submit" class="btn btn-primary" name="Submit">Reserve</button>
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
            $sql = "INSERT INTO Reservation (NoOfGuest, ShowingUp, TimeInterval, ReservationDate,BuildingName,FacilityName, StaffID ) VALUES (:NoOfGuest, :ShowingUp, :TimeInterval, :ReservationDate, :BuildingName, :FacilityName, :StaffID);";
            try {
                $conn = new PDO("mysql:host=$servername; dbname=$dbname", $username, $password);
                $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                $showingUpValue = isset($_POST['ShowingUp']) ? $_POST['ShowingUp'] : NULL;
                $stmnt = $conn->prepare($sql);
                $stmnt->bindParam(':NoOfGuest', $_POST['NoOfGuest']);
                $stmnt->bindParam(':ShowingUp', $showingUpValue);
                $stmnt->bindParam(':TimeInterval', $_POST['TimeInterval']);
                $stmnt->bindParam(':ReservationDate', $_POST['ReservationDate']);
                $stmnt->bindParam(':BuildingName', $_POST['BuildingName']);
                $stmnt->bindParam(':FacilityName', $_POST['FacilityName']);
                $stmnt->bindParam(':StaffID', $_POST['StaffID']);
                $stmnt->execute();
                echo '<script type="text/javascript">
                    const ele = document.getElementById("feedbackMessage");
                    ele.className = "success";
                    ele.innerHTML = "Data Inserted";
                </script>';
            } catch (PDOException $e) {
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