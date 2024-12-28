<!-- (C) Pouyan Forouzandeh -->
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
            $servername = "localhost";
            $username = "root";
            $password = "";
            $dbname = "Recre8MasterPouyan";

            try {
                $conn = new PDO("mysql:host=$servername; dbname=$dbname", $username, $password);
                $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            } catch (PDOException $e) {
                echo '<script type="text/javascript">
                document.getElementById("errorMessage").innerHTML = "Could not connect to server: ' . $e->getMessage() . '");
                </script>';
            }

            $sql = "SELECT * FROM Reservation;";
            try {
                $stmnt = $conn->prepare($sql);
                $stmnt->execute();
                $rows = $stmnt->fetchAll();

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
                    // throw new Exception('No reservations yet!');
                }
            } catch (Exception $e) {
                echo '<script type="text/javascript">
                    const ele = document.getElementById("feedbackMessage");
                    ele.className = "error";
                    ele.innerHTML = errorMessageCreator_insert("' . $e->getMessage() . '");
                    </script>';
            }
            unset($conn);
            ?>
        </tbody>
    </table>
</div>
