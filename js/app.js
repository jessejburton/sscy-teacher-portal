// Main Angular App File

var sscy = angular.module('SSCY',[])

// Navigation Controller
sscy.controller('navigationController',['$scope',function($scope){

    $scope.rootURL = '/internal/'

    // Change this to read from a folder config file
    $scope.navItems = [
        {'text':'Dashboard','link' : $scope.rootURL},
        {'text':'Classes','link' : $scope.rootURL + 'classes.php'},
        {'text':'Registration','link' : $scope.rootURL + 'registration.php'},
        {'text':'Reports','link' : $scope.rootURL + 'reports.php'},
        {'text':'My Profile','link' : $scope.rootURL + 'profile.php'}
    ];
}]);

// Class Controller
sscy.controller('classController',['$scope', '$http', function($scope, $http){

    $scope.classes = [];
    $scope.mode = "Add";
    $scope.yogaClass = {
        "name": "My Test Class",
        "description": "fdsf"
    }
    $scope.weekdays = {
        Sunday: false, 
        Monday: false,
        Tuesday: false,
        Wednesday: false,
        Thursday: false,
        Friday: false,
        Saturday: false
    };

    // get all classes
    $scope.getClasses = function() {
        $http({ 
                method:'GET',
                url: '/internal/api/classes', 
                headers: { 'Content-Type':'application/json' }
            })
            .then(function successCallback(response) {
                $scope.classes = response.data;
            }, function errorCallback(response) {
                alert("Error" + JSON.stringify(response));
            });
    };

    // Add a class
    $scope.addClass = function(){
        $scope.classes.push({
            'id':3,
            'teacher':'John Howes',
            'name':$scope.className,
            'date':$scope.classDate,
            'starttime':$scope.classStartTime,
            'endtime':$scope.classEndTime
        });
    };

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
            url: '/internal/api/profile', 
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
            url: '/internal/api/profile/save/' + $scope.profile.account_id, 
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

    $scope.username = "jessejburton";
    $scope.password = "password";

    $scope.details = "hello";

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
            url: '/internal/api/login', 
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
            $scope.message.show = true;
            return;
        }, function errorCallback(response) {
            $scope.message.text = response.data;
            $scope.message.show = true;
            return;
        });
    };

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
        return $filter('date')(tempdate, "h:mm a");
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