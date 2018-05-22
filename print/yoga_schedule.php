<?php

    // Set up the database connection
    require_once('mysql_connect.php');

    $qry = "
        SELECT c.*, cs.*, t.*, a.* 
        FROM class_weekly_schedule_tbl cs 
        LEFT JOIN class_tbl c ON c.class_id = cs.class_id
        LEFT JOIN teacher_tbl t ON c.teacher_id = t.teacher_id 
        LEFT JOIN account_tbl a ON t.account_id = a.account_id    
    " ;

    $qry_results = @mysqli_query($sscy_database, $qry);
 
    while ($entry = @mysqli_fetch_object($qry_results)) {
        $qry_classes[] = $entry;
    }

    $arr_classes = [];

    // Create blank arrays for all of the days.
    for ($i = 0; $i <= 6; $i++) { 
        $arr_classes[$i] = [];
    }

    foreach( $qry_classes as $class ){
        $days = explode(",", $class->days_of_week);
        
        foreach( $days as $day ){
            array_push($arr_classes[$day], $class);
        }

    }

    $today = date('w');
    $current_date = date(strtotime('-'.$today.' days'));
    
    require_once('header.php');

    ?>
        <div class="wrapper">
            <div class="logo"><?php require_once( 'logo-svg.php' ); ?></div>
            
            <h2>Yoga Class Schedule</h2>
        
            <table class="table table--class">
                <tbody>

                    <?php for ($i = 0; $i <= 6; $i++){ ?>   
                        
                        <!-- Display the date heading -->
                        <tr class="class-date">
                            <td colspan="3"><h3><?php echo date('l', $current_date); ?></h3></td>
                        </tr>

                        <?php if (sizeof($arr_classes[$i]) == 0) { ?>
                            <tr class="class">
                                <td colspan="3"><strong>No Classes</strong></td>
                            </tr>
                        <?php } ?>
                        
                        <!-- Get the classes for the current day -->
                        <?php foreach ( $arr_classes[$i] as $class) { 
                            
                            // Set up the times
                            $start_time = date_create('2000-01-01 ' . $arr_classes[0][0]->start_time)->format('g:iA'); 
                            $end_time = date_create('2000-01-01 ' . $arr_classes[0][0]->end_time)->format('g:iA'); 

                        ?> 

                            <tr class="class">
                                <td><?php echo $start_time . ' - ' . $end_time; ?></td>
                                <td><?php echo $class->name; ?></td>
                                <td><?php echo $class->name_first . ' ' . $class->name_last; ?></td>
                            </tr>

                        <?php }

                        // Add one day to the current date being displayed.
                        $current_date = date(strtotime('+1 days', $current_date));
                    } ?>

                </tbody>
            </table>
        </div><!-- wrapper -->

<?php require_once('footer.php'); ?>    