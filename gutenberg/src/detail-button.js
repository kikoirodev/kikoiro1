import { registerBlockType } from '@wordpress/blocks';
import { RichText } from '@wordpress/editor';
import { createBlock } from '@wordpress/blocks';
import { getClassNameFromProperty } from './tools.js';

registerBlockType( 'kikoiro1/detail-button', {
    title: 'ボタン（別ページへ移動）',
    icon: 'arrow-right-alt',
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
                    return createBlock( 'kikoiro1/detail-button', {
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
        return (
            <RichText 
                tagName="p" 
                multiline="false"
                className={ `readMore ${getClassNameFromProperty(props.attributes, 'className')}`}
                value={ content } 
                onChange={ onChangeContent } />
        );
    },
    save(props) {
        return (
            <RichText.Content
                tagName="p" 
                multiline="false"
                className={ `readMore ${getClassNameFromProperty(props.attributes, 'className')}`}
                value={ props.attributes.content } />
        );
    },
});
