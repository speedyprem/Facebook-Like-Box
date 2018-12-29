/**
 * Facebook Like Box Gutenberg Block
 *
 * https://wordpress.org/plugins/responsive-facebook-like-box/
 */

( function() {
    var __                = wp.i18n.__;
    var createElement     = wp.element.createElement;
    var registerBlockType = wp.blocks.registerBlockType;
    var RichText          = wp.editor.RichText;

    /**
     * Register a gutenberg block
     *
     * @param  Facebook Like Box
     * @return Block itself, if registered successfully.
     */
    registerBlockType(
        'rflb/facebook-like-box',
        {
            title: __( 'Facebook Like Box' ),
            icon: 'facebook',
            category: 'common',
            attributes: {
                content: {
                    type: 'URL',
                    default: 'Add your Facebook page url here...',
                },
            },

            // Defines the block within the editor.
            edit: function( props ) {
                var content = props.attributes.content;
                var focus = props.focus;

                function onChangeContent( updatedContent ) {
                    props.setAttributes( { content: updatedContent } );
                }

                return createElement(
                    RichText,
                    {
                        tagName: 'p',
                        className: props.className,
                        value: content,
                        onChange: onChangeContent,
                        focus: focus,
                        onFocus: props.setFocus
                    },
                );
            },

            // Defines the saved block.
            save: function( props ) {
                var content = props.attributes.content;
                return createElement( RichText.Content,
                    {
                        'tagName': 'div',
                        'value': content
                    }
                );
            },
        }
    );
})();
