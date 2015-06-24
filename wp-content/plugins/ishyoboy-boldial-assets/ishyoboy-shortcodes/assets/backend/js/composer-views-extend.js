var Shortcodes = vc.shortcodes;

window.IshDefaultView = vc.shortcode_view.extend({

    changeShortcodeParams:function (model) {

        var params = model.get('params');
        window.IshDefaultView.__super__.changeShortcodeParams.call(this, model);

        if ( _.isObject( params ) ) {

            var wrapper = this.$el.find('> .wpb_element_wrapper');

            var sc_class = '';

            // Set Color
            if ( ( 'undefined' != typeof params.color ) && ( '' != params.color ) && ( 'advanced' != params.color)  ){
                sc_class += 'ish-' + params.color;
            }

            // Output Custom classes
            if ( '' != sc_class ){
                wrapper.removeClass();
                wrapper.addClass( 'wpb_element_wrapper ' + sc_class );
            }
        }

    }

});

window.IshImageView = vc.shortcode_view.extend({

    changeShortcodeParams:function (model) {

        var params = model.get('params');
        window.IshImageView.__super__.changeShortcodeParams.call(this, model);

        if ( _.isObject( params ) ) {

            var wrapper = this.$el.find('> .wpb_element_wrapper');

            var sc_class = '';

            if ( ('undefined' != typeof params.image ) && ( '' != params.image ) ){
                sc_class = 'ish-with-image';
            } else {
                sc_class = 'ish-no-image';
            }

            // Output Custom classes
            if ( '' != sc_class ){
                wrapper.removeClass();
                wrapper.addClass( 'wpb_element_wrapper ' + sc_class );
            }
        }

    }

});

window.IshVcRowView = window.VcRowView.extend({

    render: function () {
        window.IshVcRowView.__super__.render.call( this );
        var params = this.model.get('params');
        if ( _.isObject( params ) ) {

            var container = this.$el.find('.wpb_row_container');

            // Set Theme Color
            container.attr( 'data-ish-color', params.color );

        }
        return this;
    },
    changeShortcodeParams:function (model) {
        var params = model.get('params');
        if ( 'advanced' != params.color ) params.bg_color = '';
        model.set('params', params);
        window.IshVcRowView.__super__.changeShortcodeParams.call(this, model);
        if ( _.isObject( params ) ) {

            var container = this.$el.find('.wpb_row_container');
            var columns = container.children('.wpb_vc_column');

            // Set Theme Color
            container.attr( 'data-ish-color', params.color );

            // Remove custom color if set previously
            columns.css( 'background', '' );

            // Add custom color
            if ( 'advanced' == params.color ) {
                columns.css('background', params.bg_color );
            }
        }

    }

});

window.IshIconView = vc.shortcode_view.extend({

    changeShortcodeParams:function (model) {

        var params = model.get('params');
        window.IshIconView.__super__.changeShortcodeParams.call(this, model);

        if ( _.isObject( params ) ) {

            var wrapper = this.$el.find('> .wpb_element_wrapper');

            var sc_class = '';

            // Set Color
            if ( ( 'undefined' != typeof params.color ) && ( '' != params.color ) && ( 'advanced' != params.color)  ){
                sc_class += 'ish-' + params.color;
            }

            // Set Icon
            if ( ( 'undefined' != typeof params.icon ) && '' != params.icon ){
                sc_class += ' ' + params.icon;
            }

            // Output Custom classes
            if ( '' != sc_class ){
                wrapper.removeClass();
                wrapper.addClass( 'wpb_element_wrapper ' + sc_class );
            }
        }

    }

});

window.IshColorIconView = vc.shortcode_view.extend({

    changeShortcodeParams:function (model) {

        var params = model.get('params');
        window.IshColorIconView.__super__.changeShortcodeParams.call(this, model);

        if ( _.isObject( params ) ) {

            var wrapper = this.$el.find('> .wpb_element_wrapper');

            var sc_class = '';

            // Set Color
            if ( ( 'undefined' != typeof params.color ) && ( '' != params.color ) && ( 'advanced' != params.color)  ){
                sc_class += 'ish-' + params.color;
            }

            // Set Icon
            if ( ( 'undefined' != typeof params.icon ) && '' != params.icon ){
                sc_class += ' ish-svg-container';

                wrapper.find('.ish-svg-icon').remove();

                var icon_data = params.icon.split('/');

                if ( icon_data.length == 2 ){
                    icon_data[2] = icon_data[1];
                    icon_data[1] = icon_data[0];
                    icon_data[0] = 'path_plugin';
                }

                var icon_path = window.iyb_pagebuilder[icon_data[0]] + icon_data[1] + '/' +icon_data[2];

                wrapper.prepend('<i class="ish-svg-icon" style="background-image: url(\'' + icon_path + '\');"></i>');
            }

            // Output Custom classes
            if ( '' != sc_class ){
                wrapper.removeClass();
                wrapper.addClass( 'wpb_element_wrapper ' + sc_class );
            }
        }

    }

});

window.IshButtonView = vc.shortcode_view.extend({

    changeShortcodeParams:function (model) {

        var params = model.get('params');
        window.IshButtonView.__super__.changeShortcodeParams.call(this, model);

        if ( _.isObject( params ) ) {

            var wrapper = this.$el.find('> .wpb_element_wrapper');

            var sc_class = '';

            // Set Color
            if ( ( 'undefined' != typeof params.color ) && ( '' != params.color ) && ( 'advanced' != params.color)  ){
                sc_class += 'ish-' + params.color;
            }

            // Set Icon
            if ( ( 'undefined' != typeof params.icon ) && '' != params.icon ){
                sc_class += ' ' + params.icon;
            }

            // Output Custom classes
            if ( '' != sc_class ){
                wrapper.removeClass();
                wrapper.addClass( 'wpb_element_wrapper ' + sc_class );
            }
        }

    }

});

window.IshListView = vc.shortcode_view.extend({

    changeShortcodeParams:function (model) {

        var params = model.get('params');
        window.IshListView.__super__.changeShortcodeParams.call(this, model);

        if ( _.isObject( params ) ) {

            var wrapper = this.$el.find('> .wpb_element_wrapper');

            var sc_class = '';

            // Set Color
            if ( ( 'undefined' != typeof params.color ) && ( '' != params.color ) && ( 'advanced' != params.color)  ){
                sc_class += 'ish-' + params.color;
            }

            // Set Icon
            if ( ( 'undefined' != typeof params.icon ) && '' != params.icon ){
                // sc_class += ' ' + params.icon;

                wrapper.find('.ish-list ul li').removeClass().addClass( params.icon );
            }

            // Output Custom classes
            if ( '' != sc_class ){
                wrapper.removeClass();
                wrapper.addClass( 'wpb_element_wrapper ' + sc_class );
            }
        }

    }

});

window.IshVcColumnView = window.VcColumnView.extend({

    render: function () {
        window.IshVcColumnView.__super__.render.call( this );

        var my_parent = Shortcodes.where({id: this.model.get('parent_id')});
        if ( my_parent.length > 0 ){
            var params = my_parent[0].get('params');
        }


        if ( 'advanced' == params.color ) {
            this.$el.css('background', params.bg_color );
        }

        return this;
    }

});

window.IshMapView = window.VcColumnView.extend({

    changeShortcodeParams:function (model) {

        var params = model.get('params');
        window.IshMapView.__super__.changeShortcodeParams.call(this, model);

        if ( _.isObject( params ) ) {

            var wrapper = this.$el.find('> .wpb_element_wrapper');

            var sc_class = '';

            // Set Color
            if ( ( 'undefined' != typeof params.color ) && ( '' != params.color ) && ( 'advanced' != params.color)  ){
                sc_class += 'ish-' + params.color;
            }

            // Output Custom classes
            if ( '' != sc_class ){
                wrapper.removeClass();
                wrapper.addClass( 'wpb_element_wrapper ' + sc_class );
            }
        }

    }

});

window.IshSkillsView = window.VcColumnView.extend({

    changeShortcodeParams:function (model) {

        var params = model.get('params');
        window.IshSkillsView.__super__.changeShortcodeParams.call(this, model);

        if ( _.isObject( params ) ) {

            var wrapper = this.$el.find('> .wpb_element_wrapper');

            var sc_class = '';

            // Set Color
            if ( ( 'undefined' != typeof params.skill_color ) && ( '' != params.skill_color ) && ( 'advanced' != params.skill_color)  ){
                sc_class += 'ish-' + params.skill_color;
            }

            // Output Custom classes
            if ( '' != sc_class ){
                wrapper.removeClass();
                wrapper.addClass( 'wpb_element_wrapper ' + sc_class );
            }
        }

    }

});

window.IshPricingTableView = window.VcColumnView.extend({

	changeShortcodeParams:function (model) {

		var params = model.get('params');
		window.IshPricingTableView.__super__.changeShortcodeParams.call(this, model);

		if ( _.isObject( params ) ) {

			var wrapper = this.$el.find('> .wpb_element_wrapper');

			var sc_class = '';

			// Set Color
			if ( ( 'undefined' != typeof params.color ) && ( '' != params.color ) && ( 'advanced' != params.color)  ){
				sc_class += 'ish-' + params.color;
			}

			// Output Custom classes
			if ( '' != sc_class ){
				wrapper.removeClass();
				wrapper.addClass( 'wpb_element_wrapper ' + sc_class );
			}
		}

	}

});

window.IshPricingRowView = vc.shortcode_view.extend({

	changeShortcodeParams:function (model) {

		var params = model.get('params');
		window.IshPricingRowView.__super__.changeShortcodeParams.call(this, model);

		if ( _.isObject( params ) ) {

			var wrapper = this.$el.find('> .wpb_element_wrapper');

			var sc_class = '';

			if ( 'undefined' != typeof params.type ){

				if ( 'button' == params.type ){
					// Set Color
					if ( ( 'undefined' != typeof params.color ) && ( '' != params.color ) && ( 'advanced' != params.color)  ){
						sc_class += 'ish-' + params.color;
					}

					// Set Icon
					if ( ( 'undefined' != typeof params.button_icon ) && '' != params.button_icon ){
						sc_class += ' ' + params.button_icon;
					}

				}

				if ( 'icon' == params.type ){
					// Set Icon
					if ( ( 'undefined' != typeof params.icon ) && '' != params.icon ){
						sc_class += ' ' + params.icon;
					}
				}

				var container = this.$el.find('.ish-pricing-row');

				// Set The Right Texts

				if ( 'undefined' != typeof params.text_content ) {
					// Text
					container.html( params.text_content );

				}

				if ( 'undefined' != typeof params.type ){

					if ( ( 'button' == params.type ) && ('undefined' != typeof params.button_text ) ){
						container.html( params.button_text );
					}

					else if ( 'icon' == params.type ){
						container.html( 'Icon' );
					}

				}

			}

			// Output Custom classes
			if ( '' != sc_class ){
				wrapper.removeClass();
				wrapper.addClass( 'wpb_element_wrapper ' + sc_class );
			}else{
				wrapper.removeClass();
				wrapper.addClass( 'wpb_element_wrapper' );
			}
		}

	}

});

window.IshVcSlidableView = window.VcColumnView.extend({

    events:{
        'click > .controls .column_delete':'deleteShortcode',
        'click > .controls .column_add':'addElement',
        'click > .controls .column_edit':'editElement',
        'click > .controls .column_clone':'clone',
        'click > .wpb_element_wrapper > .vc_empty-container':'addToEmpty'

    },

    addElement:function (e) {
        e.preventDefault();

        var position = ( !_.isObject(e) || !jQuery(e.currentTarget).closest('.bottom-controls').hasClass('bottom-controls') ) ? 'start' : 'end';

        function getFirstPositionIndex() {
            vc.element_start_index -= 1;
            return vc.element_start_index;
        }

        Shortcodes.create({
            shortcode:'ish_slide',
            parent_id:this.model.id,
            order:(position == 'start' ? getFirstPositionIndex() : Shortcodes.getNextOrder()),
            params:vc.getDefaults('ish_slide')
        });

        return false;
    }

});

window.IshVcSlideView = window.VcColumnView.extend({

    events:{
        'click > .controls .column_delete':'deleteShortcode',
        'click > .controls .column_add':'addElement',
        'click > .controls .column_edit':'editElement',
        'click > .controls .column_clone':'clone',
        'click > .wpb_element_wrapper > .vc_empty-container':'addToEmpty'
    },

    addElement:function (e) {
        e.preventDefault();

        var position = ( !_.isObject(e) || !jQuery(e.currentTarget).closest('.bottom-controls').hasClass('bottom-controls') ) ? 'start' : 'end';

        function getFirstPositionIndex() {
            vc.element_start_index -= 1;
            return vc.element_start_index;
        }

        row = model = Shortcodes.create({
            shortcode:'vc_row_inner',
            parent_id:this.model.id,
            order:(position == 'start' ? getFirstPositionIndex() : Shortcodes.getNextOrder())
        });
        Shortcodes.create({shortcode:'vc_column_inner', params:{width:'1/1'}, parent_id:row.id, root_id:row.id });

        return false;
    }

});

window.IshVcTabsView = window.VcColumnView.extend({

    events:{
        'click > .controls .column_delete':'deleteShortcode',
        'click > .controls .column_add':'addElement',
        'click > .controls .column_edit':'editElement',
        'click > .controls .column_clone':'clone',
        'click > .wpb_element_wrapper > .vc_empty-container':'addToEmpty'
    },

    addElement:function (e) {
        e.preventDefault();

        var position = ( !_.isObject(e) || !jQuery(e.currentTarget).closest('.bottom-controls').hasClass('bottom-controls') ) ? 'start' : 'end';

        function getFirstPositionIndex() {
            vc.element_start_index -= 1;
            return vc.element_start_index;
        }

        Shortcodes.create({
            shortcode:'ish_tab',
            parent_id:this.model.id,
            order:(position == 'start' ? getFirstPositionIndex() : Shortcodes.getNextOrder()),
            params:vc.getDefaults('ish_tab')
        });

        return false;
    },

    changeShortcodeParams:function (model) {

        var params = model.get('params');
        window.IshVcTabsView.__super__.changeShortcodeParams.call(this, model);

        if ( _.isObject( params ) ) {

            var wrapper = this.$el.find('> .wpb_element_wrapper');

            var sc_class = '';

            // Set Color
            if ( ( 'undefined' != typeof params.color ) && ( '' != params.color ) && ( 'advanced' != params.color)  ){
                sc_class += 'ish-' + params.color;
            }

            // Output Custom classes
            if ( '' != sc_class ){
                wrapper.removeClass();
                wrapper.addClass( 'wpb_element_wrapper ' + sc_class );
            }
        }

    }

});

window.IshVcTabView = window.VcColumnView.extend({

    events:{
        'click > .controls .column_delete':'deleteShortcode',
        'click > .controls .column_add':'addElement',
        'click > .controls .column_edit':'editElement',
        'click > .controls .column_clone':'clone',
        'click > .wpb_element_wrapper > .vc_empty-container':'addToEmpty'
    },

    addElement:function (e) {

        e.preventDefault();

        var position = ( !_.isObject(e) || !jQuery(e.currentTarget).closest('.bottom-controls').hasClass('bottom-controls') ) ? 'start' : 'end';

        function getFirstPositionIndex() {
            vc.element_start_index -= 1;
            return vc.element_start_index;
        }

        row = model = Shortcodes.create({
            shortcode:'vc_row_inner',
            parent_id:this.model.id,
            order:(position == 'start' ? getFirstPositionIndex() : Shortcodes.getNextOrder())
        });
        Shortcodes.create({shortcode:'vc_column_inner', params:{width:'1/1'}, parent_id:row.id, root_id:row.id });

        return false;
    },

    changeShortcodeParams:function (model) {

        var params = model.get('params');
        window.IshVcTabView.__super__.changeShortcodeParams.call(this, model);

        if ( _.isObject( params ) ) {

            var wrapper = this.$el.find('.ish-tab-title-holder');

            // Set tab title
            if ( ( 'undefined' != typeof params.tab_title ) && ( '' != params.tab_title ) ){
                wrapper.html( params.tab_title );
            }

            var icon_wrapper = this.$el.find('> .wpb_element_wrapper');

            var sc_class = '';

            // Set Color
            if ( ( 'undefined' != typeof params.color ) && ( '' != params.color ) && ( 'advanced' != params.color)  ){
                sc_class += ' ish-' + params.color;
            }

            // Set Icon
            if ( ( 'undefined' != typeof params.icon ) && '' != params.icon ){
                sc_class += ' ' + params.icon;
            }

            // Output Custom classes
            if ( '' != sc_class ){
                icon_wrapper.removeClass();
                icon_wrapper.addClass( 'wpb_element_wrapper ' + sc_class );
            }
        }

    }

});

window.IshBoxView = window.VcColumnView.extend({

	events:{
        'click > .controls .column_delete':'deleteShortcode',
        'click > .controls .column_add':'addElement',
        'click > .controls .column_edit':'editElement',
        'click > .controls .column_clone':'clone',
        'click > .wpb_element_wrapper > .vc_empty-container':'addToEmpty'
	},

	addElement:function (e) {

		e.preventDefault();

		var position = ( !_.isObject(e) || !jQuery(e.currentTarget).closest('.bottom-controls').hasClass('bottom-controls') ) ? 'start' : 'end';

		function getFirstPositionIndex() {
			vc.element_start_index -= 1;
			return vc.element_start_index;
		}

		row = model = Shortcodes.create({
			shortcode:'vc_row_inner',
			parent_id:this.model.id,
			order:(position == 'start' ? getFirstPositionIndex() : Shortcodes.getNextOrder())
		});
		Shortcodes.create({shortcode:'vc_column_inner', params:{width:'1/1'}, parent_id:row.id, root_id:row.id });

		return false;
	},

	changeShortcodeParams:function (model) {

		var params = model.get('params');
		window.IshBoxView.__super__.changeShortcodeParams.call(this, model);

		if ( _.isObject( params ) ) {

			var wrapper = this.$el.find('.ish-tab-title-holder');

			// Set tab title
			if ( ( 'undefined' != typeof params.tab_title ) && ( '' != params.tab_title ) ){
				wrapper.html( params.tab_title );
			}

			var icon_wrapper = this.$el.find('> .wpb_element_wrapper');

			var sc_class = '';

			// Set Color
			if ( ( 'undefined' != typeof params.color ) && ( '' != params.color ) && ( 'advanced' != params.color)  ){
				sc_class += ' ish-' + params.color;
			}

			// Set Icon
			if ( ( 'undefined' != typeof params.icon ) && '' != params.icon ){
				sc_class += ' ' + params.icon;
			}

			// Output Custom classes
			if ( '' != sc_class ){
				icon_wrapper.removeClass();
				icon_wrapper.addClass( 'wpb_element_wrapper ' + sc_class );
			}
		}

	}

});

window.IshVcTggAccView = window.VcColumnView.extend({

    events:{
        'click > .controls .column_delete':'deleteShortcode',
        'click > .controls .column_add':'addElement',
        'click > .controls .column_edit':'editElement',
        'click > .controls .column_clone':'clone',
        'click > .wpb_element_wrapper > .vc_empty-container':'addToEmpty'
    },

    addElement:function (e) {
        e.preventDefault();

        var position = ( !_.isObject(e) || !jQuery(e.currentTarget).closest('.bottom-controls').hasClass('bottom-controls') ) ? 'start' : 'end';

        function getFirstPositionIndex() {
            vc.element_start_index -= 1;
            return vc.element_start_index;
        }

        Shortcodes.create({
            shortcode:'ish_tgg_acc_item',
            parent_id:this.model.id,
            order:(position == 'start' ? getFirstPositionIndex() : Shortcodes.getNextOrder()),
            params:vc.getDefaults('ish_tgg_acc_item')
        });

        return false;
    },

    changeShortcodeParams:function (model) {

        var params = model.get('params');
        window.IshVcTggAccView.__super__.changeShortcodeParams.call(this, model);

        if ( _.isObject( params ) ) {

            var title_wrapper = this.$el.find('.ish-tggacc-title-holder');

            // Set tab title
            if ( ( 'undefined' != typeof params.behavior && '' != params.behavior ) ){
                title_wrapper.html( window.iyb_pagebuilder.trans_strings.accordion );
            }else{
                title_wrapper.html( window.iyb_pagebuilder.trans_strings.toggle );
            }

            var wrapper = this.$el.find('> .wpb_element_wrapper');

            var sc_class = '';

            // Set Color
            if ( ( 'undefined' != typeof params.color ) && ( '' != params.color ) && ( 'advanced' != params.color)  ){
                sc_class += 'ish-' + params.color;
            }

            // Output Custom classes
            if ( '' != sc_class ){
                wrapper.removeClass();
                wrapper.addClass( 'wpb_element_wrapper ' + sc_class );
            }
        }

    }

});

window.IshVcTggAccItemView = window.VcColumnView.extend({

    events:{
        'click > .controls .column_delete':'deleteShortcode',
        'click > .controls .column_add':'addElement',
        'click > .controls .column_edit':'editElement',
        'click > .controls .column_clone':'clone',
        'click > .wpb_element_wrapper > .vc_empty-container':'addToEmpty'
    },

    addElement:function (e) {

        e.preventDefault();

        var position = ( !_.isObject(e) || !jQuery(e.currentTarget).closest('.bottom-controls').hasClass('bottom-controls') ) ? 'start' : 'end';

        function getFirstPositionIndex() {
            vc.element_start_index -= 1;
            return vc.element_start_index;
        }

        row = model = Shortcodes.create({
            shortcode:'vc_row_inner',
            parent_id:this.model.id,
            order:(position == 'start' ? getFirstPositionIndex() : Shortcodes.getNextOrder())
        });
        Shortcodes.create({shortcode:'vc_column_inner', params:{width:'1/1'}, parent_id:row.id, root_id:row.id });

        return false;
    },

    changeShortcodeParams:function (model) {

        var params = model.get('params');
        window.IshVcTggAccItemView.__super__.changeShortcodeParams.call(this, model);

        if ( _.isObject( params ) ) {

            var wrapper = this.$el.find('.ish-tgg-acc-title-holder');

            // Set tab title
            if ( ( 'undefined' != typeof params.el_title ) ){
                wrapper.html( params.el_title );
            }

            var icon_wrapper = this.$el.find('> .wpb_element_wrapper');

            var sc_class = '';

            // Set Color
            if ( ( 'undefined' != typeof params.color ) && ( '' != params.color ) && ( 'advanced' != params.color)  ){
                sc_class += ' ish-' + params.color;
            }

            // Set Icon
            if ( ( 'undefined' != typeof params.icon ) && '' != params.icon ){
                sc_class += ' ' + params.icon;
            }

            // Output Custom classes
            if ( '' != sc_class ){
                icon_wrapper.removeClass();
                icon_wrapper.addClass( 'wpb_element_wrapper ' + sc_class );
            }


        }

    }

});


window.i18nLocale.main_button_title = window.iyb_pagebuilder.main_button_title;
window.i18nLocale.main_button_title_revert = window.iyb_pagebuilder.main_button_title_revert;
window.i18nLocale.main_button_title_backend_editor = window.iyb_pagebuilder.main_button_title;