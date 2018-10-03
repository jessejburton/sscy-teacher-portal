<div class="container" ng-controller="reportController" ng-init="getClasses()">

    <h2>Reports</h2>

    <div class="row">
        <div class="col-1-of-3">
            <!-- Select a teacher -->
            <div class="input-group u-bottom-space"">
                <label for="teacher_select" class="label-select">Select a Teacher</label>
                <select class="input-select input-select-inline"
                        ng-model="selectedTeacher" 
                        ng-change="getReport()"
                        ng-options="teacher.name for teacher in teachers track by teacher.account_id">
                </select>                
            </div>
        </div>
        <div class="col-1-of-3">
            <!-- Select a month -->
            <div class="input-group u-bottom-space"">
                <label for="teacher_select" class="label-select">Select a Month</label>
                <select class="input-select input-select-inline"
                        ng-model="selectedMonth" 
                        ng-change="getReport()"
                        ng-options="month for month in months">
                </select>                
            </div>
        </div>    
        <div class="col-1-of-3">
            <!-- Select a year -->
            <div class="input-group u-bottom-space"">
                <label for="teacher_select" class="label-select">Select a Year</label>
                <select class="input-select input-select-inline"
                        ng-model="selectedYear" 
                        ng-change="getReport()"
                        ng-options="year for year in years">
                </select>                
            </div>
        </div>    
    </div>

    <div id="report" class="row report hidden" style="padding-top: 40px;">

        <h3>Report for {{ selectedTeacher.name }} ~ {{ selectedMonth }}, {{ selectedYear }}</h3>

        <table>
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
                <tr ng-repeat="row in report">
                    <td>{{ row.class_name }}</td>
                    <td>{{ row.room_name }}</td>
                    <td>{{ row.date_class | date:'MMM, d yyyy' }}</td>
                    <td>{{ row.registrants }}</td>
                    <td>{{ row.amount | currency }}</td>
                    <td>{{ row.rate | currency }}</td>
                </tr>
            </tbody>
            <tfoot>
                <tr>
                    <td colspan="5" style="text-align: right;">Total:</td>
                    <td>{{ reportTotal | currency }}</td>
                </tr>
            </tfoot>
        </table>

    </div>

</div>