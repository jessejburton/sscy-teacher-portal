<div class="class__form-container" ng-class="{open: currentClass.show}">
  <form name="class__form" ng-submit="saveClass()">

      <!-- Form Header -->
      <header class="header">

         <h3>{{ currentClass.mode }} Class</h3>
      
         <!-- ERROR TRAPPING -->
         <div ng-if="currentClass.message.text.length > 0" class="alert alert-{{ currentClass.message.type }}"> {{currentClass.message.text}} </div>      

      </header>

    <!-- Form Body -->
    <div class="input-group">

        <label>Class Name</label> 
        <input name="class-name" class="input-text" type="text" required placeholder="class name" ng-model="currentClass.name" />
    
    </div>

    <div class="input-group">

        <label>Class Description</label>
        <textarea name="class-description" class="input-textarea" required placeholder="class description" rows="10" ng-model="currentClass.description"></textarea>

    </div>

    <!-- Room -->
    <div class="class__room input-group">
        <label>Room</label>
        <select 
            name="class_room"
            class="input-select"
            ng-model="currentClass.selectedRoom" 
            ng-options="room.name for room in rooms track by room.room_id"
            ng-change="updateCurrentClassRoom()">
        </select>
    </div>

    <!-- Class Day -->
    <div class="input-group" style="margin-top: -30px;">

        <div class="input-group">
            <label for="teacher_select" class="label-select">Class Day</label>
            <select class="input-select"
                    ng-model="currentClass.selectedDay" 
                    ng-options="day.label for day in weekdays track by day.value"
                    ng-change="updateCurrentClassDay()">
            </select>
        </div>

    </div>

    <!-- TIME -->
    <div class="row">
        <label>Class Time</label>
        <div class="input-group">
            <rzslider 
                rz-slider-model="classTime.minValue"       
                rz-slider-high="classTime.maxValue"       
                rz-slider-options="classTime.options">
            </rzslider>
        </div>
    </div>

    <!-- DATES THE CLASS RUNS -->
    <div class="row">
        <div class="col-1-of-2">
            <div class="input-group">
                <label>Class Runs From</label>
                <datepicker date-format="EEEE, MMMM d, yyyy" 
                            date-disabled-weekdays="{{exception.invalid_days}}">
                    <input name="runs_from_date"
                            id="runs_from_date"
                            ng-model="currentClass.date_from" 
                            type="text" 
                            placeholder="select a date"  
                            class="class_datepicker date-picker input-text input-date"  />
                    <label for="runs_from_date"><i class="fas fa-calendar-alt"></i></label>
                </datepicker>
            </div>
        </div>
        <div class="col-1-of-2">
            <div class="input-group">
                <label>Class Runs Until</label>
                <datepicker date-format="EEEE, MMMM d, yyyy" 
                            date-disabled-weekdays="{{exception.invalid_days}}">
                    <input name="runs_to_date"
                            id="runs_to_date"
                            ng-model="currentClass.date_until" 
                            type="text" 
                            placeholder="select a date"  
                            class="class_datepicker date-picker input-text input-date"  />
                    <label for="runs_to_date"><i class="fas fa-calendar-alt"></i></label>
                </datepicker>            
            </div>
        </div>
    </div>
    
    <!-- Class Form Buttons -->
    <div class="button-group">
        <span class="u-float-left">
            <a href="javascript:void(0);" ng-click="closeClassForm()">cancel</a>
        </span>
        <button type="submit" class="button">{{ currentClass.saveClassButtonText }}</button>
    </div>
      
  </form>
</div>