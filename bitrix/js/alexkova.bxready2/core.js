(function (window) {
    if (typeof window.BXReady != 'object') {
        window.BXReady = {};
    }
    
    if (typeof window.BXReady.loader != 'object')
        window.BXReady.loader = [];
    
    window.onload = function()
    {
        if (typeof window.BXReady.loader != 'object')
            window.BXReady.loader = [];
        for ( var i in window.BXReady.loader )
        {
            if ( typeof( window.BXReady.loader[i] ) == 'function' ) window.BXReady.loader[i](); 
        }
    };
    
})(window);