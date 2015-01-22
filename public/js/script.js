var app = angular.module('main', ['ngTable']).
        controller('DemoCtrl', function ($scope, $filter, ngTableParams, $http) {

            $http({method: 'GET', url: '/HotelierJson/public/hotel/listeHotelJson'}).
                    success(function (data) {
                        $scope.tableParams = new ngTableParams({
                            page: 1,
                            count: 5,
                            sorting: {
                                idHotel: 'asc'
                            }
                        }, {
                            total: data.length,
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