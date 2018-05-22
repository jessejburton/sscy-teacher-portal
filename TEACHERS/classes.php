<?php require_once('header.php'); ?>

    <section>
        <article class="row">
            <h2>Classes</h2>

            <table class="classes">
                <thead>
                    <tr><th>Date</th><th>Time</th><th>Class</th><th>Actions</th></tr>
                </thead>
                <tbody>
                    <tr class="class template" data-id="0">
                        <td class="class__date"></td>
                        <td class="class__time"></td>
                        <td class="class__name"><span class="class__name-text"></span> <a href="#" class="class__button--edit edit-class u-tiny-text">edit</a></td>
                        <td class="class__actions">
                            <button class="button class__button--registration">registration</button>
                            <button class="button class__button--cancel">cancel class</button>
                        </td>
                    </tr>
                    <tr class="class" data-id="2">
                        <td class="class__date">Monday, April 23<sup>rd</sup></td>
                        <td class="class__time">4:30PM - 5:30PM</td>
                        <td class="class__name">Hatha Mixed Levels with John <a href="#" class="class__button--edit edit-class u-tiny-text">edit</a></td>
                        <td class="class__actions">
                            <button class="button class__button--registration">registration</button>
                            <button class="button class__button--cancel">cancel class</button>
                        </td>
                    </tr>
                    <tr class="class" data-id="3">
                        <td class="class__date">Monday, April 23<sup>rd</sup></td>
                        <td class="class__time">4:30PM - 5:30PM</td>
                        <td class="class__name">Hatha Mixed Levels with John <a href="#" class="class__button--edit edit-class u-tiny-text">edit</a></td>
                        <td class="class__actions">
                            <button class="button class__button--registration">registration</button>
                            <button class="button class__button--cancel">cancel class</button>
                        </td>
                    </tr>
                    <tr class="class" data-id="4">
                        <td class="class__date">Monday, April 23<sup>rd</sup></td>
                        <td class="class__time">4:30PM - 5:30PM</td>
                        <td class="class__name">Hatha Mixed Levels with John <a href="#" class="class__button--edit edit-class u-tiny-text">edit</a></td>
                        <td class="class__actions">
                            <button class="button class__button--registration">registration</button>
                            <button class="button class__button--cancel">cancel class</button>
                        </td>
                    </tr>
                </tbody>
            </table>

            <hr />

            <div class="row u-text-right">
                <a class="button class__button--add" href="#">ADD CLASS</a>
            </div>
        </article><!-- .row -->
    </section><!-- .section -->


<?php require_once('footer.php'); ?>