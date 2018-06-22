// Main Angular App File

var sscy = angular.module('SSCY',['720kb.datepicker'])

// Navigation Controller
sscy.controller('navigationController',['$scope','$rootScope',function($scope,$rootScope){

    // Change this to read from a folder config file
    $scope.navItems = [
        {'text':'Dashboard','link' : rootURL},
        {'text':'Classes','link' : rootURL + 'classes.php'},
        {'text':'Registration','link' : rootURL + 'registration.php'},
        {'text':'Reports','link' : rootURL + 'reports.php'},
        {'text':'My Profile','link' : rootURL + 'profile.php'}
    ];
}]);

// Class Controller
sscy.controller('classController',['$scope', '$http', function($scope, $http){

    $scope.classes = {};    // Will contain an object of classes with the names as keys
    $scope.exception = {    // Will contain a single exception as it is being worked on
        "date": "",
        "type_id": 0,
        "invalid_days": [],
        "class": {}
    };  
    $scope.message = {
         "type": "",
         "message": "",
         "success": false
    };

    $scope.selectedTeacher = {};
    $scope.selectedTeacher.account_id = loggedInUserID;

    /** GLOBALIZE **/
    var weekday = [];
    weekday[0] =  "Sunday";
    weekday[1] = "Monday";
    weekday[2] = "Tuesday";
    weekday[3] = "Wednesday";
    weekday[4] = "Thursday";
    weekday[5] = "Friday";
    weekday[6] = "Saturday";

    // Constants
    const exception_window = document.querySelector('.exceptions');
    const overlay = document.querySelector('.overlay');

    // get all classes
    $scope.getClasses = function() {

        $http({ 
                method:'GET',
                url: rootURL + 'api/classes/' + $scope.selectedTeacher.account_id, 
                headers: { 'Content-Type':'application/json' }
            })
            .then(function successCallback(response) {
                $scope.classes = response.data;
            }, function errorCallback(response) {
                alert("Error" + JSON.stringify(response));
        });
        
    };
    
    /* EXCEPTIONS */

    // Populate Exception Types
    $http({ 
            method:'GET',
            url: rootURL + 'api/exception/types', 
            headers: { 'Content-Type':'application/json' }
        })
        .then(function successCallback(response) {
            $scope.types = response.data;
        }, function errorCallback(response) {
            alert("Error" + JSON.stringify(response));
    });    

    // Populate Teachers
    $http({ 
            method:'GET',
            url: rootURL + 'api/teachers', 
            headers: { 'Content-Type':'application/json' }
        })
        .then(function successCallback(response) {
            $scope.teachers = response.data;
        }, function errorCallback(response) {
            alert("Error" + JSON.stringify(response));
    });

    // Populate Rooms
    $http({ 
            method:'GET',
            url: rootURL + 'api/rooms', 
            headers: { 'Content-Type':'application/json' }
        })
        .then(function successCallback(response) {
            $scope.rooms = response.data;
        }, function errorCallback(response) {
            alert("Error" + JSON.stringify(response));
    });

    // Quick Cancel
    $scope.quickCancel = function(class_name){

        // Get the class details
        $scope.exception.class = $scope.classes[class_name];
        $scope.exception.class_id = $scope.exception.class.class_id;

        let days = $scope.exception.class.schedules[0].days[0];
        
        // Find out the next available class date
        var dayOfWeek = days;
        var date = new Date();
        var diff = date.getDay() - dayOfWeek;
        var lastClass = new Date(date.setDate(date.getDate() - diff));

        if (diff > 0) {
            date.setDate(lastClass.getDate() + 7);
        }
        else if (diff < 0) {
            date.setDate(lastClass.getDate() + ((-1) * diff))
        };

        // Preset the values 
        $scope.exception.date = moment(date).format('dddd, MMMM D, YYYY');
        $scope.exception.message = "There will be no class today, sorry for the inconvenience.";
        $scope.exception.type = $scope.types[0];
        
        // Show the exception window
        $scope.showExceptions(class_name);
    }

    // Show Exceptions
    $scope.showExceptions = function(class_name){

        // Get the class details
        $scope.exception.class = $scope.classes[class_name];
        $scope.exception.class_id = $scope.exception.class.class_id;

        // Set the invalid days array
        $scope.exception.invalid_days = [];
        for( var i = 0; i < 7; i++ ){
            if(i != $scope.exception.class.schedules[0].days){ // Only add if it isn't in the days.
                $scope.exception.invalid_days.push(i);
            }
        };
        
        // Show the exception window
        exception_window.style.top = `${window.scrollY + 50}px`;
        overlay.style.left = 0;
        exception_window.classList.add('open');
        overlay.classList.add('open');
        document.getElementsByTagName("body")[0].style.overflow = "hidden";
        
    };

    // Close Exception Window
    $scope.closeExceptions = function(){

        // Reset the current exception
        $scope.exception = {    
            "date": "",
            "type_id": 0,
            "invalid_days": []
        };


        // Hide the exception window and overlay
        document.querySelector('.exceptions').classList.remove('open');
        document.querySelector('.overlay').classList.remove('open');
        overlay.style.left = '100%';
        document.getElementsByTagName("body")[0].style.overflow = "auto";

    }

    // Add Exception
    $scope.addException = function(){ 

        /* ERROR TRAPPING */
        // Must Have an Exception Type
        if ($scope.exception.type == undefined){
            $scope.message.success = false;
            $scope.message.type = "danger";
            $scope.message.text = "You must select an exception type.";
            return;      
        }

        // Must be only days the class is on
        // First find out what day was passed in
        let exception_date = new Date($scope.exception.date);

        // If the selected date is not the same as the class date
        if( $scope.exception.class.schedules[0].days != exception_date.getDay() ){
            $scope.message.success = false;
            $scope.message.type = "danger";
            $scope.message.text = "Date must be on a " + weekday[date.getDay()];
            return
        }

        if ($scope.exception.type == 1){
            $scope.message.success = false;
            $scope.message.type = "danger";
            $scope.message.text = "You must select an exception type.";
            return;      
        }

        // format the date
        $scope.exception.date = exception_date.getFullYear() + '-' 
                        + ('0' + (exception_date.getMonth()+1)).slice(-2) + '-'
                        + ('0' + exception_date.getDate()).slice(-2);

        // set the type id
        //** $scope.type is bound as an object to the dropdown
        $scope.exception.type_id = $scope.exception.type.exception_type_id;
        
        // Send the data
        $http({ 
            method:'POST',
            url: rootURL + 'api/exception/add', 
            headers: { 'Content-Type':'application/json' },
            data: $scope.exception
        })
        .then(function successCallback(response) {
            $scope.message = response.data;
            if($scope.message.success) {

                // Add the exception to the classes exception list
                $scope.classes[$scope.exception.class.name].exceptions.push($scope.message.exception);

                // Reset the current exception
                $scope.exception = {    
                    "date": "",
                    "type_id": 0,
                    "invalid_days": []
                };
                
                $scope.closeExceptions();
            }
        }, function errorCallback(response) {
            $scope.message.success = false;
            $scope.message.type = "danger";
            $scope.message.text = "Error" + JSON.stringify(response);
        });
    }

    // Remove Exception
    $scope.removeException = function(id){ 

        // Confirm removal.
        if( ! confirm("Are you sure you want to remove this exception?") ){
            return false;
        }

        var exception = document.querySelector(".exception-" + id),
            classname = exception.dataset.classname,
            index = $scope.classes[classname].exceptions.findIndex(e => e.exception_id == id);
        
        // Send the data
        $http({ 
            method:'DELETE',
            url: rootURL + 'api/exception/remove/' + id, 
            headers: { 'Content-Type':'application/json' }
        })
        .then(function successCallback(response) {
            $scope.message = response.data;
            console.log($scope.message);
            if($scope.message.success) {                
                $scope.classes[classname].exceptions.splice(index, 1);
                // remove the exception 
                /* NEEDS WORK ~ This should remove it from the aray either way. I had
                to do this to get it to work, not sure if it will even work if there are
                more than one item in the array though. 

                Not working for some reason so falling back to jQuery in order to 
                move on but want to COME BACK to this.
                if( $scope.classes[classname].exceptions.length == 1 ){
                    alert("here");
                    $scope.classes[classname].exceptions = [];    
                } else {
                    $scope.classes[classname].exceptions.splice(index, 1);
                }*/
            }

        }, function errorCallback(response) {
            $scope.message.success = false;
            $scope.message.type = "danger";
            $scope.message.text = "Error" + JSON.stringify(response);
        });
    }
}]);

// Profile Controller
sscy.controller('profileController',['$scope', '$http', '$timeout', function($scope, $http, $timeout){

    // Model for the profile
    $scope.profile = {
        "account_id": 0,
        "name_first": "",
        "name_last": "",
        "email": "",
        "bio": "",
        "photo": ""
    };

    $scope.getLoggedInProfile = function(){

        // Get the current users profile
        $http({ 
            method:'GET',
            url: rootURL + 'api/profile', 
            headers: { 'Content-Type':'application/json' }
        })
        .then(function successCallback(response) {
            $scope.profile = response.data;
            return;
        }, function errorCallback(response) {
            $scope.message.text = response.data;
            $scope.message.show = true;
            return;
        });

    };

    $scope.saveProfile = function(){

        var dataObj = $scope.profile;

        $http({ 
            method:'PUT',
            url: rootURL + 'api/profile/save/' + $scope.profile.account_id, 
            headers: { 'Content-Type':'application/json' },
            data: dataObj
        })
        .then(function successCallback(response) {
            $scope.message = response.data;
            $scope.message.show = true;
        }, function errorCallback(response) {
            $scope.message.text = response.data;
            $scope.message.show = true;
        });

        // Scroll to the top of the page (need to find a better way to do this)
        document.body.scrollTop = document.documentElement.scrollTop = 0;

    };

}]);

// Login Controller
sscy.controller('loginController',['$scope', '$http', function($scope, $http){

    $scope.username = "";
    $scope.password = "";

    $scope.message = {
        "show": false,
        "text": "",
        "type": ""
    };

    $scope.checkUserLogin = function(){

        var dataObj = {
            "username": $scope.username,
            "password": $scope.password
        };

        // Display error message if the user doesn't enter a username or password
        if(dataObj.username.length == 0 || dataObj.password.length == 0){
            $scope.message.text = "Please enter a username and password.";
            $scope.message.type = "danger";
            $scope.message.show = true;
            return;
        }

        $http({ 
            method:'POST',
            url: rootURL + 'api/login', 
            headers: { 'Content-Type':'application/json' },
            data: dataObj
        })
        .then(function successCallback(response) {
            // Refresh the page if the user was logged in successfully
            if(response.data.success){
                window.location = window.location;
                return;
            }

            // Show any messages
            $scope.message = response.data;
            $scope.message.show = true; // ERROR TRAPPING change to if maybe?
            return;
        }, function errorCallback(response) {
            $scope.message.text = response.data;
            $scope.message.show = true;
            return;
        });
    };

}]);

// Registration Controller
sscy.controller('registrationController',['$scope', '$http', function($scope, $http){

    // Set up some variables
    $scope.classes = [];
    $scope.registrants = [];
    $scope.class = "";
    $scope.show = false;

    // Get the url for the API call
    $user_id = document.getElementById('hidden_user_id').value;

    // get all classes with registrants for the current teacher
    $scope.getClassesWithRegistrants = function() {
        $http({ 
                method:'GET',
                url: rootURL + 'api/registration/classes/' + $user_id, 
                headers: { 'Content-Type':'application/json' }
            })
            .then(function successCallback(response) {
                $scope.classes = response.data;
            }, function errorCallback(response) {
                alert("Error" + JSON.stringify(response));
            });
    };

    // Get the registrants based on the selected value
    $scope.getRegistrantsByClass = function() {

        // $scope.class gets updated by the ng-model of the select box

        $http({ 
                method:'GET',
                url: rootURL + 'api/registration/' + $scope.class.value, 
                headers: { 'Content-Type':'application/json' }
            })
            .then(function successCallback(response) {
                $scope.registrants = response.data;
                $scope.show = true;
            }, function errorCallback(response) {
                alert("Error" + JSON.stringify(response));
        });

    };
    
}]);

// Signin Controller
sscy.controller('signinController',['$scope', '$http', function($scope, $http){

    // Get a reference to the controller container
    const signin = document.querySelector('.signin');

    // Set up the variables
    $scope.class = {};
    $scope.mode = "setup";
    $scope.lastMode = "setup";
    $scope.open = false;
    $scope.pin = "";
    $scope.pin_value = "0355";
    $scope.error_message = "";
    $scope.classes = [];

    const currentDate = new Date();
    const formattedDate = currentDate.getFullYear() + '-' 
                            + ('0' + (currentDate.getMonth()+1)).slice(-2) + '-'
                            + ('0' + currentDate.getDate()).slice(-2);

    // Get the available classes
    $scope.getAvailableClasses = function() {

        $http({ 
                method:'GET',
                url: rootURL + 'api/class/date/' + formattedDate, 
                headers: { 'Content-Type':'application/json' }
            })
            .then(function successCallback(response) {
                $scope.classes = response.data;
            }, function errorCallback(response) {
                alert("Error" + JSON.stringify(response));
        });

    };

    // Select the class for registration
    $scope.selectClass = function(){
        let class_name = document.querySelector(".class-select").value;

        $scope.class = $scope.classes.find(c => c.name = class_name);
    }

    // Enter Signin Mode
    $scope.enterSigninMode = function(){
        // Check if they have selected a class and if so then go to signin mode
        if($scope.class.name !== undefined){
            $scope.mode = "signin";
        }
    }

    // Close Exit Mode
    $scope.closeExit = function(){
        $scope.mode = $scope.lastMode;
    }

    $scope.checkPin = function(e) { 

        if($scope.pin == $scope.pin_value){
            $scope.error_message = "";
            $scope.open = false;
            document.querySelector('.signin').classList.remove("open");
            $scope.pin = "";
        } else {
            $scope.error_message = "Invalid Pin!";
        }

    }

    $scope.toggleSigninMode = function(){
        if($scope.open){
            $scope.lastMode = $scope.mode;
            $scope.mode = "exit";
        } else {
            // Open the signin mode
            $scope.open = true;
            $scope.mode = "setup";
            document.querySelector('.signin').classList.add("open");
        }
    }

    // Event Listeners

    // Listen for key up on pin screen
    const pin = signin.querySelector('.pin-input');
    pin.addEventListener('keyup', $scope.checkPin);

}]);

/*************************************************
 * 
 * Time Format Filter
 * 
 * Added to display the time from the database since
 * it comes back as just the time in text format 
 * 
 *************************************************/
sscy.filter('formatTime', function formatTime($filter){
    return function(text){
        // Convert the time text to a date
        var date_str = "01-01-1999 " + text;        
        var  tempdate= new Date(date_str);

        // Return the filtered time
        return $filter('date')(tempdate, "h:mma");
    }
});

/*************************************************
 * 
 * Days of Week Filter
 * 
 * Takes in an array of numbers and displays the 
 * corresponding days of the week
 * 
 * i.e. 0,1,3 -> Sunday,Monday,Wednesday 
 * 
 *************************************************/
sscy.filter('daysOfWeek', function daysOfWeek($filter){
    return function(text){
        if(text == undefined) return;

        var weekday = [];
        weekday[0] =  "Sunday";
        weekday[1] = "Monday";
        weekday[2] = "Tuesday";
        weekday[3] = "Wednesday";
        weekday[4] = "Thursday";
        weekday[5] = "Friday";
        weekday[6] = "Saturday";

        // get a new array
        var days_arr = text.split(',');
        var days_text_arr = [];

        for(d in days_arr){
            days_text_arr.push(weekday[days_arr[d]]);
        }

        // Return the filtered time
        return days_text_arr.toString();
    }
});