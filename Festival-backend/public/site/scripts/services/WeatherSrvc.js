(function(){
    'use strict';

    var services = angular.module('ddsApp.services');

    services.factory('ddsApp.services.WeatherSrvc',
        ['$rootScope', '$http', '$q', '$window', 'localStorageService', function($rootScope, $http, $q, $window, localStorageService){
            var URLWEATHER = ' https://api.forecast.io/forecast/{0}/{1},{2}?callback=JSON_CALLBACK&units=ca';
            var URLFESTIVAL = 'http://localhost:8080/FestivalGadget/Festival-backend/public/api/v1/festivals?callback=JSON_CALLBACK';
            var URLLINEUPS = 'http://localhost:8080/FestivalGadget/Festival-backend/public/api/v1/lineups?callback=JSON_CALLBACK';
            var URLCOLORS = 'http://localhost:8080/FestivalGadget/Festival-backend/public/api/v1/colors?callback=JSON_CALLBACK';
            var URLFRIENDS = 'http://localhost:8080/FestivalGadget/Festival-backend/public/api/v1/friends?callback=JSON_CALLBACK';
            var URLUSERS = 'http://localhost:8080/FestivalGadget/Festival-backend/public/api/v1/users?callback=JSON_CALLBACK';
            var MSGWEATHERLOADERROR = 'Could not load the Weather call';
            var MSGFESTIVALERROR = 'Could not load festivals';
            var MSGLINEUPERROR = 'Could not load lineups';
            var MSGCOLORSERROR = 'Could not load colors';
            var MSGFRIENDSERROR = 'Could not load friends';
            var MSGUSERSERROR = 'Could not load users';
            var MSGGEOLOCATIONNOTSUPPORTED = 'GEO Location not supported';

            var _festivals = null,
                _lineups = null,
                _schedule = null,
                _chosenfestival = null,
                _colors = null,
                _friends = null,
                _users = null,
                _themecolor = null,
                _numberOfResourcesToLoadViaAJAX = 2,
                _numberOfResourcesLoadedViaAJAX = 0;

            var _configuration, _geoPosition;

            var that = this;//Hack for calling private functions and variables in the return statement

            this.loadFestivals = function(){
                var deferred = $q.defer();

                if(_festivals === null){
                    if(localStorageService.get('festivals') === null){
                        $http.jsonp(URLFESTIVAL).
                            success(function(data, status, headers, config){
                                _festivals = data;
                                console.log(data);
                                deferred.resolve(_festivals);
                            }).
                            error(function(data, status, headers, config){
                                deferred.reject(MSGWEATHERLOADERROR);
                                console.log(data + ' ' + status + ' ' + headers);
                            });

                    }else{
                        _festivals = localStorageService.get('festivals');
                        deferred.resolve(_festivals);
                    }
                }else{
                    deferred.resolve(_festivals);
                }

                return deferred.promise;//Always return a promise
            };

            this.loadLineups = function(){
                var deferred = $q.defer();

                if(_lineups === null){
                    if(localStorageService.get('lineups') === null){
                        $http.jsonp(URLLINEUPS).
                            success(function(data, status, headers, config){
                                _lineups = data;
                                console.log(data);
                                deferred.resolve(_lineups);
                            }).
                            error(function(data, status, headers, config){
                                deferred.reject(MSGLINEUPERROR);
                                console.log(data + ' ' + status + ' ' + headers);
                            });

                    }else{
                        _lineups = localStorageService.get('lineups');
                        deferred.resolve(_lineups);
                    }
                }else{
                    deferred.resolve(_lineups);
                }

                return deferred.promise;//Always return a promise
            };
            this.loadColors = function(){
                var deferred = $q.defer();

                if(_colors === null){
                    if(localStorageService.get('colors') === null){
                        $http.jsonp(URLCOLORS).
                            success(function(data, status, headers, config){
                                _colors = data;
                                console.log(data);
                                deferred.resolve(_colors);
                            }).
                            error(function(data, status, headers, config){
                                deferred.reject(MSGCOLORSERROR);
                                console.log(data + ' ' + status + ' ' + headers);
                            });

                    }else{
                        _colors = localStorageService.get('colors');
                        deferred.resolve(_colors);
                    }
                }else{
                    deferred.resolve(_colors);
                }

                return deferred.promise;//Always return a promise
            };
            this.loadFriends = function(){
                var deferred = $q.defer();

                if(_friends === null){
                    if(localStorageService.get('friends') === null){
                        $http.jsonp(URLFRIENDS).
                            success(function(data, status, headers, config){
                                _friends = data;
                                console.log(data);
                                deferred.resolve(_friends);
                            }).
                            error(function(data, status, headers, config){
                                deferred.reject(MSGFRIENDSERROR);
                                console.log(data + ' ' + status + ' ' + headers);
                            });

                    }else{
                        _friends = localStorageService.get('friends');
                        deferred.resolve(_friends);
                    }
                }else{
                    deferred.resolve(_friends);
                }

                return deferred.promise;//Always return a promise
            };
            this.loadUsers = function(){
                var deferred = $q.defer();

                if(_users === null){
                    if(localStorageService.get('users') === null){
                        $http.jsonp(URLUSERS).
                            success(function(data, status, headers, config){
                                _users = data;
                                console.log(data);
                                deferred.resolve(_users);
                            }).
                            error(function(data, status, headers, config){
                                deferred.reject(MSGUSERSERROR);
                                console.log(data + ' ' + status + ' ' + headers);
                            });

                    }else{
                        _users = localStorageService.get('users');
                        deferred.resolve(_users);
                    }
                }else{
                    deferred.resolve(_users);
                }

                return deferred.promise;//Always return a promise
            };
            this.geoLocation = function(){
                if(Modernizr.geolocation){
                    var options = {maximumAge:60000, timeout:10000,enableHighAccuracy:true};

                    $window.navigator.geolocation.getCurrentPosition(this.geoLocationSuccess, this.geoLocationError,options);
                }else{
                    this.geoLocationFallback();
                }
            };

            this.geoLocationSuccess = function(position){
                _geoPosition = position;
                $rootScope.$broadcast("GEOSUCCESS");
            };

            this.geoLocationError = function(error){
                switch(error){
                    //Timeout
                    case 3:
                        geoLocation();
                        break;
                    //POSITION UNAVAILABLE
                    case 2:
                        geoLocation();
                        break;
                    //PERMISSION DENIED --> FALLBACK
                    case 1:
                        geoLocationFallback();
                        break;
                    default:
                        geoLocation();
                        break;
                }
            };

            this.geoLocationFallback = function(){
                $rootScope.$broadcast("GEOERROR");

            };

            this.loadDataChoosenFestival = function(){
                if(_chosenfestival === null){
                    if(localStorageService.get('chosenfestival') === null){
                        _chosenfestival = [];
                    }else{
                        _chosenfestival = localStorageService.get('chosenfestival');
                    }
                }
            };
            this.loadDataChoosenLineups = function(){
                if(_schedule === null){
                    if(localStorageService.get('schedule') === null){
                        _schedule = [];
                    }else{
                        _schedule = localStorageService.get('schedule');
                    }
                }
            };
            this.loadTheme = function(){
                if(_themecolor === null){
                    if(localStorageService.get('themecolor') === null){
                        _themecolor = [];
                    }else{
                        _themecolor = localStorageService.get('themecolor');
                    }
                }
            };


            return{
                loadConfiguration:function(){
                    var deferred = $q.defer();

                    that.loadDataChoosenFestival();
                    that.loadDataChoosenLineups();
                    that.loadTheme();

                    that.loadFestivals().then(
                        function(data){
                            _numberOfResourcesLoadedViaAJAX++;
                            if(_numberOfResourcesLoadedViaAJAX === _numberOfResourcesToLoadViaAJAX){
                                deferred.resolve(true);
                            }
                        },
                        function(error){
                            deferred.reject(MSGFESTIVALERROR);
                        }
                    );
                    that.loadLineups().then(
                        function(data){
                            _numberOfResourcesLoadedViaAJAX++;
                            if(_numberOfResourcesLoadedViaAJAX === _numberOfResourcesToLoadViaAJAX){
                                deferred.resolve(true);
                            }
                        },
                        function(error){
                            deferred.reject(MSGLINEUPERROR);
                        }
                    );
                    that.loadColors().then(
                        function(data){
                            _numberOfResourcesLoadedViaAJAX++;
                            if(_numberOfResourcesLoadedViaAJAX === _numberOfResourcesToLoadViaAJAX){
                                deferred.resolve(true);
                            }
                        },
                        function(error){
                            deferred.reject(MSGCOLORSERROR);
                        }
                    );
                    that.loadUsers().then(
                        function(data){
                            _numberOfResourcesLoadedViaAJAX++;
                            if(_numberOfResourcesLoadedViaAJAX === _numberOfResourcesToLoadViaAJAX){
                                deferred.resolve(true);
                            }
                        },
                        function(error){
                            deferred.reject(MSGCOLORSERROR);
                        }
                    );
                    that.loadFriends().then(
                            function(data){
                                _numberOfResourcesLoadedViaAJAX++;
                                if(_numberOfResourcesLoadedViaAJAX === _numberOfResourcesToLoadViaAJAX){
                                    deferred.resolve(true);
                                }
                            },
                        function(error){
                            deferred.reject(MSGFRIENDSERROR);
                        }
                    );

                    return deferred.promise;//Always return a promise
                },
                loadWeather : function(api, lat, long){
                    var deferred = $q.defer();

                    var url = URLWEATHER.format(api, lat, long);

                    $http.jsonp(url).
                        success(function(data, status, headers, config){
                            console.log(data);
                            deferred.resolve(data);
                        }).
                        error(function(data, status, headers, config){
                            deferred.reject(MSGWEATHERLOADERROR);
                            console.log(data + ' ' + status + ' ' + headers);
                        });

                    return deferred.promise;//Always return a promise
                },
                getDataFestivals : function(){
                    var deferred = $q.defer();



                    if(_festivals === null){
                        deferred.reject(MSGFESTIVALERROR);
                    }else{
                        deferred.resolve(_festivals);
                    }

                    return deferred.promise;//Always return a promise
                },
                getDataLineups : function(){
                    var deferred = $q.defer();



                    if(_lineups === null){
                        deferred.reject(MSGLINEUPERROR);
                    }else{
                        deferred.resolve(_lineups);
                    }

                    return deferred.promise;//Always return a promise
                },
                getDataColors : function(){
                    var deferred = $q.defer();



                    if(_colors === null){
                        deferred.reject(MSGCOLORSERROR);
                    }else{
                        deferred.resolve(_colors);
                    }

                    return deferred.promise;//Always return a promise
                },
                getDataFriends : function(){
                    var deferred = $q.defer();



                    if(_friends === null){
                        deferred.reject(MSGFRIENDSERROR);
                    }else{
                        deferred.resolve(_friends);
                    }

                    return deferred.promise;//Always return a promise
                },
                getDataUsers : function(){
                    var deferred = $q.defer();



                    if(_users === null){
                        deferred.reject(MSGUSERSERROR);
                    }else{
                        deferred.resolve(_users);
                    }

                    return deferred.promise;//Always return a promise
                },
                getChosenFestival:function(){
                    var deferred = $q.defer();

                    var choice = [];
                    if(_chosenfestival !== null){
                        _.each(_chosenfestival, function(id){
                            var fest = _.find(_festivals, function(festival){
                                return festival.id === id;
                            });
                            if(typeof fest !== 'undefined')
                                choice.push(fest);
                        });
                        deferred.resolve(choice);
                    }else{
                        deferred.reject(MSGFESTIVALERROR);
                    }
                    return deferred.promise;
                },
                getChosenLineup:function(){
                    var deferred = $q.defer();

                    var choice = [];
                    if(_schedule !== null){
                        _.each(_schedule, function(id){
                            var schedule = _.find(_lineups, function(lineup){
                                return lineup.id === id;
                            });
                            if(typeof schedule !== 'undefined')
                                choice.push(schedule);
                        });
                        deferred.resolve(choice);
                    }else{
                        deferred.reject(MSGLINEUPERROR);
                    }
                    return deferred.promise;
                },
                isFestivalAlreadyChosen:function(festivalId){
                    if(localStorageService.get('chosenfestival') === null)
                        return false;

                    var chosen = localStorageService.get('chosenfestival');

                    var festival = _.find(chosen, function(sId){
                        return sId === festivalId;
                    });

                    if(typeof festival === 'undefined')
                        return false;

                    return true;
                },
                isLineupAlreadyInSchedule:function(lineupId){
                    if(localStorageService.get('schedule') === null)
                        return false;

                    var chosen = localStorageService.get('schedule');

                    var lineup = _.find(chosen, function(sId){
                        return sId === lineupId;
                    });

                    if(typeof lineup === 'undefined')
                        return false;

                    return true;
                },
                isLineupNotInSchedule:function(lineupId){
                    if(localStorageService.get('schedule') === null)
                        return true;

                    var chosen = localStorageService.get('schedule');

                    var lineup = _.find(chosen, function(sId){
                        return sId === lineupId;
                    });

                    if(typeof lineup === 'undefined')
                        return true;

                    return false;
                },
                addFestivalToChoice:function(festivalId){
                    if(!this.isFestivalAlreadyChosen(festivalId)){
                        _chosenfestival = localStorageService.get('chosenfestival');

                        if(_chosenfestival === null){
                            _chosenfestival = [];
                        }

                        _chosenfestival = [festivalId];
                        localStorageService.set('chosenfestival', _chosenfestival);
                    }
                },
                removeFestivalFromChoice:function(festivalId){
                    if(this.isFestivalAlreadyChosen(festivalId)){
                        _chosenfestival = localStorageService.get('chosenfestival');

                        if(_chosenfestival !== null){
                            _chosenfestival = _.pull(_chosenfestival, festivalId);
                            localStorageService.set('chosenfestival', _chosenfestival);
                        }
                    }
                },
                addLineupToSchedule:function(lineupId){
                    if(!this.isLineupAlreadyInSchedule(lineupId)){
                        _schedule = localStorageService.get('schedule');

                        if(_schedule === null){
                            _schedule = [];
                        }

                        _schedule.push(lineupId);
                        localStorageService.set('schedule', _schedule);
                    }
                },
                removeLineupFromSchedule:function(lineupId){
                    console.log('klik');
                    if(this.isLineupAlreadyInSchedule(lineupId)){
                        _schedule = localStorageService.get('schedule');
                        console.log('klik');
                        if(_schedule !== null){
                            _schedule = _.pull(_schedule, lineupId);
                            localStorageService.set('schedule', _schedule);
                        }
                    }
                },
                getThemeColor:function(){
                    var deferred = $q.defer();

                    var choice = [];

                    if(_themecolor !== null){
                        _.each(_themecolor, function(id){
                            var theme = _.find(_colors, function(color){
                                return color.id === id;
                            });
                            if(typeof theme !== 'undefined')
                                choice.push(theme);
                        });
                        deferred.resolve(choice);
                    }else{
                        deferred.reject(MSGCOLORSERROR);
                    }
                    return deferred.promise;
                },
                isThemeAlreadyChosen:function(colorId){
                    if(localStorageService.get('themecolor') === null)
                        return false;

                    var chosen = localStorageService.get('themecolor');

                    var color = _.find(chosen, function(sId){
                        return sId === colorId;
                    });

                    if(typeof color === 'undefined')
                        return false;

                    return true;
                },
                addThemeColor:function(colorId){
                    if(!this.isThemeAlreadyChosen(colorId)){
                        _themecolor = localStorageService.get('themecolor');

                        if(_themecolor === null){
                            _themecolor = [];
                        }

                        _themecolor = [colorId];
                        localStorageService.set('themecolor', _themecolor);
                    }
                },
                isColorInTheme:function(colorId){
                    if(localStorageService.get('themecolor') === null)
                        return false;

                    var chosen = localStorageService.get('themecolor');

                    var color = _.find(chosen, function(sId){
                        return sId === colorId;
                    });

                    if(typeof color === 'undefined')
                        return false;

                    return true;
                },
                isColorNotTheme:function(colorId){
                    if(localStorageService.get('themecolor') === null)
                        return true;

                    var chosen = localStorageService.get('themecolor');

                    var color = _.find(chosen, function(sId){
                        return sId === colorId;
                    });

                    if(typeof color === 'undefined')
                        return true;

                    return false;
                },
                removeThemeColor:function(colorId){
                    console.log('klik');
                    if(this.isLineupAlreadyInSchedule(colorId)){
                        _themecolor = localStorageService.get('schedule');
                        console.log('klik');
                        if(_themecolor !== null){
                            _themecolor = _.pull(_themecolor, colorId);
                            localStorageService.set('schedule', _themecolor);
                        }
                    }
                },
                getGEOLocation : function(){
                    var deferred = $q.defer();

                    $rootScope.$on('GEOSUCCESS', function(ev){
                        deferred.resolve(_geoPosition);
                    });

                    $rootScope.$on('GEOERROR', function(ev){
                        deferred.reject(MSGGEOLOCATIONNOTSUPPORTED);
                    });

                    that.geoLocation();

                    return deferred.promise;//Always return a promise
                }
            };
        }]);

    services.factory('ddsApp.services.UserService',['$rootScope', '$http','$q','localStorageService', function($rootScope, $http, $q, localStorageService ){

        var _loggedinuser = null,
            _numberOfResourcesToLoadViaAJAX = 2,
            _numberOfResourcesLoadedViaAJAX = 0;


        this.loadDataLoggedInUser = function(){
            if(_loggedinuser === null){
                if(localStorageService.get('onlineuser') === null){
                    _loggedinuser = [];
                }else{
                    _loggedinuser = localStorageService.get('onlineuser');
                }
            }
        };

        return {
            load: function() {
                return $http.get('/api/v1/auth');
            },
            logout: function() {
                return $http.get('/FestivalGadget/Festival-backend/public/api/v1/logoutuser');
            },
            login: function(inputs) {
                return $http.post('/FestivalGadget/Festival-backend/public/api/v1/loginuser', inputs);
            },
            sendmessage: function(inputs) {
                return $http.post('/FestivalGadget/Festival-backend/public/api/v1/conversations', inputs);
            },
            getconversation: function(inputs) {
                return $http.get('/FestivalGadget/Festival-backend/public/api/v1/conversations', inputs);
            },
            addfriend: function(inputs) {
                return $http.post('/FestivalGadget/Festival-backend/public/api/v1/friends', inputs);
            },
            updatefriend: function(inputs) {
                return $http.put('/FestivalGadget/Festival-backend/public/api/v1/friends', inputs);
            },
            register: function(inputs) {
                return $http.post('/api/v1/auth/register', inputs);
            },
            locations: function() {
                return $http.get('/api/v1/auth/locations');
            },
            check: function() {
                return $http.get('/api/v1/auth/check');
            },

            isUserAlreadyOnline:function(){
                if(localStorageService.get('onlineuser') === null)
                    return false;
//
//                var online = localStorageService.get('onlineuser');
//
//                var user = _.find(online, function(sId){
//                    return sId === username;
//                });

//                if(typeof user === 'undefined')
  //                  return false;

                return true;
            },
            getOnlineUser:function(){
                var onlineuser = localStorageService.get('onlineuser');

                return onlineuser;
            },
            removeLoggedoutUser:function(onlineuser){

                        localStorageService.remove('onlineuser', _loggedinuser);

            },
            addLoggedinUser:function(onlineuser){
                console.log('hallo');
                if(!this.isUserAlreadyOnline(onlineuser)){
                    _loggedinuser = localStorageService.get('onlineuser');

                    if(_loggedinuser === null){
                        _loggedinuser = [];
                    }

                    _loggedinuser = [onlineuser];
                    localStorageService.set('onlineuser', _loggedinuser);
                }
            }

        }


        var sdo = {
            isLogged: false,
            username: '',
            role: 'guest',
            id: 0
        };
        return sdo;





    }]);
})();