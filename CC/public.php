<?php require_once('header.php'); ?>

    <section class="<?php if(isset($_GET['show'])) echo 'show'; ?>">
        <article class="row">
            <h2 class="u-bottom-space">Minutes</h2>

            <div class="row">
                <select class="input-select" id="agenda_select">
                    <option value="">--- select an agenda ---</option>
                    <option value="1">Monday, April 23rd (APPROVED)</option>
                    <option value="2">Monday, April 30th (NOT APPROVED)</option>
                    <option value="3">Monday, May 7th (NOT APPROVED)</option>
                    <option value="4">Monday, May 14th (NOT APPROVED)</option>
                </select>
            </div>

            <div class="row agenda">
                <div class="agenda__options">
                    <a href="printable.html" target="_blank"><i class="fa fa-print"></i> print</a>
                </div>

                <h2>CC Minutes for Monday April 23<sup>rd</sup></h2>                

                <br />

                <h3>Action Items</h3>
                <ul class="printable-agenda">
                    <li>This is what an action item will look like printed.</li>
                    <li>This is what an action item will look like printed.</li>
                    <li>This is what an action item will look like printed.</li>
                    <li>This is what an action item will look like printed.</li>
                </ul>

                <h3>Minutes</h3>
                <ul class="printable-agenda">
                    <li class="item">
                        <span class="item-title">Office Update - Racquel</span>
                        <ul class="discussion">
                            <li>Alan Martin (Shankar) doing a workshop on Gyana Oct 7th - 9th...Racquel will speak with Alan further. Deal with beautification committee With Yogeshwar will look into interac and e-transfer options for KYs. Will deal with Yoga Alliance payments due.Marissa Lawrence wants to rent the Yurt, July 28th for 14 people - 12 -15 women on SSI want lunch, to gather and host yoga and meditation and sound workshop….ACYR starts  2nd to 7th..  Jesse suggested bringing someone in as a volunteer to provide lunch…Racquel looking into this further.</li>
                            <li><strong>ACTION</strong> - This is what an action item will look like printed.</li>
                        </ul>
                    </li>
                    <li class="item">
                        <span class="item-title">Approve minutes of April 6 and 9, 2018 meeting</span>
                        <ul class="discussion">
                            <li>Kitchen co-coordinator position - not many applicants...Hope applied for this position.  She is okay with Mariel/Muriel...some concerns re her struggle in the office…</li>
                            <li><strong>DECISION</strong> - This is what a decision will look like printed.</li>
                        </ul>
                    </li>
                    <li class="item">
                        <span class="item-title">Sorriso to visit at 11 am</span>
                        <ul class="discussion">
                            <li>Covered most of what Racquel and Jesse are working on. Collect a list of challenges with Mind/body and evaluate and reach out to Mind/body to see what we can do and then what is required for us to use software. Some teachers have accts ready for use of Mind/Body registration, etc. Looking into different hardware options as to what is best to recommend to use.. Chatting with Racquel and Serena to figure out year end will be done and do Quickbooks update. Racquel’s power pak is caput and needs a new one and have another available. <br />Jesse suggested a few different options...wait until Jesse gets back to see about replacing battery packs….Battery can be ordered on Amazon for about $45. <br />Jesse will send Racquel the link <br />Ompk and Jesse spoke about power supplies and if someone’s computer shuts down due to power failure and if you have a regular backup, then we do not lose everything….if just minor computers then do not need backups on every computer.  Certainly in QB, however word documents are not necessary...Very rarely have power failure that causes data loss. Racquel noticed a lot of fluctuations in the fall/winter and they can be hard on the computers. 
</li>
                            <li><strong>ACTION</strong> - This is what an action item will look like printed.</li>
                        </ul>
                    </li>
                    <li class="item">
                        <span class="item-title">New Staffing Plans Follow-Up</span>
                        <ul class="discussion">
                            <li>Milo has offered to come into Mon meeting and discuss his proposal and perhaps we can take the weekend to look at the proposal and familiarize ourselves.  We asked for a range of what would feel ideal vs what is the bare minimum...so we do not have a range, we have one option. <br />Jules/Milo are back on land….Milo’s proposal is open for discussion..Racquel reminded us that we already have a contract. SN thinks this contract is getting further away from what we originally offered.Jesse - is this a bad thing?  Is this what we need right now? <br />SN - food forest was meant to be a sideline and now has become his main focus and SN sees the problem as Milo being stuck in terms of being on the land and fulfilling the obligation for the centre…Discussion ensued.  <br />SN will follow up re pruning trees.</li>
                            <li><strong>ACTION</strong> - This is what an action item will look like printed.</li>
                        </ul>
                    </li>
                    <li class="item">
                        <span class="item-title">Kitchen Meals-Rajani</span>
                        <ul class="discussion">
                            <li>This is what a comment will look like on the discussion.</li>
                            <li><strong>DECISION</strong> - This is what a decision item will look like printed.</li>
                        </ul>
                    </li>
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















