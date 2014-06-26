(function(){
    'use strict';

    var controllers = angular.module('ddsApp.controllers');

    controllers.controller('ddsApp.controllers.MainCtrl',['$scope', 'ddsApp.services.WeatherSrvc', 'ddsApp.services.UserService','themecolor','$http', '$location', function($scope, WeatherSrvc, UserService, themecolor, $http, $location){


        var onlineuser = UserService.getOnlineUser();
        if (onlineuser !== null){
           if(onlineuser[0] != null){

        console.log(onlineuser[0]);

        UserService.username = onlineuser[0].username;
        UserService.isLogged = onlineuser[0].online;
        UserService.id = onlineuser[0].user_id;
        UserService.role = onlineuser[0].role;
        }
        }else{

        }



        $scope.username = UserService.username;
        $scope.userIsLoggedIn =  UserService.isLogged;
        $scope.userId = UserService.id;
        $scope.role = UserService.role;

        $scope.loginUser = function() {
            UserService.login({
                email: $scope.main.credentials.email,
                password: $scope.main.credentials.password
            }).success(function(data) {
                    if (data.error) {
                        console.log(data.error);
                        UserService.isLogged = false;
                        UserService.username = '';
                        $scope.username = UserService.username;
                        $scope.userIsLoggedIn =  UserService.isLogged;
                        UserService.removeLoggedoutUser($scope.onlineuser);

                    } else {
                       console.log("You are signed in!");
                      console.log(data);
                        UserService.isLogged = true;
                        UserService.username = data.username;
                        UserService.id = data.user_id;
                        UserService.role = data.role;

                        $scope.userIsLoggedIn =  UserService.isLogged;
                        $scope.username =  UserService.username;
                        $scope.userId = UserService.id;
                        $scope.role = UserService.role;
                        $scope.onlineuser = {
                            'online' : $scope.userIsLoggedIn,
                            'username' : $scope.username,
                            'user_id' : $scope.userId,
                            'role' : $scope.role
                        };
                        console.log( $scope.onlineuser);
                        UserService.addLoggedinUser($scope.onlineuser);
                        $location.path( "/menu" );


                    }
                });
        }

        $scope.logoutUser = function() {
            UserService.logout().success(function(data) {
                UserService.isLogged = false;
                UserService.username = '';
                $scope.username = UserService.username;
                $scope.userIsLoggedIn =  UserService.isLogged;
                UserService.removeLoggedoutUser();
                $location.path( "/site" );
            });
        }

        $scope.themecolor = themecolor;
        console.log(  $scope.themecolor.length);
        if($scope.themecolor.length === 0 ){
          // default
        }else{
            $scope.colorvalue = $scope.themecolor[0].value.toString();

            $('.col-xs-6 li a').css('background-color', $scope.colorvalue);


        }

        $scope.user = {};

        $scope.register = function() {
            console.log('register user');


            $http({
                url: '/FestivalGadget/Festival-backend/public/api/v1/users',
                method: 'POST',
                headers: { 'Content-Type': 'application/json' },
                data: $scope.user
            });
        }


    }]);
})();
