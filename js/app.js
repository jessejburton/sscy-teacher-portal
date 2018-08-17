// Main Angular App File

var sscy = angular.module('SSCY',['720kb.datepicker','rzModule']);

// Navigation Controller
sscy.controller('navigationController',['$scope','$rootScope',function($scope,$rootScope){

    // Change this to read from a folder config file
    $scope.navItems = [
        {'text':'Dashboard','link' : siteRootURL },
        {'text':'Classes','link' : siteRootURL  + 'classes.php'},
        {'text':'Registration','link' : siteRootURL  + 'registration.php'},
        {'text':'Reports','link' : siteRootURL  + 'reports.php'},
        {'text':'My Profile','link' : siteRootURL  + 'profile.php'}
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

    // Related to editing / adding classes
    $scope.saveClassButtonText = "Add Class";
    $scope.classFormOpen = false;

    $scope.currentClass = {
        "mode": "Add",
        "message": {
            "success": false,
            "text": "",
            "type": ""
        },
        "show": false,
        "saveClassButtonText": "Save Class",
        "class_id": 0,
        "name": "",
        "description": "",
        "day": 4
    }

    /** WEEKDAYS **/
    $scope.weekdays = []
    $scope.weekdays.push({"label": "Sundays", "value": 0});
    $scope.weekdays.push({"label": "Mondays", "value": 1});
    $scope.weekdays.push({"label": "Tuesdays", "value": 2});
    $scope.weekdays.push({"label": "Wednesdays", "value": 3});
    $scope.weekdays.push({"label": "Thursdays", "value": 4});
    $scope.weekdays.push({"label": "Fridays", "value": 5});
    $scope.weekdays.push({"label": "Saturdays", "value": 6});

    // Constants
    const exception_window = document.querySelector('.exceptions');
    const overlay = document.querySelector('.overlay');
    const class_form = document.querySelector('.class__form-container');

    // Time Sliders
    const times = [
        "6:00 AM","6:15 AM","6:30 AM","6:45 AM",
        "7:00 AM","7:15 AM","7:30 AM","7:45 AM",
        "8:00 AM","8:15 AM","8:30 AM","8:45 AM",
        "9:00 AM","9:15 AM","9:30 AM","9:45 AM",
        "10:00 AM","10:15 AM","10:30 AM","10:45 AM",
        "11:00 AM","11:15 AM","11:30 AM","11:45 AM",
        "12:00 PM","12:15 PM","12:30 PM","12:45 PM",
        "1:00 PM","1:15 PM","1:30 PM","1:45 PM",
        "2:00 PM","2:15 PM","2:30 PM","2:45 PM",
        "3:00 PM","3:15 PM","3:30 PM","3:45 PM",
        "4:00 PM","4:15 PM","4:30 PM","4:45 PM",
        "5:00 PM","5:15 PM","5:30 PM","5:45 PM",
        "6:00 PM","6:15 PM","6:30 PM","6:45 PM",
        "7:00 PM","7:15 PM","7:30 PM","7:45 PM",
        "8:00 PM","8:15 PM","8:30 PM","8:45 PM",
        "9:00 PM","9:15 PM","9:30 PM","9:45 PM",
        "10:00 PM"
    ];

    // Set the time based on value for the sliders
    $scope.translateTime = function(value) {
        var val =  times[value];
        return val
    };

    // Set up the sliders as objects
    $scope.classTime = {
        minValue: 0,
        maxValue: 0,
        options: {
            floor: 0,
            ceil: 64,
            translate: $scope.translateTime,
            draggableRange: true
        }
    }

    $scope.slider = {
        minValue: 1,
        maxValue: 8,
        options: {
          floor: 0,
          ceil: 10,
          draggableRange: true
        }
      };


    // get all classes
    $scope.getClasses = function() {

        $http({ 
                method:'GET',
                url: siteRootURL + 'api/classes/' + $scope.selectedTeacher.account_id, 
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
            url: siteRootURL  + 'api/exception/types', 
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
            url: siteRootURL  + 'api/teachers', 
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
            url: siteRootURL  + 'api/rooms', 
            headers: { 'Content-Type':'application/json' }
        })
        .then(function successCallback(response) {
            $scope.rooms = response.data;
        }, function errorCallback(response) {
            alert("Error" + JSON.stringify(response));
    });

    // Add a Class
    $scope.addClass = function(){

        // disable scrolling
        document.body.className += ' ' + 'no-scroll';

        $scope.currentClass = {
            "saveClassButtonText": "Add Class",
            "mode": "Add",
            "show": true
        };

        // Show the overlay
        class_form.style.top = `${window.scrollY + 5}vh`;
        class_form.scrollTop = 0;
        class_form.classList.add('open');        
        overlay.style.left = 0;
        overlay.classList.add('open');
        document.getElementsByTagName("body")[0].style.overflow = "hidden";

        // Click handler to close on overlay click
        overlay.addEventListener("click", $scope.closeClassForm);

    }

    // Edit a Class
    $scope.editClass = function(currentClass){

        // disable scrolling
        document.body.className += ' ' + 'no-scroll';

        $scope.currentClass = currentClass;
        $scope.currentClass.saveClassButtonText = "Save Class";
        $scope.currentClass.mode = "Edit";
        $scope.currentClass.show = true;

        // Select the appropriate times
        var start_time = moment($scope.currentClass.schedules[0].start_time, "HH:mm A").format("h:mm A");
        var end_time = moment($scope.currentClass.schedules[0].end_time, "HH:mm A").format("h:mm A");
        $scope.classTime.minValue = times.findIndex(e => e == start_time);
        $scope.classTime.maxValue = times.findIndex(e => e == end_time);

        // Select the day
        $scope.currentClass.selectedDay = $scope.weekdays[$scope.currentClass.schedules[0].days];

        // Select the room
        $scope.currentClass.selectedRoom 
            = $scope.rooms.find(room => room.room_id == $scope.currentClass.schedules[0].room_id);
        
        // Show the overlay
        class_form.style.top = `${window.scrollY + 5}vh`;
        class_form.scrollTop = 0;
        class_form.classList.add('open');
        overlay.style.left = 0;
        overlay.classList.add('open');
        document.getElementsByTagName("body")[0].style.overflow = "hidden";

        // Click handler to close on overlay click
        overlay.addEventListener("click", $scope.closeClassForm);        

    }

    // Save a Class
    $scope.saveClass = function(){

        // SETUP THE DATES

        // From Date
        if($scope.currentClass.date_from == undefined){
            var date_from = "";
        } else {
            var date_from = new Date($scope.currentClass.date_from);
            date_from = moment(date_from).format("YYYY-MM-DD");
        }

        // To Date
        if($scope.currentClass.date_until == undefined){
            var date_to = "";
        } else {
            var date_to = new Date($scope.currentClass.date_until);
            date_to = moment(date_to).format("YYYY-MM-DD");
        }

        // Prepare the class data
        var data = {
            "name": $scope.currentClass.name,
            "description": $scope.currentClass.description,
            "teacher_id": $scope.teachers.find(t => t.account_id == $scope.selectedTeacher.account_id).teacher_id,            
            "room_id": $scope.currentClass.selectedRoom.room_id,            
            "start_time": moment(times[$scope.classTime.minValue], "h:mm A").format("HH:mm:ss"),
            "end_time": moment(times[$scope.classTime.maxValue], "h:mm A").format("HH:mm:ss"),
            "day": $scope.currentClass.selectedDay.value,
            "date_from": date_from.toString(),
            "date_to":  date_to.toString()        
        };

        /* TODO - ERROR TRAPPING */

        // Update or Add
        if ( "class_id" in $scope.currentClass ){
            var putUrl = siteRootURL  + 'api/class/update/' + $scope.currentClass.class_id
        } else {
            var putUrl = siteRootURL  + 'api/class/add'
        }

        // Send the data
        $http({ 
            method: 'PUT',
            url: putUrl, 
            headers: { 'Content-Type':'application/json' },
            data: data
        })
        .then(function successCallback(response) {
            $scope.currentClass.message = response.data;
            class_form.scrollTop = 0; // Scroll to the top to see the message

            if($scope.currentClass.message.success) {
                $scope.getClasses();
                $scope.closeClassForm();
            }

        }, function errorCallback(response) {
            $scope.currentClass.message.success = false;
            $scope.currentClass.message.type = "danger";
            $scope.currentClass.message.text = "Error" + JSON.stringify(response);
        });

    }

    // Update Current Class Day - used for when user changes the day in the dropdown
    $scope.updateCurrentClassDay = function(){
        if ( "schedules" in $scope.currentClass ){
            $scope.currentClass.schedules[0].days = $scope.currentClass.selectedDay.value.toString();
        }
    }

    // Update Current Class Room - used for when user changes the day in the dropdown
    $scope.updateCurrentClassRoom = function(){
        if( "schedules" in $scope.currentClass ){
            $scope.currentClass.schedules[0].room_id = $scope.currentClass.selectedRoom.room_id.toString();
            $scope.currentClass.schedules[0].room_name = $scope.currentClass.selectedRoom.name.toString();
        }
    }

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

        // disable scrolling
        document.body.className += ' ' + 'no-scroll';

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
        exception_window.style.top = `${window.scrollY + 5}vh`;
        overlay.style.left = 0;
        exception_window.classList.add('open');
        overlay.classList.add('open');
        document.getElementsByTagName("body")[0].style.overflow = "hidden";

        // close modal on overlay click
        overlay.addEventListener("click", $scope.closeExceptions);        
        
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

    // Close Class Form
    $scope.closeClassForm = function(){

        // Reset the current class
        $scope.currentClass = {    
            "mode": "Add",
            "message": {
                "success": false,
                "text": "",
                "type": ""
            },
            "show": false,
            "saveClassButtonText": "Save Class",
            "class_id": 0,
            "name": "",
            "description": "",
            "startTime": "",
            "endTime": ""
        };


        // Hide the class form and overlay
        class_form.classList.remove('open');
        overlay.classList.remove('open');
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
            url: siteRootURL  + 'api/exception/add', 
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
            url: siteRootURL  + 'api/exception/remove/' + id, 
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
            url: siteRootURL  + 'api/profile', 
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
            url: siteRootURL  + 'api/profile/save/' + $scope.profile.account_id, 
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
            url: siteRootURL  + 'api/login', 
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
    $scope.registration_date = "";
    $scope.show = true;
    $scope.registrant = {
        "name_first": "",
        "name_last": "",
        "email": "",
        "is_pr": false,
        "is_ky": false,
        "paid": 16
    }

    // Get the url for the API call
    $user_id = document.getElementById('hidden_user_id').value;

    // get all classes with registrants for the current teacher
    $scope.getClasses = function() {
        $http({ 
                method:'GET',
                url: siteRootURL  + 'api/classes/' + $user_id, 
                headers: { 'Content-Type':'application/json' }
            })
            .then(function successCallback(response) {
                $scope.classes = response.data;
            }, function errorCallback(response) {
                alert("Error" + JSON.stringify(response));
            });
    };

    // Add Registrant and Check them In
    $scope.addRegistrant = function(){

        // Prepare the data
        $scope.registrant.checked_in = true;
        $scope.registrant.class_id = $scope.class.class_id;

        // Registration Date
        reg_date = new Date($scope.registration_date);
        reg_date = moment(reg_date).format("YYYY-MM-DD");
        $scope.registrant.registration_date = reg_date;

        /*** Error Trapping ***/
        if($scope.registrant.class_id == undefined){
            alert("Please select a class");
            return false;
        }

        if($scope.registrant.registration_date == "Invalid date"){
            alert("Please select a date");
            return false;
        }

        if($scope.registrant.name_first.length == 0 || $scope.registrant.name_last.length == 0){
            alert("Please enter a first and last name");
            return false;
        }

        // Send the data
        $http({ 
            method: 'PUT',
            url: siteRootURL + 'api/registration/add', 
            headers: { 'Content-Type':'application/json' },
            data: $scope.registrant
        })
        .then(function successCallback(response) {

            $scope.message = response.data;

            if($scope.message.success){
                // Add the registration ID to the registrant
                $scope.registrant.registration_id = $scope.message.registration_id;
                // Add the registrant to the Registrants list
                $scope.registrants.push($scope.registrant);

                // Reset the registrant
                $scope.registrant = {
                    "name_first": "",
                    "name_last": "",
                    "email": "",
                    "is_pr": false,
                    "is_ky": false,
                    "paid": 16
                }
            }

        }, function errorCallback(response) {
            $scope.message.success = false;
            $scope.message.type = "danger";
            $scope.message.text = "Error" + JSON.stringify(response);
        });

    }

    // Check in the selected registrant
    $scope.checkinRegistrant = function(registrant) {
 
        // Prepare the data
        registrant.checked_in = true;

        /*** Error Trapping ***/

        // Send the data
        $http({ 
            method: 'PUT',
            url: siteRootURL + 'api/registration/update/' + registrant.registration_id, 
            headers: { 'Content-Type':'application/json' },
            data: registrant
        })
        .then(function successCallback(response) {

            $scope.message = response.data;

        }, function errorCallback(response) {
            $scope.message.success = false;
            $scope.message.type = "danger";
            $scope.message.text = "Error" + JSON.stringify(response);
        });

    };

    // When PR is checked
    $scope.prUpdate = function() {
        $scope.registrant.paid = 5;
    };

    // When KY is checked
    $scope.kyUpdate = function() {
        $scope.registrant.paid = 0;
    };    

    // Get the registrants based on the selected value
    $scope.getRegistrantsByClass = function() {

        var reg_date = new Date($scope.registration_date);
            reg_date = moment(reg_date).format("YYYY-MM-DD");
        
        /*** ERROR TRAPPING ***/
        if(reg_date == "Invalid date" || $scope.class.length == 0){
            return false;
        }

        $http({ 
                method:'GET',
                url: siteRootURL  + 'api/registration/' + $scope.class.class_id + '/' + reg_date, 
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
    $scope.pin_value = "355";
    $scope.error_message = "";
    $scope.classes = [];
    $scope.registration_mode = true;
    $scope.registered = [];

    const currentDate = new Date();
    const formattedDate = currentDate.getFullYear() + '-' 
                            + ('0' + (currentDate.getMonth()+1)).slice(-2) + '-'
                            + ('0' + currentDate.getDate()).slice(-2);

    // Get the registrants for a specific class
    $scope.getRegistrants = function() {

        var reg_date = new Date();
            reg_date = moment(reg_date).format("YYYY-MM-DD");
        
        /*** ERROR TRAPPING ***/
        if(reg_date == "Invalid date" || $scope.class.length == 0){
            return false;
        }

        $http({ 
                method:'GET',
                url: siteRootURL  + 'api/registration/' + $scope.class.class_id + '/' + reg_date, 
                headers: { 'Content-Type':'application/json' }
            })
            .then(function successCallback(response) {
                $scope.registered = response.data;
            }, function errorCallback(response) {
                alert("Error" + JSON.stringify(response));
        });

    };                            

    // Get the available classes
    $scope.getAvailableClasses = function() {

        $http({ 
                method:'GET',
                url: siteRootURL  + 'api/class/date/' + formattedDate, 
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
        $scope.registered = $scope.getRegistrants();
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
            document.querySelector('.signin').classList.remove("open");
            $scope.open = false;
            $scope.error_message = "";
            $scope.pin = "";
        } else {
            $scope.error_message = "Invalid Pin!";
        }

    }

    $scope.toggleSigninMode = function(){

        if($scope.open){
            // if is to handle if they click twice on the lotus button
            if($scope.mode !== "exit"){
                $scope.lastMode = $scope.mode;
            }

            $scope.mode = "exit";

            // Set focus to the pin textbox
            $(".pin-input").focus(); // NOT WORKING
        } else {
            // Open the signin mode
            $scope.open = true;
            $scope.lastMode = $scope.mode;
            $scope.mode = "setup";
            document.querySelector('.signin').classList.add("open");
        }

        console.table($scope);
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

/*************************************************
 * 
 * Inline If Filter
 * 
 * Takes in an conditional and outputs either the
 * first or second value
 * 
 * i.e. {{foo == "bar" | iif : "it's true" : "no, it's not"}} 
 * 
 *************************************************/
sscy.filter('iif', function () {
    return function(input, trueValue, falseValue) {
         return input ? trueValue : falseValue;
    };
 });