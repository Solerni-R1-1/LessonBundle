/* 
 * This file is part of Solerni.
 * 
 * Copyright (C) 2014 Orange
 * 
 * Description: Button Done behavior
 * 
 * This source file is licensed under the terms of the MIT licence: http://spdx.org/licences/MIT
 */

jQuery( document ).ready(function() {
    // CACHING
    doneButton = jQuery( '.btn-done-lesson' );
    doneButtonUrl = doneButton.data('action-url');
    doneButtonAltUrl = doneButton.data('alternate-url');
    doneButtonTargetId = doneButton.data('target-id');
    doneButtonTooltip = doneButton.data('original-title');
    doneButtonTooltipAlt = doneButton.data('alternate-title');
    chapterTree = jQuery( '.slrn-widget__list--railroad' );
    ProgressionValueTexte = jQuery('.presentation__mooc__progression__text');
    ProgressionValueStyle = jQuery('.presentation__mooc__progression__xx');
    
    // ACTIVATE BUTTON
    doneButton.removeAttr( 'disabled' );
    // ACTIVATE BEHAVIOR
    doneButton.on ( 'click', function() { 
            sendDone();
    });
    function sendDone() {
        buttonAjaxSuccess = function( data ) {
            // UPDATE STYLE (TOGGLE)
            railRoadItem = chapterTree.find( '#' + doneButtonTargetId );
            doneButton.toggleClass('is-done');
            railRoadItem.toggleClass('is-done');
            // UPDATE PROGRESSION
            ProgressionValueTexte.text( data.progression + ' %' );
            ProgressionValueStyle.width( data.progression + '%' );
            // SWAP ACTION URL
            tempUrl = doneButtonUrl;
            doneButtonUrl = doneButtonAltUrl;
            doneButtonAltUrl = tempUrl;
            // SWAP TOOLTIP Content
            tempMsg = doneButtonTooltip;
            doneButtonTooltip = doneButtonTooltipAlt;
            doneButtonTooltipAlt = tempMsg;
            doneButton.attr('data-original-title', doneButtonTooltip ).attr('data-alternate-title', doneButtonTooltipAlt ).tooltip( 'fixTitle' );
         }
        buttonAjaxError = function( jqXHR, textStatus ) {
            // QUICK IMPLEMENTATION
            // todo: add messages in macros.flashbox twig (if possible)
            alert( 'L\'opération de mise à jour de vos informations ne s\est pas effectué normalement pour la raison : "' + textStatus + '" . Cette page va se recharger. Merci d\'essayer à nouveau');
            location.reload();
         }
        jQuery.ajax({
            type: 'POST',
            url: doneButtonUrl,
            success: function ( data ) {
                buttonAjaxSuccess( data );
            },
            dataType: 'json',
            async: true,
            error: function( jqXHR, textStatus ) { 
                buttonAjaxError( jqXHR, textStatus );
            }
        });
    }
    
    /*
     * Collapsor for badges
     */
    fullListBadges = jQuery('.list_full_badges');
    fullListBadges.hide().removeClass('hide');
    jQuery('.slrn-widget--badges .collapsor').on( 'click', function() {
        fullListBadges.slideToggle( 250, 'linear' );
    });

    /*
     * Close all Lesson Collapsor
     * except the last one see.
     * Find the current Chapter -> get pertinent parent -> get siblings -> get collapsors -> trigger collapsors
     */
    currentChapterId = jQuery('#chapter_content').data('current-chapter');
    jQuery('#lesson_menu > .slrn-widget__list__item').each(function() {
        if ( jQuery( this ).find( '#' + currentChapterId ).length == 0 ) {
            collapse( jQuery( this ).find('.collapsor') );
        }
    });
});