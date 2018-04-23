<?php require_once('header.php'); ?>

    <section class="<?php if(isset($_GET['show'])) echo 'show'; ?>">
        <article class="row">
            <h2 class="u-bottom-space">Minutes</h2>

            <div class="row">
                <select class="input-select" id="agenda_select">
                    <option value="">--- select an agenda ---</option>
                    <option value="1">Monday, April 23rd</option>
                    <option value="2">Monday, April 30th</option>
                    <option value="3">Monday, May 7th</option>
                    <option value="4">Monday, May 14th</option>
                </select>
            </div>

            <div class="row agenda">
                <h3>CC MINUTES FOR Monday, April 23<sup>rd</sup></h3>

                <div class="agenda__approve-minutes">
                    <div class="agenda__item--complete-minutes"><i class="far fa-square"></i> <span class="agenda__item--complete-text">Approve the minutes from Monday, April 16<sup>th</sup></span></div>
                </div>

                <h4>Unfinished Action Items</h4>
                <div class="agenda__item agenda__item-unfinished">
                    <div class="agenda__item-discussion agenda__action-items">
                        <div class="agenda__item-action">
                            <div class="agenda__item-photo"><img src="img/sn.jpg" class="agenda__item-photo--image" /></div>
                            <div class="agenda__item-comment--text">Jesse will follow up with Racquel about the thing they were talking about.</div>
                            <div class="agenda__item--complete"><span class="agenda__item--complete-text"></span> <i class="far fa-square"></i></div>
                        </div>
                    </div>
                    <div class="agenda__item-discussion agenda__action-items">
                        <div class="agenda__item-action">
                            <div class="agenda__item-photo"><img src="img/sn.jpg" class="agenda__item-photo--image" /></div>
                            <div class="agenda__item-comment--text">Om and SN will check the conditions of the trail on Tuesday.</div>
                            <div class="agenda__item--complete"><span class="agenda__item--complete-text"></span> <i class="far fa-square"></i></div>
                        </div>
                    </div>
                </div>

                <h4>Agenda</h4>                

                <!-- Static Agenda Items -->
                <div class="agenda__item agenda__item--static contracted">
                    <div class="agenda__item-name">Office Update - Racquel <span class="agenda__item-toggle"></span></div>
                    <div class="agenda__item-discussion">
                        <div class="agenda__item-add">
                            <textarea class="agenda__item-textarea input-textarea" rows="6" placeholder="Add minutes here..."></textarea>
                            <div class="agenda__item-buttons">
                                <button class="button button-action">action</button>
                                <button class="button button-decision">decision</button>
                                <button class="button button-discussion">discussion</button>
                                <button class="button button-incamera">in-camera</button>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="agenda__item agenda__item--static">
                    <div class="agenda__item-name">Approve minutes of April 6 and 9, 2018 meeting <span class="agenda__item-toggle"></span></div>
                    <div class="agenda__item-discussion">
                        <div class="agenda__item-add">
                            <textarea class="agenda__item-textarea input-textarea" rows="6" placeholder="Add minutes here..."></textarea>
                            <div class="agenda__item-buttons">
                                <button class="button button-action">action</button>
                                <button class="button button-decision">decision</button>
                                <button class="button button-discussion">discussion</button>
                                <button class="button button-incamera">in-camera</button>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Current Agenda Items -->
                <div class="agenda__item agenda__item--current">
                    <div class="agenda__item-name">Sorriso to visit at 11 am <span class="agenda__item-toggle"></span></div>
                    <div class="agenda__item-discussion">
                        <div class="agenda__item-add">
                            <textarea class="agenda__item-textarea input-textarea" rows="6" placeholder="Add minutes here..."></textarea>
                            <div class="agenda__item-buttons">
                                <button class="button button-action">action</button>
                                <button class="button button-decision">decision</button>
                                <button class="button button-discussion">discussion</button>
                                <button class="button button-incamera">in-camera</button>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="agenda__item agenda__item--current">
                    <div class="agenda__item-name">New Staffing Plans Follow-Up <span class="agenda__item-toggle"></span></div>
                    <div class="agenda__item-discussion">
                        <div class="agenda__item-add">
                            <textarea class="agenda__item-textarea input-textarea" rows="6" placeholder="Add minutes here..."></textarea>
                            <div class="agenda__item-buttons">
                                <button class="button button-action">action</button>
                                <button class="button button-decision">decision</button>
                                <button class="button button-discussion">discussion</button>
                                <button class="button button-incamera">in-camera</button>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="agenda__item agenda__item--current">
                    <div class="agenda__item-name">Kitchen Meals-Rajani <span class="agenda__item-toggle"></span></div>
                    <div class="agenda__item-discussion">
                        <div class="agenda__item-add">
                            <textarea class="agenda__item-textarea input-textarea" rows="6" placeholder="Add minutes here..."></textarea>
                            <div class="agenda__item-buttons">
                                <button class="button button-action">action</button>
                                <button class="button button-decision">decision</button>
                                <button class="button button-discussion">discussion</button>
                                <button class="button button-incamera">in-camera</button>
                            </div>
                        </div>
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















