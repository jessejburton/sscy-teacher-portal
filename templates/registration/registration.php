<div class="container" ng-controller="registrationController" ng-init="getClasses()">

    <h2>Registration</h2>

    <div class="row">
        <div class="col-1-of-2">
            <label>Class</label>
            <select class="input-select" id="class_select" 
                ng-model="class" 
                ng-options="class.name for class in classes track by class.class_id">
            </select>
        </div>
        <div class="col-1-of-2">
            <label>Date</label>
            <datepicker date-format="EEEE, MMMM d, yyyy" 
                        date-disabled-weekdays="{{exception.invalid_days}}">
                  <input name="exception_date"
                        id="exception_date"
                        ng-model="exception.date" 
                        type="text" 
                        placeholder="select a date"  
                        class="exceptions_datepicker date-picker input-text input-date" 
                        data-day="{{exception.class.days}}"
                        required />
                  <label for="exception_date"><i class="fas fa-calendar-alt"></i></label>
            </datepicker>
        </div>
    </div>

    <div class="row" style="padding-top: 40px;" ng-if="show" ng-cloak>
        <h3>Registrants</h3>

        <table class="table" id="registrant-table">
            <thead>
                <tr>
                    <th>First Name</th>
                    <th>Last Name</th>
                    <th>Email</th>
                    <th>PR</th>
                    <th>KY</th>
                    <th>Amount</th>
                    <th style="width: 120px;">Check In</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td><input type="text" class="input-text" placeholder="first name" ng-model="registrant.name_first" /></td>
                    <td><input type="text" class="input-text" placeholder="last name" ng-model="registrant.name_last" /></td>
                    <td><input type="text" class="input-text" placeholder="email" ng-model="registrant.email" /></td>
                    <td><input type="checkbox" class="registration-checkbox" ng-model="registrant.is_ky" /></td>
                    <td><input type="checkbox" class="registration-checkbox" ng-model="registrant.is_pr" /></td>
                    <td>
                        <span style="position: absolute;margin-top: 6px;">$</span> 
                        <input type="text" class="registration-amount input-text-inline" value="16" />
                    </td>               
                    <td><button class="button registration-new">CHECK IN</button></td>
                </tr>
                <tr ng-repeat="registrant in registrants">
                    <td>{{registrant.name_first}}</td>
                    <td>{{registrant.name_last}}</td>
                    <td><a href="mailto:{{registrants.email}}">{{registrant.email}}</a></td>
                    <td><input type="checkbox" class="registration-checkbox" ng-true-value="{{registrant.is_ky}}" /></td>
                    <td><input type="checkbox" class="registration-checkbox" ng-true-value="{{registrant.is_pr}}" /></td>
                    <td>
                        <span style="position: absolute;margin-top: 6px;">$</span> 
                        <input type="text" class="registration-amount input-text-inline" value="{{registrant.paid}}" />
                    </td>
                    <td><button class="button registration-checkin">CHECK IN</button></td>
                </tr>
            </tbody>
        </table>
    </div>

</div>