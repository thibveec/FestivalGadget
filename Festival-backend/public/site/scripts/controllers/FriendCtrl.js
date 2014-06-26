(function(){
    'use strict';

    var controllers = angular.module('ddsApp.controllers');

    controllers.controller('ddsApp.controllers.FriendCtrl',['$scope', 'ddsApp.services.UserService', 'friends', 'users','$routeParams', function($scope, UserService, friends, users, $routeParams){

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

        //GET STATUS OF USER/FRIEND
        $scope.statususer = _.find(friendstatus, {'friend2_id':friendId});


        if($scope.statususer.status === 'Accepted'){
            $scope.showpendingtools = false;
            $scope.shownotfriendtools = false;
            $scope.showfriendtools = true;
        }
        if($scope.statususer.status === 'Pending'){
            $scope.showfriendtools = false;
            $scope.shownotfriendtools = false;
            $scope.showpendingtools = true;

        }
        if($scope.statususer === undefined){
            $scope.showfriendtools = false;
            $scope.showpendingtools = false;
            $scope.shownotfriendtools = true;
        }



        // ADD FRIEND
        $scope.addFriend = function(friendId) {
            UserService.addfriend({
                currentuser: $scope.userId,
                askeduser:friendId,
                status: 'Pending'
            }).success(function(data) {
                    if (data.error) {
                        console.log(data.error);

                    } else {
                        console.log("You added a friend!");

                    };

                });

        }
        // ACCEPT FRIEND
        $scope.acceptFriend = function(friendId) {
            UserService.addfriend({
                currentuser: $scope.userId,
                askeduser:friendId,
                status: 'Accepted'
            }).success(function(data) {
                    if (data.error) {
                        console.log(data.error);

                    } else {
                        console.log("You accepted a friend!");

                    };

                });
            UserService.updatefriend({
                fromuser: friendId,
                touser:$scope.userId,
                status: 'Accepted'
            }).success(function(data) {
                    if (data.error) {
                        console.log(data.error);

                    } else {
                        console.log("You accepted a friend!");

                    };

                });

        }
        // UPDATE FRIEND FROM REQUESTUSER

        $scope.declineUser = function(friendId) {
            UserService.addfriend({
                currentuser: $scope.userId,
                askeduser:friendId,
                status: 'Declined'
            }).success(function(data) {
                    if (data.error) {
                        console.log(data.error);

                    } else {
                        console.log("You declined a user!");

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
