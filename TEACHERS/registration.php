<?php require_once('header.php'); ?>

    <section class="<?php if(isset($_GET['show'])) echo 'show'; ?>">
        <article class="row">
            <h2 class="u-bottom-space">Registration</h2>

            <div class="row">
                <select class="input-select" id="class_select">
                    <option value="">--- select a class ---</option>
                    <option value="1">Monday, April 23rd - Hatha Mixed Levels with John</option>
                    <option value="2">Tuesday, April 24th - Yoga for Beginners with John</option>
                    <option value="3">Monday, April 30th - Hatha Mixed Levels with John</option>
                    <option value="4">Tuesday, May 1st - Yoga for Beginners with John</option>
                </select>
            </div>

            <div class="row" id="registration">
                <table class="table" id="registrant-table">
                    <thead>
                        <tr>
                            <th>Name</th>
                            <th>Email</th>
                            <th>PR</th>
                            <th>KY</th>
                            <th>Amount</th>
                            <th>Check In</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr class="template">
                            <td><span class="registrant-name"></span></td>
                            <td><span class="registrant-email"></span></td>
                            <td><input type="checkbox" class="registration-checkbox registrant-pr" /></td>
                            <td><input type="checkbox" class="registration-checkbox registrant-ky" /></td>
                            <td>$ <input type="text" class="registration-amount input-text" value="16" /></td>
                            <td><span class="checkedin" title="Click to un-check in">checked in</span></td>
                        </tr>
                        <tr>
                            <td><input id="registrant_name" type="text" class="input-text" placeholder="name" /></td>
                            <td><input id="registrant_email" type="text" class="input-text" placeholder="email" /></td>
                            <td><input id="registrant_pr" type="checkbox" class="registration-checkbox" /></td>
                            <td><input id="registrant_ky" type="checkbox" class="registration-checkbox" /></td>
                            <td>$ <input type="text" class="registration-amount input-text-inline" value="16" /></td>               
                            <td><button class="button registration-new">CHECK IN</button></td>
                        </tr>
                        <tr>
                            <td>Jesse Burton</td>
                            <td>jesse@burtonmediainc.com</td>
                            <td><input type="checkbox" class="registration-checkbox" /></td>
                            <td><input type="checkbox" class="registration-checkbox" /></td>
                            <td>$ <input type="text" class="registration-amount input-text-inline" value="16" /></td>
                            <td><button class="button registration-checkin">CHECK IN</button></td>
                        </tr>
                        <tr>
                            <td>Jane Doe</td>
                            <td>jane@doe.com</td>
                            <td><input type="checkbox" class="registration-checkbox" /></td>
                            <td><input type="checkbox" class="registration-checkbox" /></td>
                            <td>$ <input type="text" class="registration-amount input-text-inline" value="16" /></td>
                            <td><button class="button registration-checkin">CHECK IN</button></td>
                        </tr>
                        <tr>
                            <td>Reginald Winterbottom</td>
                            <td>reginald@email.com</td>
                            <td><input type="checkbox" class="registration-checkbox" /></td>
                            <td><input type="checkbox" class="registration-checkbox" /></td>
                            <td>$ <input type="text" class="registration-amount input-text-inline" value="16" /></td>
                            <td><button class="button registration-checkin">CHECK IN</button></td>
                        </tr>

                    </tbody>
                </table>
            </div>
        </article><!-- .row -->
    </section><!-- .section -->

<?php require_once('footer.php'); ?>