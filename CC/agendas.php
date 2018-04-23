<?php require_once('header.php'); ?>

    <section class="<?php if(isset($_GET['show'])) echo 'show'; ?>">
        <article class="row">
            <h2 class="u-bottom-space">Agendas</h2>

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
                <h3>CC AGENDA FOR Monday, April 23<sup>rd</sup></h3>

                <div class="agenda__options">
                    <a href="#" class="toggle-discussion">view discussion</a>
                </div>

                <!-- Static Agenda Items -->
                <div class="agenda__item agenda__item--static contracted">
                    <div class="agenda__item-name">Office Update - Racquel <span class="agenda__item-toggle"></span></div>
                    <div class="agenda__item-discussion">
                        <div class="agenda__item-comment">
                            <div class="agenda__item-photo"><img src="img/sn.jpg" class="agenda__item-photo--image" /></div>
                            <div class="agenda__item-comment--text">This is what a comment will look like on the discussion.</div>
                        </div>
                        <div class="agenda__item-comment">
                            <div class="agenda__item-photo"><img src="img/lakshmi.jpg" class="agenda__item-photo--image" /></div>
                            <div class="agenda__item-comment--text">This is what a comment will look like on the discussion.</div>
                        </div>
                        <div class="agenda__item-comment">
                            <div class="agenda__item-photo"><img src="img/sharada.jpg" class="agenda__item-photo--image" /></div>
                            <div class="agenda__item-comment--text">This is what a comment will look like on the discussion.</div>
                        </div>
                        <div class="agenda__item-add">
                            <textarea class="agenda__item-textarea input-textarea" rows="6" placeholder="Add a discussion here..."></textarea>
                            <div class="agenda__item-buttons">
                                <button class="button button-table">table</button>                                    
                                <button class="button button-action">action</button>
                                <button class="button button-decision">decision</button>
                                <button class="button button-discussion">discussion</button>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="agenda__item agenda__item--static">
                    <div class="agenda__item-name">Approve minutes of April 6 and 9, 2018 meeting <span class="agenda__item-toggle"></span></div>
                    <div class="agenda__item-discussion">
                        <div class="agenda__item-comment">
                            <div class="agenda__item-photo"><img src="img/sharada.jpg" class="agenda__item-photo--image" /></div>
                            <div class="agenda__item-comment--text">This is what a comment will look like on the discussion.</div>
                        </div>
                        <div class="agenda__item-comment">
                            <div class="agenda__item-photo"><img src="img/jesse.jpg" class="agenda__item-photo--image" /></div>
                            <div class="agenda__item-comment--text">This is what a comment will look like on the discussion.</div>
                        </div>
                        <div class="agenda__item-comment">
                            <div class="agenda__item-photo"><img src="img/sn.jpg" class="agenda__item-photo--image" /></div>
                            <div class="agenda__item-comment--text">This is what a comment will look like on the discussion.</div>
                        </div>
                        <div class="agenda__item-decision">
                            <div class="agenda__item-photo"><img src="img/jesse.jpg" class="agenda__item-photo--image" /></div>
                            <div class="agenda__item-comment--text">I would like to suggest that we approve the minutes.</div>
                            <div class="agenda__item--support"><span class="agenda__item--support-text">3 in support</span> <i class="fa fa-thumbs-up"></i></div>
                        </div>
                        <div class="agenda__item-action">
                            <div class="agenda__item-photo"><img src="img/yogeshwar.jpg" class="agenda__item-photo--image" /></div>
                            <div class="agenda__item-comment--text">Jesse will follow up with Racquel about this item.</div>
                            <div class="agenda__item--complete"><span class="agenda__item--complete-text">completed 09/17/2018</span> <i class="far fa-check-square"></i></div>
                        </div>
                        <div class="agenda__item-add">
                            <textarea class="agenda__item-textarea input-textarea" rows="6" placeholder="Add a discussion here..."></textarea>
                            <div class="agenda__item-buttons">
                                <button class="button button-table">table</button>                                    
                                <button class="button button-action">action</button>
                                <button class="button button-decision">decision</button>
                                <button class="button button-discussion">discussion</button>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Current Agenda Items -->
                <div class="agenda__item agenda__item--current">
                    <div class="agenda__item-name">Sorriso to visit at 11 am <span class="agenda__item-toggle"></span></div>
                    <div class="agenda__item-discussion">
                        <div class="agenda__item-comment">
                            <div class="agenda__item-photo"><img src="img/sn.jpg" class="agenda__item-photo--image" /></div>
                            <div class="agenda__item-comment--text">This is what a comment will look like on the discussion.</div>
                        </div>
                        <div class="agenda__item-comment">
                            <div class="agenda__item-photo"><img src="img/sn.jpg" class="agenda__item-photo--image" /></div>
                            <div class="agenda__item-comment--text">This is what a comment will look like on the discussion.</div>
                        </div>
                        <div class="agenda__item-comment">
                            <div class="agenda__item-photo"><img src="img/sn.jpg" class="agenda__item-photo--image" /></div>
                            <div class="agenda__item-comment--text">This is what a comment will look like on the discussion.</div>
                        </div>
                        <div class="agenda__item-decision">
                            <div class="agenda__item-photo"><img src="img/sn.jpg" class="agenda__item-photo--image" /></div>
                            <div class="agenda__item-comment--text">I would like to suggest that we approve the minutes.</div>
                            <div class="agenda__item--support"><i class="fa fa-thumbs-up"></i> <span class="agenda__item--support-text">3 in support</span></div>
                        </div>
                        <div class="agenda__item-add">
                            <textarea class="agenda__item-textarea input-textarea" rows="6" placeholder="Add a discussion here..."></textarea>
                            <div class="agenda__item-buttons">
                                <button class="button button-table">table</button>                                    
                                <button class="button button-action">action</button>
                                <button class="button button-decision">decision</button>
                                <button class="button button-discussion">discussion</button>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="agenda__item agenda__item--current">
                    <div class="agenda__item-name">New Staffing Plans Follow-Up <span class="agenda__item-toggle"></span></div>
                    <div class="agenda__item-discussion">
                        <div class="agenda__item-comment">
                            <div class="agenda__item-photo"><img src="img/sn.jpg" class="agenda__item-photo--image" /></div>
                            <div class="agenda__item-comment--text">This is what a comment will look like on the discussion.</div>
                        </div>
                        <div class="agenda__item-comment">
                            <div class="agenda__item-photo"><img src="img/sn.jpg" class="agenda__item-photo--image" /></div>
                            <div class="agenda__item-comment--text">This is what a comment will look like on the discussion.</div>
                        </div>
                        <div class="agenda__item-comment">
                            <div class="agenda__item-photo"><img src="img/sn.jpg" class="agenda__item-photo--image" /></div>
                            <div class="agenda__item-comment--text">This is what a comment will look like on the discussion.</div>
                        </div>
                        <div class="agenda__item-decision">
                            <div class="agenda__item-photo"><img src="img/sn.jpg" class="agenda__item-photo--image" /></div>
                            <div class="agenda__item-comment--text">I would like to suggest that we approve the minutes.</div>
                            <div class="agenda__item--support"><i class="fa fa-thumbs-up"></i> <span class="agenda__item--support-text">3 in support</span></div>
                        </div>
                        <div class="agenda__item-add">
                            <textarea class="agenda__item-textarea input-textarea" rows="6" placeholder="Add a discussion here..."></textarea>
                            <div class="agenda__item-buttons">
                                <button class="button button-table">table</button>                                    
                                <button class="button button-action">action</button>
                                <button class="button button-decision">decision</button>
                                <button class="button button-discussion">discussion</button>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="agenda__item agenda__item--current">
                    <div class="agenda__item-name">Kitchen Meals-Rajani <span class="agenda__item-toggle"></span></div>
                    <div class="agenda__item-discussion">
                        <div class="agenda__item-comment">
                            <div class="agenda__item-photo"><img src="img/sn.jpg" class="agenda__item-photo--image" /></div>
                            <div class="agenda__item-comment--text">This is what a comment will look like on the discussion.</div>
                        </div>
                        <div class="agenda__item-comment">
                            <div class="agenda__item-photo"><img src="img/sn.jpg" class="agenda__item-photo--image" /></div>
                            <div class="agenda__item-comment--text">This is what a comment will look like on the discussion.</div>
                        </div>
                        <div class="agenda__item-comment">
                            <div class="agenda__item-photo"><img src="img/sn.jpg" class="agenda__item-photo--image" /></div>
                            <div class="agenda__item-comment--text">This is what a comment will look like on the discussion.</div>
                        </div>
                        <div class="agenda__item-decision">
                            <div class="agenda__item-photo"><img src="img/sn.jpg" class="agenda__item-photo--image" /></div>
                            <div class="agenda__item-comment--text">I would like to suggest that we approve the minutes.</div>
                            <div class="agenda__item--support"><i class="fa fa-thumbs-up"></i> <span class="agenda__item--support-text">3 in support</span></div>
                        </div>
                        <div class="agenda__item-add">
                            <textarea class="agenda__item-textarea input-textarea" rows="6" placeholder="Add a discussion here..."></textarea>
                            <div class="agenda__item-buttons">
                                <button class="button button-table">table</button> 
                                <button class="button button-action">action</button>
                                <button class="button button-decision">decision</button>
                                <button class="button button-discussion">discussion</button>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Requested Agenda Items -->
                <div class="agenda__item agenda__item--request">
                    <div class="agenda__item-name"><div class="agenda__item-photo"><img src="img/mariel.jpg" title="Mariel Ahlers" class="agenda__item-photo--image" /></div> I would like to come give you a Kitchen Update <span class="agenda__item-toggle"></span></div>
                    <div class="agenda__item-discussion">
                        <div class="agenda__item-comment">
                            <div class="agenda__item-photo"><img src="img/mariel.jpg" title="Mariel Ahlers" class="agenda__item-photo--image" /></div>
                            <div class="agenda__item-comment--text">I am interested in attending CC to let you know what is happening in the kitchen.</div>
                        </div>
                        <div class="agenda__item-add">
                            <textarea class="agenda__item-textarea input-textarea" rows="6" placeholder="Add a discussion here..."></textarea>
                            <div class="agenda__item-buttons">
                                <button class="button button-table">table</button>
                                <button class="button button-action">action</button>
                                <button class="button button-decision">decision</button>
                                <button class="button button-discussion">discussion</button>
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
    <div class="agenda__item--support" data-val="0"><i class="fa fa-thumbs-up"></i> <span class="agenda__item--support-text" ></span></div>
</div>

<div class="agenda__item-action template">
    <div class="agenda__item-photo"><img src="img/sn.jpg" class="agenda__item-photo--image" /></div>
    <div class="agenda__item-comment--text"></div>
    <div class="agenda__item--complete"><span class="agenda__item--complete-text"></span> <i class="far fa-square"></i></div>
</div>

<?php require_once('footer.php'); ?>















