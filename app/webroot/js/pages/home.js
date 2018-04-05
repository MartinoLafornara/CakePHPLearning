// Posizionamento alla sezione indicata
$('a.js-scroll-trigger[href*="#"]:not([href="#"])').click(function() {
    // console.log((location.pathname.replace(/^\//, '')));
    if (location.pathname.replace(/^\//, '') == this.pathname.replace(/^\//, '') && location.hostname == this.hostname) {
        var target = $(this.hash);
        // console.log(location.pathname);
        target = target.length ? target : $('[name=' + this.hash.slice(1) + ']');
        if (target.length) {
            $('html, body').animate({
                scrollTop: (target.offset().top - 52)
            }, 1000, "easeInOutExpo");
            return false;
        }
    }
});

// Item della navbar responsive in base alla sezione
$('body').scrollspy({
    target: '#mainNav',
    offset: 52
});
