<!-- (C) Pouyan Forouzandeh -->
<!-- View Page -->
<?php include('../components/header.php'); ?>
<main>
    <form method="POST">
        <div class="card">
            <div class="card-header">
                <h5 class="card-title">View Reservations</h5>
            </div>
            <div class="card-body">
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
                <div class="inlineGroup">
                    <button type="submit" class="btn btn-primary" name="Submit">Select</button>
                    <div id="feedbackMessage"></div>
                </div>
            </div>
        </div>


        <?php
        if (isset($_POST['Submit']) && isset($_POST['ViewSelection'])) {
            $view = $_POST['ViewSelection'];
            $redirectUrl = "#";
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
</main>
<?php include('../components/footer.php'); ?>