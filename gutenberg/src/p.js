import { registerBlockType } from '@wordpress/blocks';
import { RichText } from '@wordpress/editor';
import { createBlock } from '@wordpress/blocks';

registerBlockType( 'kikoiro1/p', {
    title: '本文段落',
    icon: 'editor-paragraph',
    category: 'kikoiro1',
    attributes: {
        content: {
            selector: 'p',
            type: 'string',
            source: 'html',
            default: ''
        },
    },
    transforms: {
        from: [
            {
                type: 'block',
                blocks: [ 'core/paragraph' ],
                transform: ( { content } ) => {
                    return createBlock( 'kikoiro1/p', {
                        content,
                    } );
                },
            },
        ],
        to: [
            {
                type: 'block',
                blocks: [ 'core/paragraph' ],
                transform: ({content}) => createBlock('core/paragraph', {content}),
            }
        ],
    },
    edit(props) {
        let content = props.attributes.content;
        let onChangeContent = function( content ) {
            props.setAttributes( { content: content } );
        }
        return (
            <RichText 
                tagName="p" 
                multiline="false"
                value={ content } 
                onChange={ onChangeContent } />
        );
    },
    save(props) {
        return (
            <RichText.Content
                tagName="p" 
                multiline="false"
                value={ props.attributes.content } />
        );
    },
});
