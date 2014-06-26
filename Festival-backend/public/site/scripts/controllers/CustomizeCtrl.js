(function(){
    'use strict';

    var controllers = angular.module('ddsApp.controllers');

    controllers.controller('ddsApp.controllers.CustomizeCtrl',['$scope', 'ddsApp.services.WeatherSrvc', 'colors',  'ddsApp.services.UserService',  function($scope,  WeatherSrvc, colors, UserService){

        $scope.username = UserService.username;
        $scope.userIsLoggedIn =  UserService.isLogged;
        $scope.colors = colors;

        $scope.isList = true;
        $scope.changeIsList = function(isList){
            $scope.isList = isList;
            $scope.lflrefresh = !isList;
        };


        $scope.isTheme = function(colorId){
            return WeatherSrvc.isColorInTheme(colorId.toString());
        };
        $scope.isNotmyTheme = function(colorId){
            return WeatherSrvc.isColorNotTheme(colorId.toString());
        };


        $scope.newTheme = function(colorId){

            if(!WeatherSrvc.isThemeAlreadyChosen(colorId)){
                WeatherSrvc.addThemeColor(colorId);
                WeatherSrvc.isTheme = true;


            }

        };
        $scope.removeTheme = function(colorId){

            if(WeatherSrvc.isThemeAlreadyChosen(colorId)){

                WeatherSrvc.removeThemeColor(colorId);
                WeatherSrvc.isTheme = false;
            }


        };
    }]);
})();
