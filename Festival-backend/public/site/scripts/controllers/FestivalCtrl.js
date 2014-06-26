(function(){
    'use strict';

    var controllers = angular.module('ddsApp.controllers');

    controllers.controller('ddsApp.controllers.FestivalCtrl',['$scope', '$routeParams', 'ddsApp.services.WeatherSrvc', 'festivals', 'themecolor', 'ddsApp.services.UserService', function($scope, $routeParams, WeatherSrvc, festivals, themecolor, UserService){

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

        var festivalId = $routeParams.festivalId;
        $scope.festival = _.find(festivals, {'id':festivalId});



        $scope.isFestivalChosen = WeatherSrvc.isFestivalAlreadyChosen(festivalId);

        $scope.addChosenFestival = function(){
            if(!WeatherSrvc.isFestivalAlreadyChosen(festivalId)){
                WeatherSrvc.addFestivalToChoice(festivalId);
                $scope.isFestivalChosen = true;
            }
        };

        $scope.removeChosenFestival = function(){
            if(WeatherSrvc.isFestivalAlreadyChosen(festivalId)){
                WeatherSrvc.removeFestivalFromChoice(festivalId);
                $scope.isFestivalChosen = false;
            }
        };
    }]);
})();
