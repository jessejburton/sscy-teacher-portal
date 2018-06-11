<div class="container" ng-controller="classController" ng-init="getClasses()">
    <h2>Your Classes</h2>

    <div class="row class" ng-repeat="class in classes" ng-cloak>
        <h3 class="class__name">{{class.name}}</h3>
        <p class="class__description">{{class.description}}</p>
        <div class="class__schedule" ng-repeat="schedule in class.schedules">
            <p><strong>{{ schedule.days | daysOfWeek }}'s</strong> at <strong>{{ schedule.start_time | formatTime }} - {{ schedule.end_time | formatTime }}</strong> in <strong>{{schedule.room_name }}</strong> | <a href="javascript:void(0);" ng-click="showExceptions(class.name)">add exception</a></p>
        </div>
    </div>

    <!-- Include the Exception Sidebar -->
    <?php require_once('exception.php'); ?>

</div>