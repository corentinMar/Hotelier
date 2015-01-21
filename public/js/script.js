var app = angular.module('main', ['ngTable']).
        controller('DemoCtrl', function ($scope, ngTableParams, $http) {

            $http({method: 'GET', url: 'http://localhost/HotelierJson/public/hotel/listeHotelJson'}).
                    success(function (data) {
                        $scope.tableParams = new ngTableParams({
                            page: 1, // show first page
                            count: 5 // count per page
                        }, {
                            total: data.length, // length of data
                            getData: function ($defer, params) {
                                $defer.resolve(data.slice((params.page() - 1) * params.count(), params.page() * params.count()));
                            }
                        });
                    }).
                    error(function (data) {
                    });
        });

//Arnaud Code Edit