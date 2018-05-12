(function() {
    tinymce.create('tinymce.plugins.wpthumbtinymce', {
        init : function(ed, url) {
            ed.addButton('wpthumb', {
                title: ed.getLang('wpthumbtinymce.website_thumbnails'),
                image: url + '/../img/wpthumb-tinymce-button-icon.png',
                onclick: function () {
                    getAccountInfo(function() {
                        var accountSettings = ed.settings.wpthumbAccountData;
                        var bodyItems = [];
                        bodyItems.push({
                            type: 'textbox',
                            name: 'website_url',
                            label: ed.getLang('wpthumbtinymce.website_url'),
                            tooltip: ed.getLang('wpthumbtinymce.website_url_tooltip'),
                            size: 50,
                            value: ''
                        });
                        if (typeof accountSettings == 'undefined' || typeof accountSettings != 'undefined' && !('shortcode' in accountSettings)) {
                            bodyItems.push({
                                type: 'listbox',
                                name: 'shortcode',
                                label: ed.getLang('wpthumbtinymce.shortcode_syntax'),
                                size: 50,
                                values: [
                                    {text: ed.getLang('wpthumbtinymce.thumb'), value: 'thumb'},
                                    {text: ed.getLang('wpthumbtinymce.stwthumb'), value: 'stwthumb'}
                                ],
                                value: 'thumb' // Sets the default
                            });
                        }

                        bodyItems.push({
                                type: 'listbox',
                                name: 'link',
                                label: ed.getLang('wpthumbtinymce.create_link'),
                                size: 50,
                                values: [
                                    {text: ed.getLang('wpthumbtinymce.no'), value: 'false'},
                                    {text: ed.getLang('wpthumbtinymce.yes'), value: 'true'}
                                ],
                                value: 'false' // Sets the default
                            },
                            {
                                type: 'textbox',
                                name: 'alt',
                                label: ed.getLang('wpthumbtinymce.alt'),
                                tooltip: ed.getLang('wpthumbtinymce.alt_tooltip'),
                                size: 50,
                                value: ''
                            },
                            {
                                type: 'textbox',
                                name: 'title',
                                label: ed.getLang('wpthumbtinymce.title'),
                                tooltip: ed.getLang('wpthumbtinymce.title_tooltip'),
                                size: 50,
                                value: ''
                            }
                        );

                        var sizes = [
                            {text: ed.getLang('wpthumbtinymce.mcr'), value: 'mcr'},
                            {text: ed.getLang('wpthumbtinymce.tny'), value: 'tny'},
                            {text: ed.getLang('wpthumbtinymce.vsm'), value: 'vsm'},
                            {text: ed.getLang('wpthumbtinymce.sm'), value: 'sm'},
                            {text: ed.getLang('wpthumbtinymce.lg'), value: 'lg'},
                            {text: ed.getLang('wpthumbtinymce.xlg'), value: 'xlg'}
                        ];
                        if (typeof accountSettings != 'undefined' && ('custom_size' in accountSettings) && accountSettings.custom_size == true) {
                            sizes.push({text: ed.getLang('wpthumbtinymce.custom'), value: 'custom'});
                            var customSizeBox = {
                                type: 'FieldSet',
                                name: 'custom_size_box',
                                hidden: true,
                                maxHeight: 52,
                                border: 'none',
                                items: [
                                    {
                                        type: 'textbox',
                                        name: 'custom_size',
                                        label: ed.getLang('wpthumbtinymce.custom_size'),
                                        tooltip: ed.getLang('wpthumbtinymce.custom_size_tooltip'),
                                        size: 50,
                                        value: ''
                                    }
                                ]
                            };
                        }

                        bodyItems.push({
                            type: 'listbox',
                            name: 'size',
                            label: ed.getLang('wpthumbtinymce.size'),
                            size: 50,
                            values: sizes,
                            value: 'lg', // Sets the default
                            onselect: function () {
                                var selected_val = this.value();
                                if (selected_val == 'custom') {
                                    win.find('#custom_size_box').show();
                                }
                                else {
                                    win.find('#custom_size_box').hide();
                                }
                            }
                        });

                        if (typeof customSizeBox != 'undefined') {
                            bodyItems.push(customSizeBox);
                        }

                        bodyItems.push({
                            type: 'textbox',
                            name: 'custom_filename',
                            label: ed.getLang('wpthumbtinymce.custom_filename'),
                            tooltip: ed.getLang('wpthumbtinymce.custom_filename_tooltip'),
                            size: 50,
                            value: ''
                        });

                        if (typeof accountSettings != 'undefined' && ('full_length' in accountSettings) && accountSettings.full_length == true) {
                            bodyItems.push({
                                type: 'listbox',
                                name: 'full_length',
                                label: ed.getLang('wpthumbtinymce.full_length'),
                                size: 50,
                                values: [
                                    {text: ed.getLang('wpthumbtinymce.no'), value: 'false'},
                                    {text: ed.getLang('wpthumbtinymce.yes'), value: 'true'}
                                ],
                                value: 'false' // Sets the default
                            });
                        }

                        if (typeof accountSettings != 'undefined' && ('custom_screen' in accountSettings) && accountSettings.custom_screen == true) {
                            bodyItems.push({
                                type: 'textbox',
                                name: 'screen',
                                label: ed.getLang('wpthumbtinymce.screen'),
                                tooltip: ed.getLang('wpthumbtinymce.screen_tooltip'),
                                size: 50,
                                value: ''
                            });
                        }

                        var win = ed.windowManager.open({
                            title: ed.getLang('wpthumbtinymce.shrink_the_web_website_thumbnails'),
                            minWidth: 660,
                            body: bodyItems,
                            onsubmit: function (e) {
                                var shortcode = 'thumb';
                                if (typeof accountSettings != 'undefined' && 'shortcode' in accountSettings && accountSettings.shortcode != '') {
                                    shortcode = accountSettings['shortcode'];
                                }
                                else {
                                    if (e.data.shortcode != null) {
                                        shortcode = e.data.shortcode;
                                    }
                                }

                                // Values from user
                                var website_url = e.data.website_url;
                                var link = e.data.link;
                                var alt = e.data.alt;
                                var title = e.data.title;
                                var size = e.data.size;
                                var custom_size = e.data.custom_size;
                                var custom_filename = e.data.custom_filename;
                                var full_length = e.data.full_length;
                                var screen = e.data.screen;

                                if (website_url == null || website_url == '') {
                                    e.preventDefault();
                                    ed.windowManager.alert(ed.getLang('wpthumbtinymce.website_url_empty'), function () {
                                        win.find('#website_url')[0].focus();
                                    });
                                    return;
                                }

                                // Build shortcode tag
                                var shortcode_tag = '[' + shortcode;

                                if (link != null && link == 'true') {
                                    shortcode_tag += ' link="' + link + '"';
                                }
                                if (alt != null && alt != '') {
                                    shortcode_tag += ' alt="' + alt + '"';
                                }
                                if (title != null && title != '') {
                                    shortcode_tag += ' title="' + title + '"';
                                }
                                if (size != null) {
                                    shortcode_tag += ' size="' + (size == 'custom' && custom_size != null ? custom_size : size) + '"';
                                }
                                if (custom_filename != null && custom_filename != '') {
                                    shortcode_tag += ' custom_filename="' + custom_filename + '"';
                                }
                                if (full_length != null && full_length == 'true') {
                                    shortcode_tag += ' full_length="' + full_length + '"';
                                }
                                if (screen != null && screen != '') {
                                    shortcode_tag += ' screen="' + screen + '"';
                                }

                                shortcode_tag += ']';
                                shortcode_tag += website_url;
                                shortcode_tag += '[/' + shortcode + ']';


                                if (ed.selection.length) {
                                    ed.selection.setContent(shortcode_tag);
                                } else {
                                    ed.insertContent(shortcode_tag);
                                }
                            }
                        });
                    });
                }
            });
        },

        createControl : function(n, cm) {
            return null;
        },

        getInfo : function() {
            return {
                longname    : 'Shrink The Web - Website Thumbnails',
                author      : '',
                authorurl   : '',
                infourl     : '',
                version     : ''
            };
        }
    });

    // Register plugin
    tinymce.PluginManager.add( 'wpthumbtinymce', tinymce.plugins.wpthumbtinymce );
})();