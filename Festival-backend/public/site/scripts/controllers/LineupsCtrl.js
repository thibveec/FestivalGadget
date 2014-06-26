(function(){
    'use strict';

    var controllers = angular.module('ddsApp.controllers');

    controllers.controller('ddsApp.controllers.LineupsCtrl',['$scope', '$routeParams', 'ddsApp.services.WeatherSrvc', 'ddsApp.services.UserService','lineups', 'festivalchoice','themecolor', function($scope, $routeParams, WeatherSrvc,UserService, lineups, festivalchoice, themecolor){

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


        $scope.festivalchoice = festivalchoice;

        $scope.lineups = lineups;
        if($scope.festivalchoice[0] !== undefined){
        $scope.givefestival =   $scope.festivalchoice[0].id.toString();

       $scope.givenfestivals = _.filter(lineups, {'festival_id':$scope.givefestival});
        }


        $scope.isList = true;
        $scope.changeIsList = function(isList){
            $scope.isList = isList;
            $scope.lflrefresh = !isList;
        };

        $scope.isAlreadyInSchedule = function(lineupId){
            return WeatherSrvc.isLineupAlreadyInSchedule(lineupId.toString());
        };
        $scope.isNotInSchedule = function(lineupId){
            return WeatherSrvc.isLineupNotInSchedule(lineupId.toString());
        };

        $scope.addToSchedule = function(lineupId){

            if(!WeatherSrvc.isLineupAlreadyInSchedule(lineupId)){
                WeatherSrvc.addLineupToSchedule(lineupId);
                WeatherSrvc.isAlreadyInSchedule = true;

            }

        };



        $scope.removeFromSchedule = function(lineupId){

            if(WeatherSrvc.isLineupAlreadyInSchedule(lineupId)){

                WeatherSrvc.removeLineupFromSchedule(lineupId);
                WeatherSrvc.isAlreadyInSchedule = false;
            }


        };

    }]);
})();
