<?php require_once('header.php'); ?>


    <section>
        <article class="row">
            <h2>Classes</h2>

            <table class="table">
                <thead>
                    <tr><th>Date</th><th>Time</th><th>Class</th><th>Actions</th></tr>
                </thead>
                <tbody>
                    <tr class="class-1">
                        <td>Monday, April 23<sup>rd</sup></td>
                        <td>4:30PM - 5:30PM</td>
                        <td>Hatha Mixed Levels with John <a href="#" class="edit-class u-tiny-text">edit</a></td>
                        <td>
                            <button class="button" onclick="window.location='registration.php?show';">registration</button>
                            <button class="button cancel-class">cancel class</button>
                        </td>
                    </tr>
                    <tr class="class-2">
                        <td>Tuesday, April 24<sup>th</sup></td>
                        <td>4:30PM - 5:45PM</td>
                        <td>Yoga for Beginners with John <a href="#" class="edit-class u-tiny-text">edit</a></td>
                        <td>
                            <button class="button" onclick="window.location='registration.php?show';">registration</button>
                            <button class="button cancel-class">cancel class</button>
                        </td>
                    </tr>
                    <tr class="class-3">
                        <td>Monday, April 30<sup>th</sup></td>
                        <td>4:30PM - 5:30PM</td>
                        <td>Hatha Mixed Levels with John <a href="#" class="edit-class u-tiny-text">edit</a></td>
                        <td>
                            <button class="button" onclick="window.location='registration.php?show';">registration</button>
                            <button class="button cancel-class">cancel class</button>
                        </td>
                    </tr>
                    <tr class="class-4">
                        <td>Tuesday, May 1<sup>st</sup></td>
                        <td>4:30PM - 5:45PM</td>
                        <td>Yoga for Beginners with John <a href="#" class="edit-class u-tiny-text">edit</a></td>
                        <td>
                            <button class="button" onclick="window.location='registration.php?show';">registration</button>
                            <button class="button cancel-class">cancel class</button>
                        </td>
                    </tr>
                </tbody>
            </table>

            <hr />

            <div class="row u-text-right">
                <a class="button" href="#">ADD CLASS</a>
            </div>
        </article><!-- .row -->
    </section><!-- .section -->


<?php require_once('footer.php'); ?>