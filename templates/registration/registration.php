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

    <div class="row registrant-list" style="padding-top: 40px; opacity: 0;">
        <h3>Total Amount Collected</h3>
        <p style="padding-bottom: 50px;">
            <span>$</span><input type="text" class="input-text input-text-inline" style="width: 200px;" placeholder="Amount Collected" ng-model="amount_collected" />
            <button class="button button--checkin" ng-click="saveAmount()" title="Save amount collected for class">✔ SAVE</button>
        </p>

        <h3>Registrants</h3>

        <div class="registrants__autoreply autoreply-{{ message.type }}">{{ message.text }}</div>

        <table class="table" id="registrant-table">
            <thead>
                <tr>
                    <th>First Name</th>
                    <th>Last Name</th>
                    <th>Email</th>
                    <th style="width: 120px;">Checked In</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td><input type="text" class="input-text" placeholder="first name" ng-model="registrant.name_first" /></td>
                    <td><input type="text" class="input-text" placeholder="last name" ng-model="registrant.name_last" /></td>
                    <td><input type="text" class="input-text" placeholder="email" ng-model="registrant.email" /></td>         
                    <td><button class="button button--checkin" ng-click="addRegistrant()" title="Check this person in">CHECK IN</button></td>
                </tr>
                <tr ng-repeat="r in registrants">
                    <td>{{r.name_first}}</td>
                    <td>{{r.name_last}}</td>
                    <td><a href="mailto:{{r.email}}">{{r.email}}</a></td>
                    <td>
                        <button class="button button--checkin" ng-click="checkinRegistrant(r)" ng-if="r.checked_in == null || r.checked_in == 0">Check In</button>
                        <span ng-if="r.checked_in == 1">Checked In</span>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>

</div>