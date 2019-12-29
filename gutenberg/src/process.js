import { registerBlockType } from '@wordpress/blocks';
import { RichText } from '@wordpress/editor';
import { createBlock } from '@wordpress/blocks';
import { getClassNameFromProperty } from './tools.js';

registerBlockType( 'kikoiro1/process', {
    title: '本文-手順',
    icon: 'editor-ol',
    category: 'kikoiro1',
    attributes: {
        content: {
            selector: 'p',
            type: 'string',
            source: 'html',
            default: ''
        }
    },
    transforms: {
        from: [
            {
                type: 'block',
                blocks: [ 'core/paragraph' ],
                transform: ( { content } ) => {
                    return createBlock( 'kikoiro1/process', {
                        content,
                    } );
                },
            },
        ],
        to: [
            {
                type: 'block',
                blocks: [ 'core/paragraph' ],
                transform: ({ content }) => createBlock('core/paragraph', { content }),
            }
        ],
    },
    edit(props) {
        let content = props.attributes.content;
        let onChangeContent = function( content ) {
            props.setAttributes( { content: content } );
        }
        return ([
            <RichText 
                tagName="p" 
                multiline="false"
                className={ `process ${getClassNameFromProperty(props.attributes, 'className')}`}
                value={ content } 
                onChange={ onChangeContent } />
        ]);
    },
    save(props) {
        return (
            <RichText.Content
                tagName="p" 
                multiline="false"
                className={ `process ${getClassNameFromProperty(props.attributes, 'className')}`}
                value={ props.attributes.content } />
        );
    },
});
