<?php require_once('header.php'); ?>

    <section>
        <article class="row">
            <h2 class="u-bottom-space">Reports</h2>

            <div class="row">
                <div class="col-1-of-2">
                    <label for="from">From</label>
                    <input type="text" id="from" name="from" class="input-text-inline">
                    <label for="to">to</label>
                    <input type="text" id="to" name="to" class="input-text-inline">
                </div>

                <div class="col-1-of-2">
                    <select class="input-select" id="month_select">
                        <option value="">--- or select a month ---</option>
                        <option value="09/01/2017">September, 2017</option>
                        <option value="10/01/2017">October, 2017</option>
                        <option value="11/01/2017">November, 2017</option>
                        <option value="12/01/2017">December, 2017</option>
                        <option value="01/01/2018">January, 2018</option>
                        <option value="02/01/2018">February, 2018</option>
                        <option value="03/01/2018">March, 2018</option>
                        <option value="04/01/2018">April, 2018</option>
                    </select>
                </div>
            </div>

            <div class="u-spacer">&nbsp;</div>

            <div id="report">
                <div class="row">
                    <h3>reporting from <strong id="from_date" class="u-larger-text">April 23<sup>rd</sup>, 2018</strong> until <strong id="to_date" class="u-larger-text">May 1<sup>st</sup>, 2018</strong></h3>

                    <table class="table" id="report-table">
                        <thead>
                            <tr>
                                <th>Date</th>
                                <th>Students</th>
                                <th>PR</th>
                                <th>KY</th>
                                <th>Collected</th>
                                <th>Rental</th>
                                <th>Owed</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>April 23<sup>rd</sup>, 2018</td>
                                <td>14</td>
                                <td>1</td>
                                <td>2</td>
                                <td>$229.00</td>
                                <td>YES</td>
                                <td>$179.00</td>
                            </tr>
                            <tr>
                                <td>April 24<sup>th</sup>, 2018</td>
                                <td>10</td>
                                <td>1</td>
                                <td>0</td>
                                <td>$165.00</td>
                                <td>NO</td>
                                <td>$115.00</td>
                            </tr>
                            <tr>
                                <td>April 25<sup>th</sup>, 2018</td>
                                <td>0</td>
                                <td>0</td>
                                <td>0</td>
                                <td>$0.00</td>
                                <td>NO</td>
                                <td>$0.00</td>
                            </tr>
                            <tr>
                                <td>April 26<sup>th</sup>, 2018</td>
                                <td>0</td>
                                <td>0</td>
                                <td>0</td>
                                <td>$0.00</td>
                                <td>NO</td>
                                <td>$0.00</td>
                            </tr>
                            <tr>
                                <td>April 27<sup>th</sup>, 2018</td>
                                <td>0</td>
                                <td>0</td>
                                <td>0</td>
                                <td>$0.00</td>
                                <td>NO</td>
                                <td>$0.00</td>
                            </tr>
                            <tr>
                                <td>April 28<sup>th</sup>, 2018</td>
                                <td>0</td>
                                <td>0</td>
                                <td>0</td>
                                <td>$0.00</td>
                                <td>NO</td>
                                <td>$0.00</td>
                            </tr>
                            <tr>
                                <td>April 29<sup>th</sup>, 2018</td>
                                <td>0</td>
                                <td>0</td>
                                <td>0</td>
                                <td>$0.00</td>
                                <td>NO</td>
                                <td>$0.00</td>
                            </tr>
                            <tr>
                                <td>April 30<sup>th</sup>, 2018</td>
                                <td>12</td>
                                <td>2</td>
                                <td>0</td>
                                <td>$192.00</td>
                                <td>YES</td>
                                <td>$142.00</td>
                            </tr>
                            <tr>
                                <td>May 1<sup>st</sup>, 2018</td>
                                <td>2</td>
                                <td>2</td>
                                <td>1</td>
                                <td>$42.00</td>
                                <td>NO</td>
                                <td>$42.00</td>
                            </tr>
                        </tbody>
                        <tfoot>
                            <tr>
                                <th>TOTALS</th>
                                <th>38</th>
                                <th>6</th>
                                <th>3</th>
                                <th>$628.00</th>
                                <th>2</th>
                                <th>$478.00</th>
                            </tr>
                        </tfoot>
                    </table>
                </div>

                <div class="row">
                    <div class="u-text-right">
                        <button class="button print-report">DOWNLOAD REPORT</button>
                        <button class="button send-report">SEND REPORT</button>
                    </div>
                </div>
            </div>

        </article><!-- .row -->
    </section><!-- .section -->


<?php require_once('footer.php'); ?>