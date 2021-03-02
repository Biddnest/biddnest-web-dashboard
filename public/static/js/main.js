
$(document).ready(function(){

    
    const loader = document.querySelector('.loader');  


    
    


    $('[name=email]').keyup(function(){

        if($('form').valid()){
            $(this).parent().removeClass().addClass('isvalid');
        }else{
            $(this).parent().removeClass().addClass('notvalid');
        }
    
    });
});

barba.init({
        
});


barba.hooks.before((data) => {
    NProgress.inc();
  });

  barba.hooks.after((data) => {
    NProgress.done();
            window.scrollTo(0, 0);
            return false;
  });

    



