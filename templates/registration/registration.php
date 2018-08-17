<div class="container" ng-controller="registrationController" ng-init="getClasses()">

    <h2>Registration</h2>

    <div class="row">
        <div class="col-1-of-2">
            <label>Class</label>
            <select class="input-select" id="class_select" 
                ng-model="class" 
                ng-options="class.name for class in classes track by class.class_id"
                ng-change="getRegistrantsByClass()">
            </select>
        </div>
        <div class="col-1-of-2">
            <label>Date</label>
            <datepicker date-format="EEEE, MMMM d, yyyy">
                  <input name="registration_date"
                        id="registration_date"
                        ng-model="registration_date" 
                        ng-change="getRegistrantsByClass()"
                        type="text" 
                        placeholder="select a date"  
                        class="date-picker input-text input-date" 
                        required />
                  <label for="registration_date"><i class="fas fa-calendar-alt"></i></label>
            </datepicker>
        </div>
        <!--<div class="col-1-of-3">
            <input type="button" class="button button--registrants" ng-click="getRegistrantsByClass()" value="Get Registrants">
        </div>-->
    </div>

    <div class="row" style="padding-top: 40px;" ng-if="show" ng-cloak>
        <h3>Registrants</h3>

        <div class="registrants__autoreply autoreply-{{ message.type }}">{{ message.text }}</div>

        <table class="table" id="registrant-table">
            <thead>
                <tr>
                    <th>First Name</th>
                    <th>Last Name</th>
                    <th>Email</th>
                    <th>PR</th>
                    <th>KY</th>
                    <th>Amount</th>
                    <th style="width: 120px;">Checked In</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td><input type="text" class="input-text" placeholder="first name" ng-model="registrant.name_first" /></td>
                    <td><input type="text" class="input-text" placeholder="last name" ng-model="registrant.name_last" /></td>
                    <td><input type="text" class="input-text" placeholder="email" ng-model="registrant.email" /></td>
                    <td><input type="checkbox" class="registration__checkbox registration__checkbox--isPR" ng-model="registrant.is_pr" ng-change="prUpdate()" /></td>
                    <td><input type="checkbox" class="registration__checkbox registration__checkbox--isKY" ng-model="registrant.is_ky" ng-change="kyUpdate()" /></td>
                    <td>
                        <span style="position: absolute;margin-top: 6px;">$</span> 
                        <input type="text" ng-model="registrant.paid" class="registration-amount input-text-inline" ng-disabled=" (registrant.is_pr||registrant.is_ky) ? true : false" />
                    </td>               
                    <td><button class="button button--checkin" ng-click="addRegistrant()" title="Check this person in">CHECK IN</button></td>
                </tr>
                <tr ng-repeat="r in registrants">
                    <td>{{r.name_first}}</td>
                    <td>{{r.name_last}}</td>
                    <td><a href="mailto:{{r.email}}">{{r.email}}</a></td>
                    <td><input type="checkbox" class="registration__checkbox registration__checkbox--isPR" ng-checked="{{r.is_pr}}" ng-model="r.is_pr" ng-change="prUpdate()" /></td>
                    <td><input type="checkbox" class="registration__checkbox registration__checkbox--isKY" ng-checked="{{r.is_ky}}" ng-model="r.is_ky" ng-change="kyUpdate()" /></td>
                    <td>
                        <span style="position: absolute;margin-top: 6px;">$</span> 
                        <input type="text" class="registration-amount input-text-inline" ng-model="r.paid" />
                    </td>
                    <td><button class="button button--checkin" ng-click="checkinRegistrant(r)" title='{{ r.checked_in == 1 | iif : "Save changes made to this person" : "Check this person in"}}'>{{ r.checked_in == 1 | iif : "✔ Save" : "Check In"}}</button></td>
                </tr>
            </tbody>
        </table>
    </div>

</div>