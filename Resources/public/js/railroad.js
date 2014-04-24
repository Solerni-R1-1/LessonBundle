/* 
 * This file is part of Solerni.
 * 
 * Copyright (C) 2014 Orange
 * 
 * Description: IE8 railroad fallback
 * 
 * This source file is licensed under the terms of the MIT licence: http://spdx.org/licences/MIT
 */

jQuery( document ).ready(function() {
    
    jQuery('.slrn-widget__list--railroad').each( function() {
        railroadheight = ( jQuery(this).height() - 48 );
        jQuery(this).prepend('<div class="slrn-widget__list--railroad__pseudo" style="height: ' + railroadheight  + 'px"></div>');
    });
    
});

