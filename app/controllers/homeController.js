
fraseApp.controller('homeController', ['$scope', '$http',
	function($scope, $http) { 

		$scope.data = {
			dummyResponse: ""
		};

		$scope.dummy = dummy;

		function dummy() {
			$http({
				method: 'GET',
				url: 'api/dummy/dummy'
			}).then(function(response) {
				$scope.data.dummyResponse = "Valor devuelto:" + response.data;
			}, function(err) {
				throw err;
			});
		}


		$scope.model = { frase: "" };
		$scope.insertFrase = insertFrase;

		function insertFrase() {
			$http({
				method: 'PUT',
				data: { frase: $scope.model.frase },
				url: 'api/frase/edit'
			}).then(function(response) {
				debugger;
				$scope.data.dummyResponse = "Valor devuelto:" + response.data;
			}, function(err) {
				throw err;
			});
		}

	}]);