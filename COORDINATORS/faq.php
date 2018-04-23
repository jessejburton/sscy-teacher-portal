<?php require_once('header.php'); ?>

    <section class="<?php if(isset($_GET['show'])) echo 'show'; ?>">
        <article class="row">
            <h2 class="u-bottom-space">Area FAQs</h2>

            <div class="row">
                <select class="input-select" id="area_select">
                    <option value="">--- select an area ---</option>
                    <option value="4">Farm</option>
                    <option value="4">Housekeeping</option>                    
                    <option value="1">Kitchen</option>
                    <option value="3">Maintenance</option>                    
                    <option value="2">Office</option>
                </select>
            </div>

            <div id="faqs">
                <h4 class="u-bottom-space">Maintenance FAQs</h4>

                <div class="faqs__search u-bottom-space">
                    <input type="text" id="faqs_search" class="input-text" placeholder="what are you looking for?" />
                    <label for="faqs_search" class="input-text-label">search term</label>
                    <div class="u-text-right"><button class="button">search</button></div>
                </div>

                <div class="row faqs">
                    <div class="faq">
                        <div class="faq__question"><a href="#" class="faq__question-link">Can I use the chainsaw?</a></div>
                        <div class="faq__answer">Absolutely not.</div>
                    </div>

                    <div class="faq">
                        <div class="faq__question"><a href="#" class="faq__question-link">Where is the shop?</a></div>
                        <div class="faq__answer">Near Sharadas place.</div>
                    </div>

                    <div class="faq">
                        <div class="faq__question"><a href="#" class="faq__question-link">Where can I get gloves?</a></div>
                        <div class="faq__answer">Talk to the maintenance coordinator.</div>
                    </div>

                    <div class="faq">
                        <div class="faq__question"><a href="#" class="faq__question-link">Which elders can I speak to about maintenance?</a></div>
                        <div class="faq__answer">Om and SN.</div>
                    </div>
                </div>

                <hr />

                <div class="add__faq">
                    <h3 class="u-bottom-space">Add Maintenance FAQ</h3>
                    <div class="u-bottom-space">
                        <input type="text" class="input-text" id="add__faq-question" placeholder="Enter your question..." />
                    </div>
                    <div class="u-bottom-space">
                        <textarea class="input-textarea" id="add__faq-answer" rows="10" placeholder="Enter your answer..."></textarea>
                    </div>
                    <div class="u-text-right">
                        <button class="button">Add FAQ</button>
                    </div>
                </div>
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















