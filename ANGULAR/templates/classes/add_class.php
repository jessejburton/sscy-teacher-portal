<!-- ADD CLASS FORM -->
<form name="add-class-form" class="form" ng-submit="addClass()">
    <h4>{{mode}} a Class</h4>

    <!-- Form Body -->
    <div class="input-group">
        <input name="class-name" class="input-text" type="text" required placeholder="class name" ng-model="yogaClass.name" />
        <label for="class-name" class="input-text-label">class name</label>    
    </div>
    <div class="input-group">
        <textarea name="class-description" class="input-textarea" required placeholder="class description" rows="10" ng-model="yogaClass.description"></textarea>
        <label for="class-description" class="input-text-label">class description</label>
    </div>
    <div class="input-group">
        <div class="checkbox-group" ng-repeat="(day,enabled) in weekdays">
            <label for="class-day-{{day}}">
                <input type="checkbox" ng-model="weekdays[day]" id="class-day-{{day}}" /> {{day}}
            </label>
        </div>
    </div>
    <div class="row">
        <div class="col-1-of-2">
            <div class="input-group">
                <input name="class-starttime" class="input-text" type="text" ng-model="classStartTime" placeholder="start time" />
                <label for="class-starttime" class="input-text-label">start time</label>    
            </div>
        </div>
        <div class="col-1-of-2">
            <div class="input-group">
                <input name="class-endtime" class="input-text" type="text" ng-model="classEndTime" placeholder="end time" />
                <label for="class-endtime" class="input-text-label">end time</label>    
            </div>
        </div>
    </div>

    <!-- Form Buttons -->
    <div class="button-group u-text-right">
        <button class="button" type="submit" ng-disabled="add-class-form.$invalid">{{mode}} Class</button>
    </div>
</form>    
