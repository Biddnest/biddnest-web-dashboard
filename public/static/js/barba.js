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