var Listing = (function(){

    var toggle = function( type ){
        var form = document.createElement('FORM');
        form.style.display = 'none';
        form.method = 'POST';
        form.action = 'assets/listing.php';

        var input = document.createElement('INPUT');
        input.type = 'text';
        input.name = 'toggle';
        input.value = type;

        form.appendChild( input );
        document.body.appendChild( form );

        // Let the toggle finish
        setTimeout( function(){
            form.submit();
        }, 300 );

    };

    return {
        'toggle': toggle
    };

})();
