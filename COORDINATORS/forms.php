<?php require_once('header.php'); ?>

    <section class="<?php if(isset($_GET['show'])) echo 'show'; ?>">
        <article class="row">
            <h2 class="u-bottom-space">Coordinator Forms</h2>
            <div class="row">
                <ul>
                    <li><a href="#">KY Evaluation Form</a></li>
                    <li><a href="#">Another Coordinator related form</a></li>
                </ul>
            </div>

            <h2 class="u-bottom-space">General Forms</h2>
            <div class="row">
                <ul>
                    <li><a href="#">Guest Request Form</a></li>
                    <li><a href="#">Vacation Request Form</a></li>
                    <li><a href="#">Personal Retreat Request Form</a></li>
                </ul>
            </div>

        </article><!-- .row -->
    </section><!-- .section -->

<!-- TEMPLATES -->
<div class="agenda__item-comment template">
    <div class="agenda__item-photo"><img src="img/sn.jpg" class="agenda__item-photo--image" /></div>
    <div class="agenda__item-comment--text"></div>
</div>

<div class="agenda__item-decision template">
    <div class="agenda__item-photo"><img src="img/sn.jpg" class="agenda__item-photo--image" /></div>
    <div class="agenda__item-comment--text"></div>
</div>

<div class="agenda__item-action template">
    <div class="agenda__item-photo"><img src="img/sn.jpg" class="agenda__item-photo--image" /></div>
    <div class="agenda__item-comment--text"></div>
    <div class="agenda__item--complete"><span class="agenda__item--complete-text"></span> <i class="far fa-square"></i></div>
</div>

<div class="agenda__item-incamera template">
    <div class="agenda__item-photo"><img src="img/sn.jpg" class="agenda__item-photo--image" /></div>
    <div class="agenda__item-comment--text"></div>
</div>

<?php require_once('footer.php'); ?>















