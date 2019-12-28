import { createBlock } from '@wordpress/blocks';
import { registerBlockType } from '@wordpress/blocks';
import { RichText } from '@wordpress/editor';
import { getClassNameFromProperty } from './tools.js';

registerBlockType( 'kikoiro1/h3-underline', {
    title: 'H3（中見出し）',
    icon: 'editor-textcolor',
    category: 'kikoiro1',
    attributes: {
        content: {
            selector: 'h3',
            type: 'string',
            source: 'html',
            default: ''
        },
    },
    transforms: {
        from: [
            {
                type: 'block',
                blocks: [ 'core/heading' ],
                transform: ( { content } ) => {
                    return createBlock( 'kikoiro1/h3-underline', {
                        content,
                    } );
                },
            },
        ],
        to: [
            {
                type: 'block',
                blocks: [ 'core/heading' ],
                transform: ({ content }) => createBlock('core/heading', { content: content, level: 3 }),
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
                tagName="h3" 
                multiline="false"
                className={ `withUnderline noBottomMargin ${getClassNameFromProperty(props.attributes, 'className')}` }
                value={ content } 
                onChange={ onChangeContent } />
        );
    },
    save(props) {
        return (
            <RichText.Content
                tagName="h3" 
                multiline="false"
                className={ `withUnderline noBottomMargin ${getClassNameFromProperty(props.attributes, 'className')}` }
                value={ props.attributes.content } />
        );
    },
});
