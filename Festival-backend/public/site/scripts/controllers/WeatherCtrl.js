(function(){
    'use strict';

    var controllers = angular.module('ddsApp.controllers');

    controllers.controller('ddsApp.controllers.WeatherCtrl',['$scope', 'daily', 'themecolor','ddsApp.services.UserService', function($scope, daily, themecolor, UserService){


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

        $scope.daily = daily;

        $scope.getClimaCon = function(iconId){
            switch(iconId){
                case 801:
                    return ' climacon cloud sun';
                case 804:
                    return ' climacon cloud';
                default:
                    return ' climacon sun';
            }
        };
    }]);
})();