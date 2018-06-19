<div class="exceptions">
  <form name="exception_form" ng-submit="addException()">

      <!-- Form Header -->
      <header class="header">

         <p class="u-bottom-space-small">Adding exception for:</p>
         <h3>{{exception.class.name}}</h3>
         <p><small><em>{{ exception.class.schedules[0].days | daysOfWeek }}'s</em> at <em>{{ exception.class.schedules[0].start_time | formatTime }} - {{ exception.class.schedules[0].end_time | formatTime }}</em> in <em>{{exception.class.schedules[0].room_name }}</em></small></p>
      
         <!-- ERROR TRAPPING -->
         <div ng-if="message.text.length > 0" class="alert alert-{{ message.type }}"> {{message.text}} </div>      

      </header>

      <!-- Exception Date -->
      <div class="input-group u-bottom-space">
            <datepicker date-format="EEEE, MMMM d, yyyy" 
                        date-disabled-weekdays="{{exception.invalid_days}}">
               <input  name="exception_date"
                        ng-model="exception.date" 
                        type="text" 
                        placeholder="select a date"  
                        class="exceptions_datepicker date-picker input-text" 
                        data-day="{{exception.class.days}}"
                        required />
            </datepicker>
      </div>

      <!-- Type of Exception -->
      <div class="input-group">
            <label>Type of exception</label>
            <select 
               name="exception_type"
               class="input-select add-exception-type"
               ng-model="exception.type" 
               ng-options="type.type_display for type in types track by type.type"
               required>
            </select>
      </div>

      <!-- Message -->
      <div class="input-group">
            <label>Message</label>
            <textarea 
               name="exception_message"
               class="input-textarea" 
               ng-model="exception.message" 
               rows="5"
               required
               maxlength="500">
            </textarea>
      </div>

      <!-- Room and Teacher options, if 'room_teacher_change' is selected as type -->
      <div ng-if="exception.type.type == 'room_teacher_change'">
            <!-- Room Change -->
            <div class="exception__room input-group">
               <label>Room</label>
               <select 
                  name="exception_room"
                  class="input-select"
                  ng-model="exception.room" 
                  ng-options="room.name for room in rooms track by room.room_id">
               </select>
            </div>

            <!-- Teacher Change -->
            <div class="exception__room input-group">
               <label>Teacher</label>
               <select 
                  name="exception_teacher"
                  class="input-select"
                  ng-model="exception.teacher" 
                  ng-options="teacher.name for teacher in teachers track by teacher.teacher_id">
               </select>
            </div>
      </div>

      <!-- Exception Form Buttons -->
      <div class="button-group">
         <span class="u-float-left">
            <a href="javascript:void(0);" ng-click="closeExceptions()">cancel</a>
         </span>
         <button type="submit" class="button">Add Exception</button>
      </div>
      
  </form>
</div>