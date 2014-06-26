(function(){
    'use strict';

    var controllers = angular.module('ddsApp.controllers');

    controllers.controller('ddsApp.controllers.AgendaCtrl',['$scope',  'ddsApp.services.WeatherSrvc', 'schedule', 'themecolor',  'ddsApp.services.UserService',   function($scope,  WeatherSrvc, schedule, themecolor,UserService ){

        $scope.username = UserService.username;
        $scope.userIsLoggedIn =  UserService.isLogged;
        $scope.themecolor = themecolor;
        console.log(  $scope.themecolor.length);
        if($scope.themecolor.length === 0 ){
            // default
            $scope.colorvalue = '#0050ef';
        }else{
            $scope.colorvalue = $scope.themecolor[0].value.toString();

        }

     $scope.schedule = schedule;
        console.log(schedule);



        $scope.isList = true;
        $scope.changeIsList = function(isList){
            $scope.isList = isList;
            $scope.lflrefresh = !isList;
        };

    }]);
})();
