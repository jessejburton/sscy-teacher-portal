// Main Angular App File

var sscy = angular.module('SSCY',[])

// Navigation Controller
sscy.controller('navigationController',['$scope',function($scope){
    $scope.navItems = [
        {'text':'Dashboard','link':'/SSCY/'},
        {'text':'Classes','link':'/SSCY/ANGULAR/classes.php'},
        {'text':'Registration','link':'/SSCY/ANGULAR/registration.php'},
        {'text':'Reports','link':'/SSCY/ANGULAR/reports.php'},
        {'text':'My Profile','link':'/SSCY/ANGULAR/profile.php'}
    ];
}]);

// Class Controller
sscy.controller('classController',['$scope',function($scope){

    // Array of classes
    $scope.classes = [
        {
            'id':1,
            'teacher':'John Howes',
            'name':'Hatha Mixed Levels with John',
            'date':'04/23/2018',
            'starttime':'4:00PM',
            'endtime':'5:30PM'
        },
        {
            'id':2,
            'teacher':'John Howes',
            'name':'Yoga for Beginners with John',
            'date':'04/23/2018',
            'starttime':'1:00PM',
            'endtime':'2:30PM'
        }
    ];

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