var app = angular.module('main', ['ngTable']).
        controller('DemoCtrl', function ($scope, $filter, ngTableParams, $http) {

            $http({method: 'GET', url: '/HotelierJson/public/hotel/listeHotelJson'}).
                    success(function (data) {
                        $scope.tableParams = new ngTableParams({
                            page: 1, // show first page
                            count: 5, // count per page
                            sorting: {
                                idHotel: 'asc'     // initial sorting
                            }
                        }, {
                            total: data.length, // length of data
                            getData: function ($defer, params) {
                                var orderedData = params.sorting() ?
                                        $filter('orderBy')(data, params.orderBy()) :
                                        data;

                                $defer.resolve(orderedData.slice((params.page() - 1) * params.count(), params.page() * params.count()));
                            }
                        });
                    }).
                    error(function (data) {
                    });
        });