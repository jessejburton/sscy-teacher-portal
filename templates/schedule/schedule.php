<div class="container" ng-controller="classController" ng-init="getAllClasses()">
    <h2 class="u-bottom-space">Schedule</h2>

    <table>
        <thead>
            <tr>
                <th>Class</th>
                <th>Teacher</th>
                <th>Room</th>
                <th>Day</th>
                <th>Time</th>
                <th>From</th>
                <th>Until</th>
            </tr>
        </thead>
        <tbody>
            <tr ng-repeat="class in allClasses">
                <td>{{ class.name }}</td>
                <td>{{ class.teacher }}</td>
                <td>{{ class.room }}</td>
                <td>{{ class.day }}</td>
                <td>{{ class.start_time }} - {{ class.end_time }}</td>
                <td>{{ class.date_from }}</td>
                <td>{{ class.date_to }}</td>
            </tr>
        </tbody>
    </table>

    <!-- Include the Class Form -->
    <?php require_once('class__form.php'); ?>

</div>