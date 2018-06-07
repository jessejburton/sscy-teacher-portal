<div class="container" ng-controller="classController" ng-init="getClasses()">
    <h2>Classes</h2>

    <table class="classes ng-cloak">
        <thead>
            <tr><th>Day</th><th>Time</th><th>Class</th><th>Room</th><th>Actions</th></tr>
        </thead>
        <tbody>
            <tr class="class" ng-repeat="class in classes">
                <td class="class__date">
                    {{ class.days | daysOfWeek }}
                </td>
                <td class="class__time">{{ class.start_time | formatTime }} - {{ class.end_time | formatTime }}</td>
                <td class="class__name"><span class="class__name-text">{{ class.name }}</span></td>
                <td class="class__room">{{ class.room_name }}</td>
                <td class="class__actions">
                    <button class="button class__button--edit">edit</button>
                    <!--<button class="button class__button--registration">registration</button>-->
                    <button class="button class__button--cancel">cancel</button>
                </td>
            </tr>
        </tbody>
    </table>

    <div class="button-group u-text-right">
        <button class="button class__button--add" ng-click="getClasses">ADD CLASS</button>
    </div>

    <?php require_once('add_class.php'); ?>

</div>