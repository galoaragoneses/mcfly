fraseApp.factory('ajaxService', ['$q','$http',
	function($q, $http) {

		var self = {};

		self.dummy = function() {
			$http({
			  method: 'GET',
			  url: '/api/dummy'
			});
		}

		return self;

}])