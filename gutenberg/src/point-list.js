import { registerBlockType } from '@wordpress/blocks';
import { RichText } from '@wordpress/editor';
import { getClassNameFromProperty } from './tools.js';

registerBlockType( 'kikoiro1/point-list', {
    title: 'ポイントリスト',
    icon: 'editor-ul',
    category: 'kikoiro1',
    attributes: {
        titleContent: {
            selector: 'span',
            type: 'string',
            source: 'html',
            default: "タイトル"
        }
    },
    edit(props) {
        let titleContent = props.attributes.titleContent;
        let onChangeTitleContent = function( content ) {
            props.setAttributes( { titleContent: content } );
        }
        return (
            <div class={ "point-list" + getClassNameFromProperty(props.attributes, "className") }>
            <h4>
            <RichText 
                tagName="span"
                value={ titleContent } 
                onChange={ onChangeTitleContent } />
            </h4>
            <InnerBlocks allowedBlocks={ [ 'core/list', 'core/paragraph' ] }
                                template={[
                                    [ 'core/list', {} ] 
                                ]} />
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
            <InnerBlocks.Content />
            </div>
        );
    },
});
