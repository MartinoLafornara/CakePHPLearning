/**
 *   Posizionamento alla sezione indicata
 *   quando si verifica l'evento click su un link che abbia
 *   - come classe 'js-scroll-trigger'
 *   - come href '#parola' e non solo '#'.
 */
 
$('a.js-scroll-trigger[href*="#"]:not([href="#"])').click(function() {

    if (location.pathname.replace(/^\//, '') == this.pathname.replace(/^\//, '') && location.hostname == this.hostname) {
        //Attribuisce a target il valore dell'attributo href.
        var target = $(this.hash);
        /*
          Se il target esiste all'interno della pagina (target.length >=1) viene
          confermato quel target altrimenti JS cerca di fare una ricerca in base
          all'attributo name=href senza '#'.

          [Osservanza] => in JQuery per indicare un elemento con un determinato
          attributo si usa la seguente sintassi ([attributo] = value).
        */
        target = target.length ? target : $('[name=' + this.hash.slice(1) + ']');
        if (target.length) {
            /*
               Viene animato il body e html:
               - scrollando verso l'alto il target a una posizione pari a top - 52px;
               - durata complessiva pari a 1000ms;
               - effetto : 'easeInOutExpo'.
            */
            $('html, body').animate({
                scrollTop: (target.offset().top - 52)
            }, 1000, "easeInOutExpo");
            return false;
        }
    }
});

// Item della navbar responsive in base alla sezione
$('body').scrollspy({
    target: '#mainNav', //Id Navbar
    offset: 52  //Posizione di 'lettura'
});
