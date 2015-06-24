/*
 *   Widgets
 */

jQuery('div[id*="ishyoboy"]').each(function(){
    jQuery(this).find('.widget-title').prepend('<span class="ishyoboy-icon"></span>');
});