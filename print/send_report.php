<?php

    // Set up the database connection
    require_once('../mysql_connect.php');

    if( isset($_GET["year"]) && isset($_GET["month"]) && isset($_GET["teacher"]) ) {
        $year = $_GET["year"];
        $month = $_GET["month"];
        $teacher_id = $_GET["teacher"];
    } else {
        echo "You must specify a teacher, year and month to send the report";
        die();        
    }

    $qry = "SELECT 
            ca.amount, c.name AS class_name, ca.date_class, COUNT(r.registration_id) AS registrants, rm.name AS room_name, rm.rate, IF(ca.amount > 50, rm.rate, 0) AS charge, 'Jesse' AS teacher
        FROM class_amount_tbl ca
        INNER JOIN class_tbl c ON c.class_id = ca.class_id
        INNER JOIN registration_tbl r ON r.class_id = ca.class_id AND r.date_class = ca.date_class     
        INNER JOIN class_weekly_schedule_tbl cws ON c.class_id = cws.class_id 
        INNER JOIN room_tbl rm ON cws.room_id = rm.room_id
        WHERE   MONTH(ca.date_class) = $month
        AND     YEAR(ca.date_class) = $year
        AND     ca.class_id IN (SELECT class_id FROM class_tbl WHERE teacher_id = $teacher_id)
        GROUP BY ca.class_id, ca.date_class
        ORDER BY c.name" ;

    $qry_results = @mysqli_query($dbc, $qry);
    
    while ($entry = @mysqli_fetch_object($qry_results)) {
        $qry_rows[] = $entry;
    }

    $reportTotal = 0;

    $months = [
        "January",
        "February",
        "March",
        "April",
        "May",
        "June",
        "July",
        "August",
        "September",
        "October",
        "November",
        "December"
    ];

    require_once('header.php');

    ?>
        <div class="wrapper">
           
            <h2>Report for <?php echo $qry_rows[0]->teacher ?> ~ <?php echo $months[$month - 1]; ?>, <?php echo $year; ?></h2>
        
            <table class="table table--class">
                <thead>
                    <tr>
                        <th>Class</th>
                        <th>Room</th>
                        <th>Date</th>
                        <th>Registrants</th>
                        <th>Amount</th>
                        <th>Fee</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ( $qry_rows as $row) { ?>
                        <tr>
                            <td><?php echo $row->class_name; ?></td>
                            <td><?php echo $row->room_name; ?></td>
                            <td><?php echo $row->date_class; ?></td>
                            <td><?php echo $row->registrants; ?></td>
                            <td><?php echo currency($row->amount); ?></td>
                            <td><?php echo currency($row->charge); ?></td>
                        </tr>
                    <?php 
                        $reportTotal += $row->charge;
                        } 
                    ?>
                </tbody>
                <tfoot>
                    <tr>
                        <td colspan="5" style="text-align: right;">Total:</td>
                        <td><?php echo currency($reportTotal); ?></td>
                    </tr>
                </tfoot>
            </table>
        </div><!-- wrapper -->

<?php
    function currency($number){
        return "$".number_format($number, 2);
    }
?>

<?php require_once('footer.php'); ?>    