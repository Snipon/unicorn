jQuery(function($){
  if ($.fn.alert) {
    $(".alert").alert().prepend('<a class="close" data-dismiss="alert" href="#">&times;</a>');
  }
  console.log('Unicorn JS operational');
});
//=require bootstrap-all