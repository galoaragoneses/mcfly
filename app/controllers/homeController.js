
fraseApp.controller('homeController', ['$scope', '$http',
	function($scope, $http) { 

		$scope.data = {};

		$scope.data.dummyResponse = "";
		$scope.dummy = dummy;

		function dummy() {
			$http({
				method: 'GET',
				url: 'api/dummy'
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
				url: 'api/frase'
			}).then(function(response) {
				$scope.data.dummyResponse = "Valor devuelto:" + response.data;
			}, function(err) {
				throw err;
			});
		}

		$scope.data.fraseList = [];
		$scope.getAll = getAll;

		function getAll() {
			$http({
				method: 'GET',
				url: 'api/frase'
			}).then(function(response) {
				$scope.data.fraseList = response.data.frases;
			}, function(err) {
				throw err;
			});
		}

		$scope.data.fraseObj = undefined;
		$scope.fraseFormated = function(fraseObj) {
			if (fraseObj) {
				return (fraseObj.favorita ? "FAVORITA:" : "") + fraseObj.id + " - " + fraseObj.frase;
			}
		}

		$scope.getById = getById;

		function getById(id) {
			var aux_url = 'api/frase/' + id;
			//console.log(aux_url);

			$http({
				method: 'GET',
				url: aux_url
			}).then(function(response) {
				$scope.data.fraseObj = response.data;
			}, function(err) {
				throw err;
			});
		}

		$scope.markAsFavorita = markAsFavorita;

		function markAsFavorita(id) {
			var aux_url = 'api/frase/' + id + '/favorita';

			$http({
				method: 'GET',
				url: aux_url
			}).then(function(response) {
				$scope.getAll();
			}, function(err) {
				throw err;
			});
		}

	}]);