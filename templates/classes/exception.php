<div class="exceptions">
        <p class="u-bottom-space-small">Adding exception for:</p>
        <h5>{{exception.class.name}}</h5>
        <p><small><em>{{ exception.class.schedules[0].days | daysOfWeek }}'s</em> at <em>{{ exception.class.schedules[0].start_time | formatTime }} - {{ exception.class.schedules[0].end_time | formatTime }}</em> in <em>{{exception.class.schedules[0].room_name }}</em></small></p>

        <div class="input-group u-bottom-space">
            <datepicker date-format="EEEE, MMMM d, yyyy" date-disabled-weekdays="{{exception.invalid_days}}">
                <input  ng-model="exception.date" 
                        type="text" 
                        placeholder="select a date"  
                        class="exceptions_datepicker date-picker input-text" 
                        data-day="{{exception.class.days}}" />
            </datepicker>
        </div>
        <div class="input-group">
            <label>Type of exception</label>
            <select ng-model="exception.type" class="input-select">
                <option selected>Cancelled</option>
            </select>
        </div>
        <div class="input-group">
            <label>Message</label>
            <textarea class="input-textarea" ng-model="exception.message" rows="5"></textarea>
        </div>

        <div ng-if="exception.type == 'room_teacher_change'">
            <!-- Room Change -->
            <div class="exception__room input-group">
                <label>Room</label>
                <select ng-model="exception.room_id" class="input-select">
                    <option>Cancelled</option>
                </select>
            </div>

            <!-- Teacher Change -->
            <div class="exception__room input-group">
                <label>Teacher</label>
                <select ng-model="exception.room_id" class="input-select">
                    <option>Cancelled</option>
                </select>
            </div>
        </div>

        <div class="button-group">
            <span class="u-float-left"><a href="javascript:void(0);" ng-click="closeExceptions()">cancel</a></span>
            <button class="button" ng-click="addException()">Add Exception</button>
        </div>

    </div>