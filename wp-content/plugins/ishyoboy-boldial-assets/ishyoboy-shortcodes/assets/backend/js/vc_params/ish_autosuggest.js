/**
 * Created by VlooMan on 12.11.2013.
 */

jQuery('.ish_autosuggest_container').each( function(){
    var me = jQuery(this);
    var input_real = me.find('input.ish-real-field');
    var input_visible = me.find('input.ish-visible-field');
    var data_source = window[ input_visible.attr('data-source') ];

    /*var data_source =[
        { label:'Category A', value:'a' },
        { label:'Category B', value:'b' },
        ...
    ];*/

    function split( val ) {
        return val.split( /,\s*/ );
    }
    function extractLast( term ) {
        return split( term ).pop();
    }

    input_visible
        // don't navigate away from the field on tab when selecting an item
        .bind( "keydown", function( event ) {
            if ( event.keyCode === jQuery.ui.keyCode.TAB &&
                jQuery( this ).data( "ui-autocomplete" ).menu.active ) {
                event.preventDefault();
            }
        })
        .autocomplete({
            minLength: 0,
            source: function( request, response ) {
                // delegate back to autocomplete, but extract the last term
                response( jQuery.ui.autocomplete.filter(
                    data_source, extractLast( request.term ) ) );
            },
            focus: function() {
                // prevent value inserted on focus
                return false;
            },
            select: function( event, ui ) {
                var terms = split( this.value );
                // remove the current input
                terms.pop();
                // add the selected item
                terms.push( ui.item.label );

                // add placeholder to get the comma-and-space at the end
                terms.push( "" );
                this.value = terms.join( ", " );

                return false;
            },
            change : function() {
                var terms = input_visible.val().split(',');
                // prepare an associative array containing Labels as keys
                var final = [];

                // Set each existing label to true
                for( var t in terms ){
                    var term = terms[t].trim();
                    if ( '' != term ){
                        final[ term ] = true;
                    }
                }

                // Loop trough the whole list and set the value of each existing key
                for ( var key in data_source) {
                    var obj = data_source[key];

                    if ( true == final[obj.label] ){
                        final[obj.label] = obj.value;
                    }
                }

                // Loop again to eliminate the unfound values
                for( var t in final ){
                    var term = final[t];
                    if ( true == term ){
                        final[ t ] = t;
                    }
                }

                // Prepare the final string (joining the values) for the real input
                var final_string = '';
                for (var i in final) {
                    final_string += final[i] + ", ";
                }

                // Remove the last comma
                final_string = final_string.slice(0, -2);

                // Set the id's into the real field.
                input_real.val( final_string );
                return false;
            }
        })
        .focus( function(){
            jQuery(this).autocomplete('search', '');
        });
});