<div class="container" ng-controller="classController" ng-init="getClasses()">
    <h2 class="u-bottom-space">Your Classes</h2>

    <!-- Select a teacher -->
    <div class="input-group u-bottom-space" ng-show="<?php echo $_SESSION['is_admin']; ?>">
        <label for="teacher_select" class="label-select">Select a Teacher</label>
        <select class="input-select"
                ng-model="selectedTeacher" 
                ng-change="getClasses()"
                ng-options="teacher.name for teacher in teachers track by teacher.account_id">
        </select>
    </div>

    <div class="row class" ng-repeat="class in classes" ng-cloak>
        
        <!-- Class Details -->
        <h3 class="class__name">{{class.name}}</h3>
        <p class="class__description">{{class.description}}</p>
        
        <!-- Class Schedule -->
        <div class="class__schedule" ng-repeat="schedule in class.schedules">
<p data-teacher="{{ schedule.teacher }}"><strong>{{ schedule.days | daysOfWeek }}'s</strong> at <strong>{{ schedule.start_time | formatTime }} - {{ schedule.end_time | formatTime }}</strong> in <strong>{{schedule.room_name }}</strong> | <a href="javascript:void(0);" ng-click="showExceptions(class.class_id)">add exception</a> | <a href="javascript:void(0);" ng-click="quickCancel(class.class_id)">quick cancel</a></p>
        </div>

        <!-- Class Exceptions -->
        <div class="class__exceptions">
            <div class="class__exception" ng-repeat="exception in class.exceptions">
                <div class="class__exception--message exception-{{exception.type}} exception-{{exception.exception_id}}" data-classname="{{class.name}}">
                    {{exception.date | date : 'fullDate'}} ~ {{exception.message}} 
                    <span ng-if="exception.exception_id > 0">
                        | <a href="javascript:void(0);" data-exceptionid="{{exception.exception_id}}" ng-click="removeException(exception.exception_id)">remove</a>
                    </span>
                </div>
            </div>            
        </div>

    </div>

    <!-- Include the Exception Sidebar -->
    <?php require_once('exception.php'); ?>

</div>