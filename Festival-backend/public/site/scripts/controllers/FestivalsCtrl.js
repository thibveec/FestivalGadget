(function(){
    'use strict';

    var controllers = angular.module('ddsApp.controllers');

    controllers.controller('ddsApp.controllers.FestivalsCtrl',['$scope', '$routeParams', 'ddsApp.services.WeatherSrvc', 'festivals', 'themecolor','ddsApp.services.UserService',  function($scope, $routeParams, WeatherSrvc, festivals, themecolor, UserService){

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

        $scope.festivals = festivals;

        $scope.isList = true;
        $scope.changeIsList = function(isList){
            $scope.isList = isList;
            $scope.lflrefresh = !isList;
        };

        $scope.isFestivalChosen = function(festivalId){
            return WeatherSrvc.isFestivalAlreadyChosen(festivalId.toString());
        };



    }]);
})();
