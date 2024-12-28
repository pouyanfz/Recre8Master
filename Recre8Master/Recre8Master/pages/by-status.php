<!-- (C) Pouyan Forouzandeh -->
<!-- View By Status -->
<?php include('../components/header.php'); ?>
<main>
    <div class="card">
        <div class="card-header">
            <h5 class="card-title">View Reservations</h5>
        </div>
        <div class="card-body">
            <form method="POST">
                <p class="card-text">
                    Select one of the filters bellow to view the reservations:
                </p>
                <div class="input-group mb-2">
                    <label for="ViewSelection" class="input-group-text">Filter</label>
                    <select class="form-select" id="ViewSelection" name="ViewSelection">
                        <option>Select...</option>
                        <option value="all">Show All Reservations</option>
                        <option value="byFacility">Search by Facility</option>
                        <option value="byStatus">Search by Status</option>
                        <option value="byDate">Search by Date</option>
                        <option value="byId">Search by Reservation ID</option>
                    </select>
                </div>
                <button type="submit" class="btn btn-primary" name="Submit">Select</button>

                <?php
                if (isset($_POST['Submit']) && isset($_POST['ViewSelection'])) {
                    $view = $_POST['ViewSelection'];
                    $redirectUrl = "./view.php";
                    switch ($view) {
                        case "all":
                            $redirectUrl = './all-reservation.php';
                            break;
                        case "byFacility":
                            $redirectUrl = './by-facility.php';
                            break;
                        case "byStatus":
                            $redirectUrl = './by-status.php';
                            break;
                        case "byDate":
                            $redirectUrl = './by-date.php';
                            break;
                        case "byId":
                            $redirectUrl = './by-id.php';
                            break;
                    }

                    header("Location: $redirectUrl");
                }
                ?>
            </form>


            <form method="POST">
                <br />
                <h5 class="card-title">Search by Status</h5>
                <div class="input-group mb-2">
                    <label class="input-group-text">
                        Select status:
                        &nbsp;
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="ShowingUp" id="ShowingUpYes" value="1" />
                            <label class="form-check-label" for="inlineRadio1">Showed Up</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="ShowingUp" id="ShowingUpNo" value="0" />
                            <label class="form-check-label" for="inlineRadio2">Did Not Show Up</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="ShowingUp" id="ShowingUpNo" value="NULL" />
                            <label class="form-check-label" for="inlineRadio2">Pending</label>
                        </div>
                    </label>

                </div>
                <div class="inlineGroup">
                    <button type="submit" class="btn btn-primary" name="Submit2">View</button>
                    <div id="feedbackMessage"></div>
                </div>
                <br />
                <div class="card">
                    <table class="table table-hover">
                        <thead>
                            <tr class="table-secondary">
                                <th scope="col">Reservation ID</th>
                                <th scope="col"># of Guest</th>
                                <th scope="col">Showing Up?</th>
                                <th scope="col">Time Interval</th>
                                <th scope="col">Reservation Date</th>
                                <th scope="col">Building Name</th>
                                <th scope="col">Facility Name</th>
                                <th scope="col">Staff ID</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            if (isset($_POST['Submit2']) && isset($_POST['ShowingUp'])) {

                                $servername = "localhost";
                                $username = "root";
                                $password = "";
                                $dbname = "Recre8MasterPouyan";
                                try {
                                    $conn = new PDO("mysql:host=$servername; dbname=$dbname", $username, $password);
                                    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

                                    //select by showing up
                                    $showingUpValue = $_POST['ShowingUp'];
                                    $rows = NULL;
                                    if ($showingUpValue === 'NULL') {
                                        $sql = "SELECT * FROM Reservation WHERE ShowingUp IS NULL";

                                        $stmnt = $conn->prepare($sql);
                                        $stmnt->execute();
                                        $rows = $stmnt->fetchAll();
                                    } else {
                                        $sql = "SELECT * FROM Reservation WHERE ShowingUp = :ShowingUp";

                                        $stmnt = $conn->prepare($sql);
                                        $stmnt->bindParam(':ShowingUp', $_POST['ShowingUp']);
                                        $stmnt->execute();
                                        $rows = $stmnt->fetchAll(); // Use fetchAll() to get all matching rows

                                    }
                                    if ($rows) {
                                        foreach ($rows as $row) {
                                            echo "<tr>";
                                            echo "<th scope='row'>" . $row['ReservationID'] . "</th>";
                                            echo "<td>" . $row['NoOfGuest'] . "</td>";
                                            echo "<td>" . ($row['ShowingUp'] == '1' ? 'Yes' : ($row['ShowingUp'] == '0' ? 'No' : 'Not specified')) . "</td>";
                                            echo "<td>" . $row['TimeInterval'] . "</td>";
                                            echo "<td>" . $row['ReservationDate'] . "</td>";
                                            echo "<td>" . $row['BuildingName'] . "</td>";
                                            echo "<td>" . $row['FacilityName'] . "</td>";
                                            echo "<td>" . $row['StaffID'] . "</td>";
                                            echo "</tr>";
                                        }
                                    } else {
                                        echo "<tr> <td class='error'>Empty!</td><td></td><td></td><td></td><td></td><td></td><td></td><td></td> </tr>";
                                    }
                                } catch (PDOException $e) {
                                    echo '<script type="text/javascript">
                                    const ele = document.getElementById("feedbackMessage");
                                    ele.className = "error";
                                    ele.innerHTML = errorMessageCreator_other("' . $e->getMessage() . '");
                                    </script>';
                                }
                                unset($conn);
                            }
                            ?>

                        </tbody>
                    </table>
                </div>
            </form>
        </div>
    </div>
</main>
<?php include('../components/footer.php'); ?>