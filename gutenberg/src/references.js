import { registerBlockType } from '@wordpress/blocks';
//import { getBlockDefaultClassName } from '@wordpress/blocks';
import { InnerBlocks } from '@wordpress/editor';
import { RichText } from '@wordpress/editor';
import { getClassNameFromProperty } from './tools.js';

//const className = getBlockDefaultClassName( 'kikoiro1/references' );

registerBlockType( 'kikoiro1/references', {
    title: '参考文献',
    icon: 'universal-access-alt',
    category: 'common',
    attributes: {
        titleContent: {
            selector: 'h2',
            type: 'string',
            source: 'html',
            default: "参考文献"
        },
        content: {
            selector: 'ol',
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
        //you can reetrieve additional class name inputted in sidebar form props.attributes.className
        return (
            <div class={"references" + getClassNameFromProperty(props.attributes, "className") }>
            <RichText 
                tagName="h2"
                className="a"
                value={ titleContent } 
                onChange={ onChangeTitleContent } />
            <RichText
                tagName="ol"
                className="references"
                value={ content }
                multiline="li"
                onChange={ onChangeContent } />
            </div>
        );
    },
    save(props) {
        return (
            <div class={ "references" + getClassNameFromProperty(props.attributes, "className") }>
            <RichText.Content
                tagName="h2"
                value={ props.attributes.titleContent } />
            <RichText.Content
                tagName="ol"
                value={ props.attributes.content } />
            </div>
        );
    },
});
