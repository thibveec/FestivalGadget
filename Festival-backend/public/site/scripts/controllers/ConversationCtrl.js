(function(){
    'use strict';

    var controllers = angular.module('ddsApp.controllers');

    controllers.controller('ddsApp.controllers.ConversationCtrl',['$scope', 'ddsApp.services.UserService', 'friends', 'users','$routeParams', function($scope, UserService, friends, users, $routeParams){

        // Get Online user
        $scope.username = UserService.username;
        $scope.userIsLoggedIn =  UserService.isLogged;
        $scope.userId = UserService.id;
        $scope.role = UserService.role;

        //Get Clicked User/Friend
        var friendId = $routeParams.friendId;
        $scope.user = _.find(users, {'id':friendId});




        //Check if you have friends or pending friends
        $scope.friends = friends;
        $scope.users = users;
        var myfriends = [];
        var notmyfriends = [];
        var friendstatus = [];

        $scope.myfriends = _.filter(friends, {'friend1_id':$scope.userId});
        console.log( $scope.myfriends);

        if( $scope.myfriends[0] !== undefined){
            angular.forEach( $scope.myfriends, function(friend, key){


                $scope.userfriend = _.filter(users, {'id':friend.friend2_id});

                if( $scope.userfriend[0] !== undefined){

                    $scope.userfriend.push(friend);
                    myfriends.push($scope.userfriend );
                    friendstatus.push(friend);
                }else{
                    //
                }

            });

            $scope.hasFriends = true;
        }else{

            $scope.hasFriends = false;
        }

        //GET CONVERSATION
        $scope.myconversation = function(){
            UserService.getconversation({


            }).success(function(data) {
                    if (data.error) {
                        console.log(data.error);

                    } else {
                        console.log("Your conversation loaded!");

                    };

                });

        }


        // ADD MESSAGE
        $scope.sendMessage = function(friendId) {
            UserService.sendmessage({
                currentuser: $scope.userId,
                friend:friendId,
                text: $scope.main.credentials.text
            }).success(function(data) {
                    if (data.error) {
                        console.log(data.error);

                    } else {
                        console.log("You send a message!");

                    };

                });

        }



        $scope.isList = true;
        $scope.changeIsList = function(isList){
            $scope.isList = isList;
            $scope.lflrefresh = !isList;
        };
    }]);
})();
