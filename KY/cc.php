<?php require_once('header.php'); ?>

    <section class="<?php if(isset($_GET['show'])) echo 'show'; ?>">
        <article class="row">
            <h2 class="u-bottom-space">Centre Committee</h2>

            <h3>Previous Minutes</h3>
            <div class="row">
                <ul>
                    <li><a href="../cc/printable.html" target="_blank">Monday, April 23rd</a></li>
                    <li><a href="../cc/printable.html" target="_blank">Monday, April 30th</a></li>
                    <li><a href="../cc/printable.html" target="_blank">Monday, May 7th</a></option>
                    <li><a href="../cc/printable.html" target="_blank">Monday, May 14th</a></option>
                </select>
            </div>

            <div class="row ky-agenda">
                <h3>NEXT CC MEETING ON Monday, April 23<sup>rd</sup></h3>

                <h4>Agenda</h4>                

                <!-- Static Agenda Items -->
                <div class="agenda__item agenda__item--static agenda__item--display">
                    <div class="agenda__item-name">Office Update - Racquel</div>
                </div>
                <div class="agenda__item agenda__item--static agenda__item--display">
                    <div class="agenda__item-name">Approve minutes of April 6 and 9, 2018 meeting</div>
                </div>

                <!-- Current Agenda Items -->
                <div class="agenda__item agenda__item--current agenda__item--display">
                    <div class="agenda__item-name">Sorriso to visit at 11 am</div>
                </div>
                <div class="agenda__item agenda__item--current agenda__item--display">
                    <div class="agenda__item-name">New Staffing Plans Follow-Up</div>
                </div>
                <div class="agenda__item agenda__item--current agenda__item--display">
                    <div class="agenda__item-name">Kitchen Meals-Rajani</div>
                </div>
            </div>
        </article><!-- .row -->
    </section><!-- .section -->

<!-- TEMPLATES -->
<div class="agenda__item-comment template">
    <div class="agenda__item-photo"><img src="../cc/img/mariel.jpg" class="agenda__item-photo--image" /></div>
    <div class="agenda__item-comment--text"></div>
</div>

<div class="agenda__item-decision template">
    <div class="agenda__item-photo"><img src="../cc/img/mariel.jpg" class="agenda__item-photo--image" /></div>
    <div class="agenda__item-comment--text"></div>
</div>

<div class="agenda__item-action template">
    <div class="agenda__item-photo"><img src="../cc/img/mariel.jpg" class="agenda__item-photo--image" /></div>
    <div class="agenda__item-comment--text"></div>
    <div class="agenda__item--complete"><span class="agenda__item--complete-text"></span> <i class="far fa-square"></i></div>
</div>

<div class="agenda__item-incamera template">
    <div class="agenda__item-photo"><img src="../cc/img/mariel.jpg" class="agenda__item-photo--image" /></div>
    <div class="agenda__item-comment--text"></div>
</div>

<div class="agenda__item agenda__item--request template">
    <div class="agenda__item-name"></div>
    <div class="agenda__item-discussion">
        <div class="agenda__item-add">
            <textarea class="agenda__item-textarea input-textarea" rows="6" placeholder="Add Comment..."></textarea>
            <div class="agenda__item-buttons">
                <button class="button button-discussion">comment</button>
            </div>
        </div>
    </div>
</div>

<?php require_once('footer.php'); ?>















