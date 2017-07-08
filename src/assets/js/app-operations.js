app = angular.module('simpleforum', []);

app.config(function($httpProvider) {
      $httpProvider.defaults.useXDomain = true;
      delete $httpProvider.defaults.headers.common['X-Requested-With'];
});


app.controller('commentsController', ['$scope','$http', function ($scope,$http) {
    
    $scope.likeUnlikeComment = function(item) {
        commentID = $(item).val(); //item is <button>
        if (commentID == ""){ // if item is <i>
            item = $(item).parent();
            commentID = $(item).val();
        }
    
        $http.post("/ozgurince/simpleforum/auth-user").then(function(data) {
            auth_user = data.data;
            
            var isLiked = $(item).hasClass('btn-primary');

            if (!isLiked)
                url = "/ozgurince/simpleforum/api/like";
            else 
                url = "/ozgurince/simpleforum/api/unlike";
            data = {
                    'comment_id' : commentID, 
                    'api_token' : auth_user.api_token
                };

            $http.post(url, data).then(function(data){
                $(item).toggleClass('btn-primary');
                $(item).find('span').text(" " + data.data.comment_likes_number)
            });
            
        });
    }
}]);
