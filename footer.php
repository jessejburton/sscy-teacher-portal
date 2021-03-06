    </main><!-- main -->

        <!-- Signin Mode -->
        <div class="signin" ng-controller="signinController" ng-init="getAvailableClasses()">
            <!-- Open and Close button -->
            <div class="signin__button" ng-click="toggleSigninMode()">
                <span class="signin__icon"><?php require( 'lotus-white-svg.php' ); ?></span>
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
                        <option ng-repeat="class in classes" value="{{class.name}}">{{class.name}} - ({{class.name_first}} {{class.name_last}})</option>
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
                        <h4>{{class.name}} <small>with</small> {{class.name_first}} {{class.name_last}}</h4>
                    </div>

                    <div class="signin__collect-registered" ng-if="registration_mode">

                        <h2>Registered</h2>
                        <p>If you registered online, please click "Check In" beside your name in the list below.</p>

                        <br />
                        
                        <p>If you did not register online please &nbsp;&nbsp;&nbsp;<button class="button " ng-click="signup()">register now</button></p>

                        <table>
                        
                            <thead>
                                <tr>
                                    <th>Name</th>
                                    <th></th>
                                </tr>
                            </thead>

                            <tbody>
                                <tr ng-repeat="registrant in registered">
                                    <td>{{ registrant.name_first }} {{ registrant.name_last }}</td>
                                    <td>
                                        <button class="button button--checkin" ng-click="checkinRegistrant(registrant)" title='Check In' ng-if="!registrant.checked_in">Check In</button>
                                        <span ng-if="registrant.checked_in">Checked In</span>
                                    </td>
                                </tr>                            
                            </tbody>

                        </table>

                    </div>

                    <div class="signin__collect-new" ng-if="signup_mode">

                        <h2>New Member</h2>
                        <p><input type="text" placeholder="first name" class="input-text" ng-model="new_registrant.name_first" /></p>
                        
                        <p><input type="text" placeholder="last name" class="input-text" ng-model="new_registrant.name_last" /></p>
                        
                        <p><input type="text" placeholder="email" class="input-text"  ng-model="new_registrant.email" /></p>

                        <br /><br />

                        <h2>Acknowledgments</h2>
                        <div class="waiver">
                        <p><strong>Yoga Instruction and Liability Waiver and Release</strong></p>

<p>I understand that yoga is an ancient Indian system designed to make the body strong and flexible. I realise that it is important never to do any practice to the point of pain or discomfort. I am aware that there is some risk involved in all physical exercise and that I am responsible for recognising my own physical limits.</p>

<p>I understand that yoga is not a substitute for medical attention, examination, diagnosis or treatment, and that practising yoga is not recommended and is not safe under certain medical conditions. If I have any concerns about whether yoga is suitable for me or if I have a particular injury or medical condition, I will consult my physician before participating in a yoga class.</p>

<p>I hereby agree to irrevocably waive, release and discharge any and all claims and liabilities against the Salt Spring Centre of Yoga, its individual instructors or staff, and/or Dharma Sara Satsang Society for any personal injury, death or damage to the person or property.</p>
                        </div>

                        <p>
                            <input type="checkbox" id="waiver_checkbox" />
                            <label style="font-weight: normal;">By checking this box and entering your name you agree to all of the terms and conditions listed above. Please read the terms carefully.</label>
                        </p>

                        <!--<p>
                            <input type="checkbox">
                            <label style="font-weight: normal;">I have read { TEACHERS NAME }'s <a href="http://www.saltspringcentre.com/legal/cancellation-policy/" target="_blank" class="colored">Waiver</a> and agree to its terms.</label>
                        </p>-->
                        
                        <div class="button-group u-text-center">
                            <!--<a href="javascript:void(0);" ng-click="checkin()" style="margin-right: 40px;">cancel</a>-->
                            <button class="button" ng-click="signup_register()">Register and Check In</button>
                        </div>
                    
                    </div>
                </div>

                <!-- Exit -->
                <div class="signin__exit" ng-show="mode == 'exit'" ng-cloak>
                    <div class="signin__exit-pin">
                        <h2>Please enter the PIN to leave Signin Mode</h2>

                        <div class="alert alert-danger" ng-show="error_message.length > 0 && pin.length == 3 && pin != pin_value">{{error_message}}</div>

                        <input type="text" placeholder="PIN" class="input-text pin-input" ng-model="pin" maxlength="3" />          

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

        <!-- SLIDER -->
        <script src="js/vendor/angular-slider.js"></script>

        <!-- SLIDER -->
        <script src="js/config.js"></script>
        <script src="js/app-es6.js"></script>  

    </body>
</html>
