var app = angular.module('solditemtables', ['ui.bootstrap']);
app.filter('beginning_data', function() {
    return function(input, begin) {
        if (input) {
            begin = +begin;
            return input.slice(begin);
        }
        return [];
    }
});
app.controller('controller', function($scope, $http, $timeout) {
    $http.get('solditem_report_table_s.php').success(function(orders) {
        $scope.file = orders;
        $scope.current_grid = 1;
        $scope.data_limit = 10;
        $scope.filter_data = $scope.file.length;
        $scope.entire_user = $scope.file.length;
    });
    $scope.page_position = function(page_number) {
        $scope.current_grid = page_number;
    };
    $scope.filter = function() {
        $timeout(function() {
            $scope.filter_data = $scope.searched.length;
        }, 20);
    };
    $scope.sort_with = function(base) {
        $scope.base = base;
        $scope.reverse = !$scope.reverse;
    };
});