import { registerBlockType } from '@wordpress/blocks';
import { RichText } from '@wordpress/editor';
import { getClassNameFromProperty } from './tools.js';

registerBlockType( 'kikoiro1/point-list', {
    title: 'ポイントリスト',
    icon: 'universal-access-alt',
    category: 'layout',
    attributes: {
        titleContent: {
            selector: 'span',
            type: 'string',
            source: 'html',
            default: "タイトル"
        },
        content: {
            selector: 'ul',
            type: 'array',
            source: 'children'
        },
    },
    edit(props) {
        let content = props.attributes.content;
        let titleContent = props.attributes.titleContent;
        let onChangeTitleContent = function( content ) {
            props.setAttributes( { titleContent: content } );
        }
        let onChangeContent = function( content ) {
            props.setAttributes( { content: content } );
        }
        return (
            <div class={ "point-list" + getClassNameFromProperty(props.attributes, "className") }>
            <h4>
            <RichText 
                tagName="span"
                value={ titleContent } 
                onChange={ onChangeTitleContent } />
            </h4>
            <RichText
                tagName="ul"
                value={content}
                multiline="li"
                onChange={ onChangeContent } />
            </div>
        );
    },
    save(props) {
        return (
            <div class={ "point-list" + getClassNameFromProperty(props.attributes, "className") }>
            <h4>
            <RichText.Content
                tagName="span"
                value={ props.attributes.titleContent } />
            </h4>
            <RichText.Content
                tagName="ul"
                value={ props.attributes.content } />
            </div>
        );
    },
});
