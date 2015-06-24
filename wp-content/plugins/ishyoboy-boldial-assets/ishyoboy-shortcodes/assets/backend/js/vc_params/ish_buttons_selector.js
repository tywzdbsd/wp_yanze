/**
 * Created by VlooMan on 12.11.2013.
 */

jQuery('.ish_buttons_selector_container').each( function(){
    var me = jQuery(this);
    var input = me.find('input');

    me.find('.ish_btnlist_item').click(function(e){
        e.preventDefault();
        var icon = jQuery(this);
        input.val( icon.attr('data-ish-value') );
        input.trigger('change');
        me.find('li').removeClass('active');
        icon.parent().addClass('active');
    });

});