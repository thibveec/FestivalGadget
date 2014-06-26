(function(){
    'use strict';

    var controllers = angular.module('ddsApp.controllers');

    controllers.controller('ddsApp.controllers.FriendsCtrl',['$scope', 'ddsApp.services.UserService', 'friends', 'users','$routeParams', function($scope, UserService, friends, users, $routeParams){


        // Get Online user
        $scope.username = UserService.username;
        $scope.userIsLoggedIn =  UserService.isLogged;
        $scope.userId = UserService.id;
        $scope.role = UserService.role;



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
            // GET USERS WHO ARE NOT FRIEND

            angular.forEach(  myfriends, function(alreadyfriend, key){
                angular.forEach(  users, function(searchuser, key){
                    if(alreadyfriend[1].friend2_id === searchuser.id){

                    }else{
                        $scope.checkuser = _.filter( $scope.myfriends, {'friend2_id':searchuser.id})
                        if( $scope.checkuser[0] === undefined && searchuser.id !==  $scope.userId ){
                            notmyfriends.push(searchuser);
                        }
                    }
                });
            });
            console.log(notmyfriends);
            $scope.notfriends = notmyfriends;
            $scope.hasFriends = true;
        }else{
            $scope.notfriends = users;
            $scope.hasFriends = false;
        }





      // SEPERATE FRIENDS BY STATUS

        var acceptedfriends = [];
        var pendingfriends = [];
        angular.forEach(  myfriends, function(alreadyfriend, key){

            if(alreadyfriend[1].status === 'Pending'){
                pendingfriends.push(alreadyfriend)
            }
            if(alreadyfriend[1].status === 'Accepted'){
                acceptedfriends.push(alreadyfriend)
            }
        });

        $scope.usersfriends = acceptedfriends;
        console.log($scope.usersfriends);
        $scope.pendingfriends = pendingfriends;







        //REQUESTS
        var requests = [];
        $scope.myrequests = _.filter(friends, {'friend2_id':$scope.userId});
        if( $scope.myrequests[0] !== undefined){
            angular.forEach( $scope.myrequests, function(request, key){
                $scope.fromuser = _.filter(users, {'id':request.friend1_id});
                console.log(request.status);
                if( $scope.fromuser[0] !== undefined && request.status === 'Pending'){
                    $scope.fromuser.push(request);

                    requests.push($scope.fromuser );
                }else{
                    //error
                }
            });

        }
        $scope.friendrequest = requests;
        console.log( $scope.friendrequest);


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
