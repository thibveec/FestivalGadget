'use strict';

String.prototype.format = function() {
    var formatted = this;
    for (var i = 0; i < arguments.length; i++) {
        var regexp = new RegExp('\\{'+i+'\\}', 'gi');
        formatted = formatted.replace(regexp, arguments[i]);
    }
    return formatted;
};

angular.module('LocalStorageModule').value('prefix', 'dds_scholen');

angular.module('ddsApp.controllers', []);
angular.module('ddsApp.services', []);
angular.module('ddsApp.directives', []);
angular.module('ddsApp.filters', []);
angular.module('ddsApp.directives', []);

var app = angular.module('ddsApp', [
        'ngRoute',
        'ngResource',
        'ddsApp.controllers',
        'ddsApp.services',
        'ddsApp.directives',
        'ddsApp.filters',
        'ddsApp.directives',
        'LocalStorageModule'
    ])
    .config(['$routeProvider','$locationProvider', '$httpProvider', function($routeProvider, $locationProvider, $httpProvider){
        $httpProvider.defaults.useXDomain = true;//Cross Domain Calls --> Ok Ready
        delete $httpProvider.defaults.headers.common['X-Requested-With'];



        $routeProvider.when('/', {
            templateUrl:'views/main.html',
            controller:'ddsApp.controllers.MainCtrl',
            resolve: {
                themecolor:appCtrl.getTheme
            }

        });

        $routeProvider.when('/menu', {
            templateUrl:'views/menu.html',
            controller:'ddsApp.controllers.MainCtrl',
            resolve: {
                themecolor:appCtrl.getTheme
            }

        });


        $routeProvider.when('/friends', {
            templateUrl:'views/friends.html',
            controller:'ddsApp.controllers.FriendsCtrl',
            resolve: {
                friends : appCtrl.getDataFriends,
                users : appCtrl.getDataUsers

            }
        });

        $routeProvider.when('/friends/:friendId', {
            templateUrl:'views/friend.html',
            controller:'ddsApp.controllers.FriendCtrl',
            resolve: {
                friends : appCtrl.getDataFriends,
                users : appCtrl.getDataUsers

            }
        });
        $routeProvider.when('/friends/conversation/:friendId', {
            templateUrl:'views/conversation.html',
            controller:'ddsApp.controllers.ConversationCtrl',
            resolve: {
                friends : appCtrl.getDataFriends,
                users : appCtrl.getDataUsers

            }
        });

        $routeProvider.when('/addfriends', {
            templateUrl:'views/addfriends.html',
            controller:'ddsApp.controllers.FriendsCtrl',
            resolve: {
                friends : appCtrl.getDataFriends,
                users : appCtrl.getDataUsers
            }
        });
        $routeProvider.when('/request', {
            templateUrl:'views/request.html',
            controller:'ddsApp.controllers.FriendsCtrl',
            resolve: {
                friends : appCtrl.getDataFriends,
                users : appCtrl.getDataUsers
            }
        });



        $routeProvider.when('/searchfriends', {templateUrl:'views/searchfriends.html', controller:'ddsApp.controllers.SearchFriendsCtrl'});

        $routeProvider.when('/customize', {
            templateUrl:'views/customize.html',
            controller:'ddsApp.controllers.CustomizeCtrl',
            resolve: {
                colors: appCtrl.getDataColors

            }

        });

        $routeProvider.when('/festivals', {
            templateUrl:'views/festivals.html',
            controller:'ddsApp.controllers.FestivalsCtrl',
            resolve: {
                festivals: appCtrl.getDataFestivals,
                themecolor: appCtrl.getTheme

            }

        });

        $routeProvider.when('/festivals/:festivalId', {
            templateUrl:'views/festival.html',
            controller:'ddsApp.controllers.FestivalCtrl',
            resolve: {
                festivals: appCtrl.getDataFestivals,
                themecolor: appCtrl.getTheme
            }

        });

        $routeProvider.when('/lineups', {
            templateUrl:'views/lineups.html',
            controller:'ddsApp.controllers.LineupsCtrl',
            resolve: {
                lineups: appCtrl.getDataLineups,
                festivalchoice: appCtrl.getChosenFestivals,
                themecolor: appCtrl.getTheme

            }

        });
        $routeProvider.when('/agenda', {
            templateUrl:'views/agenda.html',
            controller:'ddsApp.controllers.AgendaCtrl',
            resolve: {
               schedule: appCtrl.getChosenLineupToSchedule,
                themecolor: appCtrl.getTheme
            }

        });

        $routeProvider.when('/weather', {
            templateUrl:'views/weather.html',
            controller:'ddsApp.controllers.WeatherCtrl',
            resolve: {
                daily: appCtrl.loadLocalWeather,
                themecolor: appCtrl.getTheme

            }

        });

        $routeProvider.when('/site', {
            templateUrl:'../site/views/app.html',
            controller:'AppCtrl',
            resolve: {
                appInitialized: appCtrl.loadConfiguration

            }

        });

        $routeProvider.otherwise({redirectTo: '/'});



    }])
    .run(['$rootScope', '$timeout', '$location', 'ddsApp.services.WeatherSrvc','ddsApp.services.UserService', function($rootScope, $timeout, $location, WeatherSrvc, UserService){
        $rootScope.appInitialized = false;

        $rootScope.$on('$routeChangeStart', function(event, next, current){
            if(!$rootScope.appInitialized){
                $location.path('/site');
            }else if($rootScope.appInitialized && $location.path() === '/site'){
                $location.path('/');
            }

        });
    }]);

/*
 AppCtrl
 =======
 Controller for the App
 ----------------------
 * Load Data Via the services
 * Return the promises
 * Resolve for each route
 */
var appCtrl = app.controller('AppCtrl', ['$scope', '$location', 'appInitialized', function($scope, $location, appInitialized){
    if(appInitialized){
        $location.path('/');
    }



}]);


appCtrl.loadConfiguration = ['$rootScope', '$q', '$timeout', 'ddsApp.services.WeatherSrvc', function($rootScope, $q, $timeout, WeatherSrvc){
    var deferred = $q.defer();

    WeatherSrvc.loadConfiguration().then(
        function(data){
            $timeout(function(){
                $rootScope.appInitialized = true;
                deferred.resolve(data);
            },2000);
        },
        function(error){
            deferred.reject(error);
        }
    );

    return deferred.promise;
}];
appCtrl.loadLocalWeather = ['$rootScope', '$q', 'ddsApp.services.WeatherSrvc', function($rootScope, $q, WeatherSrvc){
    var deferred = $q.defer();

    WeatherSrvc.getGEOLocation().then(
        function(data){
            console.log(data);
            WeatherSrvc.loadWeather('f37f67df3e28565b40944a1710309435',data.coords.latitude, data.coords.longitude).then(
                function(data){
                    deferred.resolve(data);
                },
                function(error){
                    deferred.reject(error);
                }
            );
        },
        function(error){
            console.log(error);
            deferred.reject(error);

        }
    );

    return deferred.promise;
}];
appCtrl.getDataFestivals = ['$rootScope', '$q', 'ddsApp.services.WeatherSrvc', function($rootScope, $q, WeatherSrvc){
    var deferred = $q.defer();

    WeatherSrvc.getDataFestivals().then(
        function(data){

            deferred.resolve(data);
        },
        function(error){
            console.log(error);
            deferred.reject(error);
        }
    );

    return deferred.promise;
}];

appCtrl.getDataColors = ['$rootScope', '$q', 'ddsApp.services.WeatherSrvc', function($rootScope, $q, WeatherSrvc){
    var deferred = $q.defer();

    WeatherSrvc.getDataColors().then(
        function(data){

            deferred.resolve(data);
        },
        function(error){
            console.log(error);
            deferred.reject(error);
        }
    );

    return deferred.promise;
}];
appCtrl.getDataFriends = ['$rootScope', '$q', 'ddsApp.services.WeatherSrvc', function($rootScope, $q, WeatherSrvc){
    var deferred = $q.defer();

    WeatherSrvc.getDataFriends().then(
        function(data){

            deferred.resolve(data);
        },
        function(error){
            console.log(error);
            deferred.reject(error);
        }
    );

    return deferred.promise;
}];
appCtrl.getDataUsers = ['$rootScope', '$q', 'ddsApp.services.WeatherSrvc', function($rootScope, $q, WeatherSrvc){
    var deferred = $q.defer();

    WeatherSrvc.getDataUsers().then(
        function(data){

            deferred.resolve(data);
        },
        function(error){
            console.log(error);
            deferred.reject(error);
        }
    );

    return deferred.promise;
}];
appCtrl.getDataLineups = ['$rootScope', '$q', 'ddsApp.services.WeatherSrvc', function($rootScope, $q, WeatherSrvc){
    var deferred = $q.defer();

    WeatherSrvc.getDataLineups().then(
        function(data){

            deferred.resolve(data);
        },
        function(error){
            console.log(error);
            deferred.reject(error);
        }
    );

    return deferred.promise;
}];

appCtrl.getChosenFestivals = ['$q', 'ddsApp.services.WeatherSrvc', function($q, WeatherSrvc){
    var deferred = $q.defer();

    WeatherSrvc.getChosenFestival().then(
        function(data){
            deferred.resolve(data);
        },
        function(error){
            deferred.reject(error);
        }
    );

    return deferred.promise;
}];
appCtrl.getChosenLineupToSchedule = ['$q', 'ddsApp.services.WeatherSrvc', function($q, WeatherSrvc){
    var deferred = $q.defer();

    WeatherSrvc.getChosenLineup().then(
        function(data){
            deferred.resolve(data);
        },
        function(error){
            deferred.reject(error);
        }
    );

    return deferred.promise;
}];
appCtrl.getTheme = ['$q', 'ddsApp.services.WeatherSrvc', function($q, WeatherSrvc){
    var deferred = $q.defer();

    WeatherSrvc.getThemeColor().then(
        function(data){
            deferred.resolve(data);
        },
        function(error){
            deferred.reject(error);
        }
    );

    return deferred.promise;
}];