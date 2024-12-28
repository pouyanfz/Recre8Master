<!-- (C) Pouyan Forouzandeh -->
<!-- Delete Resrvation -->
<?php include('../components/header.php'); ?>
<main>
    <form method="post">
        <div class="card">
            <div class="card-header">
                <h5 class="card-title">Delete a Reservation</h5>
            </div>
            <div class="card-body">
                <p class="card-text">
                    Enter Reservation ID to delete:
                </p>
                <div class="input-group mb-4">
                    <label for="inputUname" class="input-group-text">Reservation ID &nbsp;<span class="error">*</span></label>
                    <input type="number" class="form-control" id="ReservationID" name="ReservationID" required />
                </div>
                <div class="inlineGroup">
                    <button type="submit" class="btn btn-primary" name="Submit">Delete</button>
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
            $sql = "DELETE FROM Reservation WHERE ReservationID = :ReservationID;";
            try {
                $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
                $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

                $stmnt = $conn->prepare($sql);
                $stmnt->bindParam(':ReservationID', $_POST['ReservationID']);
                $stmnt->execute();

                $rowCount = $stmnt->rowCount();

                if ($rowCount > 0) {
                    echo '<script type="text/javascript">
                        const ele = document.getElementById("feedbackMessage");
                        ele.className = "success";
                        ele.innerHTML = "Reservation deleted successfully";
                    </script>';
                } else {
                    throw new Exception('No matching Reservation ID found. Nothing was deleted.');
                }
            } catch (Exception $e) {
                echo '<script type="text/javascript">
                    const ele = document.getElementById("feedbackMessage");
                    ele.className = "error";
                    ele.innerHTML = errorMessageCreator_other("' . $e->getMessage() . '");
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