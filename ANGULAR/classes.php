<?php require_once('header.php'); ?>

    <div class="container" ng-controller="classController">
        <h2>Classes</h2>

        <table class="classes">
            <thead>
                <tr><th>Date</th><th>Time</th><th>Class</th><th>Actions</th></tr>
            </thead>
            <tbody>
                <tr class="class" ng-repeat="class in classes">
                    <td class="class__date">{{class.date}}</td>
                    <td class="class__time">{{class.starttime}} - {{class.endtime}}</td>
                    <td class="class__name"><span class="class__name-text">{{class.name}}</span> <a href="#" class="class__button--edit edit-class u-tiny-text">edit</a></td>
                    <td class="class__actions">
                        <button class="button class__button--registration">registration</button>
                        <button class="button class__button--cancel">cancel class</button>
                    </td>
                </tr>
            </tbody>
        </table>

        <div class="button-group u-text-right">
            <button class="button class__button--add">ADD CLASS</button>
        </div>

        <?php require_once('forms/add_class.php'); ?>

    </div>

<?php require_once('footer.php'); ?>