<!-- ADD CLASS FORM -->
<div id="addClass">
    <h4>Add a Class</h4>
    <form name="add-class-form" class="form" ng-submit="addClass()">
        <div class="input-group">
            <input name="class-name" class="input-text" type="text" ng-model="className" required placeholder="class name" />
            <label for="class-name" class="input-text-label">class name</label>    
        </div>
        <div class="input-group">
            <textarea name="class-description" class="input-textarea" ng-model="classDescription" required placeholder="class description" rows="10"></textarea>
            <label for="class-description" class="input-text-label">class description</label>
        </div>
        <div class="input-group">
            <input name="class-date" class="input-text" type="text" ng-model="classDate" placeholder="mm/dd/yyyy" />
            <label for="class-date" class="input-text-label">date</label>    
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

        <div class="button-group u-text-right">
            <button class="button" type="submit" ng-disabled="add-class-form.$invalid">Add Class</button>
        </div>
    </form>
</div>