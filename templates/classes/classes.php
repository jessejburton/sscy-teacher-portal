<div class="container" ng-controller="classController" ng-init="getClasses()">
    <h2 class="u-bottom-space">Classes</h2>

    <!-- Select a teacher -->
    <div class="input-group u-bottom-space" ng-show="<?php echo $_SESSION['is_admin']; ?>">
        <label for="teacher_select" class="label-select">Select a Teacher</label>
        <select class="input-select input-select-inline"
                ng-model="selectedTeacher" 
                ng-change="getClasses()"
                ng-options="teacher.name for teacher in teachers track by teacher.account_id">
        </select>
        <button class="button button__add-class" ng-click="addClass()"><i class="fas fa-plus"></i> Add Class</button>
    </div>

    <div style="padding: 10px 0; font-size: .8em; text-align: right;">
        Class appears on the website <span class="u-box"></span><br />
        Class does not appear on the website <span class="outdated u-box"></span><br />
    </div>

    <div class="row class" ng-repeat="class in classes" ng-cloak ng-class="{outdated: class.active == 0}">
        
        <!-- Class Name -->
        <h3 class="class__name">
            {{class.name}} 
        </h3>

        <!--- Teacher Name --->
        <?php if( $_SESSION['is_admin'] ){ ?>
            <h4>by {{class.teacher_name}}</h4>
        <?php } ?>

        <!-- Class Description -->
        <p class="class__description">{{class.description}}</p>
        
        <!-- Class Schedule -->
        <div class="class__schedule" ng-repeat="schedule in class.schedules">
            <div data-teacher="{{ schedule.teacher }}">

                <p>
                    <!-- Schedule -->
                    <strong>{{ schedule.days | daysOfWeek }}'s</strong> at 
                    <strong>
                        {{ schedule.start_time | formatTime }} - {{ schedule.end_time | formatTime }}
                    </strong> in 
                
                    <!-- Room -->
                    <strong>{{ schedule.room_name }}</strong> 

                    <!-- Class Running Dates -->                
                    <span ng-if="class.date_from.length > 0">
                        from <strong>{{ class.date_from }}</strong>
                    </span>
                    <span ng-if="class.date_until.length > 0">
                        until <strong>{{ class.date_until }}</strong>
                    </span>
                </p>

                <br />

                <p>
                    <!-- Options -->
                    <small class="links">    
                        <?php if(  $_SESSION['is_admin'] ){ ?>
                            <a class="no-left-margin" href="javascript:void(0);" ng-click="showExceptions(class.class_id)">
                                <i class="far fa-calendar-alt"></i> add notice
                            </a> 
                        <?php } ?>
                        <a href="javascript:void(0);" ng-click="quickCancel(class.class_id)">
                            <i class="fas fa-ban"></i> quick cancel
                        </a>
                        <a href="javascriptio:void(0);" ng-click="editClass(class);">
                            <i class="fas fa-edit"></i> edit class
                        </a>
                        <!--<a href="javascriptio:void(0);" ng-click="removeClass(class);" class="admin">
                            <i class="far fa-times-circle"></i> remove class
                        </a>--> 
                    </small>
                </p>

            </div>
        </div>

        <!-- Class Exceptions -->
        <div class="class__exceptions" ng-if="class.exceptions.length > 0">
            <div class="class__exception" ng-repeat="exception in class.exceptions">
                <div class="class__exception--message exception-{{exception.type}} exception-{{exception.exception_id}}" data-classname="{{class.name}}">
                    {{exception.date | date : 'fullDate'}} ~ {{exception.message}} 
                    <small class="links" ng-if="exception.exception_id > 0">
                        <a href="javascript:void(0);" data-exceptionid="{{exception.exception_id}}" ng-click="removeException(exception.exception_id)"><i class="far fa-times-circle"></i> remove exception</a>
</small>
                </div>
            </div>            
        </div>

    </div>

    <!-- Include the Exception Sidebar -->
    <?php require_once('exception.php'); ?>

    <!-- Include the Class Form -->
    <?php require_once('class__form.php'); ?>

</div>