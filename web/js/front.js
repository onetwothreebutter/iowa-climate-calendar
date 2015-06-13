(function($){
  $('document').ready(function(){
    debugger;
    $('.climate-events__subscribe').on('click', function(event){

      var $subscribeForm = $('.subscribe-form');
      if($subscribeForm.hasClass('-form-hidden')){
        $subscribeForm.removeClass('-form-hidden').addClass('-form-show');
      } else {
        $subscribeForm.removeClass('-form-show').addClass('-form-hidden');
      }
    });
  });
})(jQuery);