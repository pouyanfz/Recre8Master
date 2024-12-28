<!-- (C) Pouyan Forouzandeh -->
<!-- Home Page -->
<?php include('../components/header.php'); ?>
<main id="homepage">
    <form method="post">
        <img id="rec8Image" src="../img/Header.png">
        <br />
        <br />
        <fieldset class="setup">
            <legend style="font-weight: bold; text-shadow: 2px 2px 10px #898989" ; "FormTitle">Setup</legend>
            <table>
                <tr>
                    <td><input type="submit" name="TestServerConnection" class="btn btn-outline-secondary setupButtonLg" value="Test Server Connection" id="server_status"></td>
                </tr>
                <tr>
                    <td>
                        <input type="submit" name="CreateDB" class="btn btn-outline-secondary setupButton" value="Create Database" id="database_create" />
                        <input type="submit" name="DeleteDB" class="btn btn-outline-secondary setupButton" value="Delete Database" id="database_delete" />
                    </td>
                    <td id="database_status" class="status"></td>
                </tr>
                <tr>
                    <td>
                        <input type="submit" name="CreateTable" class="btn btn-outline-secondary setupButton" value="Create Table" id="table_create" />
                        <input type="submit" name="DeleteTable" class="btn btn-outline-secondary setupButton" value="Delete Table" id="table_delete" />
                    </td>
                    <td id="table_status" class="status"></td>
                </tr>

            </table>
            <div id="feedbackMessage"></div>
            <?php
            $servername = "localhost";
            $username = "root";
            $password = "";
            $dbname = "Recre8MasterPouyan";

            try {
                $conn = new PDO("mysql:host=$servername", $username, $password);
                $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            } catch (PDOException $e) {
                echo '<p class="error">Could not connect to server: ' . $e->getMessage() . '</p>';
            }

            if (isset($_POST['TestServerConnection'])) {  //server connection test button
                try {
                    $conn = new PDO("mysql:host=$servername", $username, $password);
                    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                    echo '<script type = "text/javascript">
                        document.getElementById("server_status").value = "Server Connected";
                        document.getElementById("server_status").className = "btn btn-success setupButtonLg";
                        </script>';
                } catch (PDOException $e) {
                    echo '<script type = "text/javascript">
                        document.getElementById("server_status").value = "Server Connection Error";
                        document.getElementById("server_status").className = "btn btn-danger setupButtonLg";
                        </script>';
                    echo '<script type="text/javascript">
                        const ele = document.getElementById("feedbackMessage");
                        ele.className = "error";
                        ele.innerHTML = errorMessageCreator_HomePage("' . $e->getMessage() . '");
                    </script>';
                }
                //create database button
            } else if (isset($_POST['CreateDB'])) {
                $sql = "CREATE DATABASE  " . $dbname . "";
                try {
                    $conn->exec($sql);
                    echo '<script type="text/javascript">
                        document.getElementById("database_create").value = "Database Created";
                        document.getElementById("database_create").className = "btn btn-success setupButton";
                        </script>';
                } catch (PDOException $e) {
                    echo '<script type="text/javascript">
                        document.getElementById("database_create").value = "Database Creation Error";
                     document.getElementById("database_create").className = "btn btn-danger setupButton";
                        </script>';
                    echo '<script type="text/javascript">
                        const ele = document.getElementById("feedbackMessage");
                        ele.className = "error";
                        ele.innerHTML = errorMessageCreator_HomePage("' . $e->getMessage() . '");
                 </script>';
                }
                //delete database button
            } else if (isset($_POST['DeleteDB'])) {
                $sql = "DROP DATABASE  " . $dbname . "";
                try {
                    $conn->exec($sql);
                    echo '<script type="text/javascript">
                        document.getElementById("database_delete").value = "Database Deleted";
                         document.getElementById("database_delete").className = "btn btn-success setupButton";
                        </script>';
                } catch (PDOException $e) {
                    echo '<script type="text/javascript">
                         document.getElementById("database_delete").value = "Database Deletion Error";
                         document.getElementById("database_delete").className = "btn btn-danger setupButton";
                        </script>';
                    echo '<script type="text/javascript">
                        const ele = document.getElementById("feedbackMessage");
                        ele.className = "error";
                        ele.innerHTML = errorMessageCreator_HomePage("' . $e->getMessage() . '");
                    </script>';
                }
                //create table button
            } else if (isset($_POST['CreateTable'])) {
                $sql = "CREATE TABLE " . $dbname . ".Reservation (
                    ReservationID INT PRIMARY KEY AUTO_INCREMENT, 
                    NoOfGuest SMALLINT NOT NULL,
                    ShowingUp TINYINT,
                    TimeInterval SMALLINT NOT NULL,
                    ReservationDate DATETIME NOT NULL,
                    BuildingName CHAR(15) NOT NULL,
                    FacilityName CHAR(15) NOT NULL,
                    StaffID INT NOT NULL
                    );";
                try {
                    $conn->exec($sql);
                    echo '<script type="text/javascript">
                        document.getElementById("table_create").value = "Table Created";
                        document.getElementById("table_create").className = "btn btn-success setupButton";
                        </script>';
                } catch (PDOException $e) {
                    echo '<script type="text/javascript">
                        document.getElementById("table_create").value = "Table Creation Error";
                        document.getElementById("table_create").className = "btn btn-danger setupButton";
                        </script>';
                    echo '<script type="text/javascript">
                        const ele = document.getElementById("feedbackMessage");
                        ele.className = "error";
                        ele.innerHTML = errorMessageCreator_HomePage("' . $e->getMessage() . '");
                        </script>';
                }
                //delete table button
            } else if (isset($_POST['DeleteTable'])) {
                $sql = "DROP TABLE " . $dbname . ".Reservation;";
                try {
                    $conn->exec($sql);
                    echo '<script type="text/javascript">
                        document.getElementById("table_delete").value = "Table Deleted";
                        document.getElementById("table_delete").className = "btn btn-success setupButton";
                        </script>';
                } catch (PDOException $e) {
                    echo '<script type="text/javascript">
                        document.getElementById("table_delete").value = "Table Deletion Error";
                        document.getElementById("table_delete").className = "btn btn-danger setupButton";
                        </script>';

                    echo '<script type="text/javascript">
                        const ele = document.getElementById("feedbackMessage");
                        ele.className = "error";
                        ele.innerHTML = errorMessageCreator_HomePage("' . $e->getMessage() . '");
                    </script>';
                }
            }

            unset($conn);

            ?>
        </fieldset>



    </form>
</main>
<?php include('../components/footer.php'); ?>