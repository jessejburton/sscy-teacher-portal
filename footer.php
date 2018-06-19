    </main><!-- main -->

        <!-- Signin Mode -->
        <div class="signin" ng-controller="signinController" ng-init="getAvailableClasses()">
            <!-- Open and Close button -->
            <div class="signin__button" ng-click="toggleSigninMode()">
                <span class="signin__icon"><?php require_once( 'lotus-white-svg.php' ); ?></span>
            </div>

            <!-- Signin Background -->
            <div class="signin__background">&nbsp;</div>

            <div class="signin__content">
                <!-- Setup -->
                <div class="signin__setup" ng-if="mode == 'setup'">
                    <h2>Choose a class</h2>
                    <select class="input-select class-select" 
                        ng-if="classes.length > 0" 
                        ng-change="selectClass()"
                        ng-model="class">
                        <option ng-repeat="class in classes">{{class.name}}</option>
                    </select>

                    <div class="button-group u-text-center" ng-if="classes.length > 0">
                        <button class="button" ng-click="enterSigninMode()">Enter Signin Mode</button>
                    </div>

                    <!-- If there are no classes today --> 
                    <div ng-if="classes.length == 0" ng-cloak>
                        There are no available classes to sign people in to today.
                    </div>
                </div>

                <!-- Signin -->
                <div class="signin__collect" ng-if="mode == 'signin'" ng-cloak>
                    <div class="signin_class-details u-bottom-space">
                        <h4>{{class.name}}</h4>
                    </div>

                    <div class="signin__collect-new u-half">
                        <h2>New Member</h2>
                        <input type="text" placeholder="first name" class="input-text" />
                        <input type="text" placeholder="last name" class="input-text" />
                        <input type="text" placeholder="email" class="input-text" />
                        
                        <div class="button-group u-text-center">
                            <button class="button">Check In</button>
                        </div>
                    </div>

                    <div class="signin__collect-existing u-half">
                        <h2>Existing Member</h2>
                        <input type="text" placeholder="email" class="input-text" />
                        
                        <div class="button-group u-text-center">
                            <button class="button">Check In</button>
                        </div>
                    </div>
                </div>

                <!-- Payment -->
                <div class="signin__collect" ng-show="mode == 'payment'" ng-cloak>
                    <div class="signin__collect-pay">
                        <h2>Payment</h2>

                        <span style="position: absolute;margin-top: 6px;">$</span>
                        <input type="text" placeholder="payment amount" class="input-text-inline" /><br />
                        <label class="input-text-label">payment amount</label>

                        <div class="button-group u-text-center">
                            <button class="button">Check In</button>
                        </div>
                    </div>
                </div>

                <!-- Exit -->
                <div class="signin__exit" ng-show="mode == 'exit'" ng-cloak>
                    <div class="signin__exit-pin">
                        <h2>Please enter the PIN to leave Signin Mode</h2>

                        <div class="alert alert-danger" ng-show="error_message.length > 0 && pin.length == 4">{{error_message}}</div>

                        <input type="text" placeholder="PIN" class="input-text pin-input" ng-model="pin" maxlength="4" />          

                        <div class="button-group u-text-center">
                            <a href="javscript:void(0);" ng-click="closeExit()">back to signin mode</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="overlay">&nbsp;</div>

        <!-- ANGULARJS -->
        <script src="js/vendor/angular.js"></script>

        <!-- MODERNIZR -->
        <script src="js/vendor/modernizr-3.5.0.min.js"></script>

        <!-- MOMENT.JS (Date Formatting) -->
        <script src="js/vendor/moment.js"></script>

        <!-- JQUERY -->
        <script src="js/vendor/jquery-3.2.1.min.js"></script>

        <!-- JQUERY UI -->
        <script src="js/vendor/jquery-ui.min.js"></script>

        <!-- DATEPICKER -->
        <script src="js/vendor/angular-datepicker.js"></script>

        <!-- Global JS -->
        <script src="js/config.js"></script>
        <script src="js/app.js"></script>

    </body>
</html>
