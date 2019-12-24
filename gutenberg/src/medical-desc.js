import { registerBlockType } from '@wordpress/blocks';
import { RichText } from '@wordpress/editor';
import { InnerBlocks } from '@wordpress/editor';
import { getClassNameFromProperty } from './tools.js';

registerBlockType( 'kikoiro1/medical-desc', {
    title: '医学的説明',
    icon: 'editor-table',
    category: 'kikoiro1',
    attributes: {
        titleContent: {
            selector: 'h3',
            type: 'string',
            source: 'html',
        },
        titleContent2: {
            selector: 'h4',
            type: 'string',
            source: 'html',
        },
    },
    edit(props) {
        let titleContent = props.attributes.titleContent;
        let titleContent2 = props.attributes.titleContent2;
        let onChangeTitleContent = function( content ) {
            props.setAttributes( { titleContent: content } );
        }
        let onChangeTitleContent2 = function( content ) {
            props.setAttributes( { titleContent2: content } );
        }
        return (
            <div class={ "medical-desc" + getClassNameFromProperty(props.attributes, "className") }>
                <RichText 
                    tagName="h3"
                    value={ titleContent } 
                    placeholder='タイトル' 
                    onChange={ onChangeTitleContent } />
                <RichText 
                    tagName="h4"
                    value={ titleContent2 } 
                    placeholder='サブタイトル' 
                    onChange={ onChangeTitleContent2 } />
                <InnerBlocks allowedBlocks={ [ 'kikoiro1/medical-desc-disease', 
                                                'kikoiro1/medical-desc-point' ] }
                                template={[
                                    [ 'kikoiro1/medical-desc-disease', {} ] 
                                ]}
                />
            </div>
        );
    },
    save(props) {
        return (
            <div class={ "medical-desc" + getClassNameFromProperty(props.attributes, "className") }>
                <RichText.Content
                    tagName="h3"
                    value={ props.attributes.titleContent } />
                <RichText.Content
                    tagName="h4"
                    value={ props.attributes.titleContent2 } />
                <InnerBlocks.Content />
            </div>
        );
    },
});
//

registerBlockType( 'kikoiro1/medical-desc-disease', {
    title: '医学的説明-疾患',
    icon: 'editor-table',
    category: 'kikoiro1',
    parent: [ 'kikoiro1/medical-desc' ],
    attributes: {
        titleContent: {
            selector: 'h4',
            type: 'string',
            source: 'html',
        },
    },
    edit(props) {
        let titleContent = props.attributes.titleContent;
        let onChangeTitleContent = function( content ) {
            props.setAttributes( { titleContent: content } );
        }
        return (
            <div class="medical-desc-disease">
                <RichText 
                    tagName="h4"
                    value={ titleContent } 
                    placeholder='表題' 
                    onChange={ onChangeTitleContent } />
                <InnerBlocks 
                                templateLock='all' 
                                template={[
                                    [ 'core/table', {} ]
                                ]}
                />
            </div>
        );
    },
    save(props) {
        return (
            <div class="medical-desc-disease">
                <RichText.Content
                    tagName="h4"
                    value={ props.attributes.titleContent } />
                <InnerBlocks.Content />
            </div>
        );
    },
});

registerBlockType( 'kikoiro1/medical-desc-point', {
    title: '医学的説明-ポイント',
    icon: 'editor-ul',
    category: 'kikoiro1',
    parent: [ 'kikoiro1/medical-desc' ],
    attributes: {
        titleContent: {
            selector: 'h4',
            type: 'string',
            source: 'html'
        },
        content: {
            selector: 'ul',
            type: 'array',
            source: 'children'
        },
    },
    edit(props) {
        let titleContent = props.attributes.titleContent;
        let content = props.attributes.content;
        let onChangeTitleContent = function( content ) {
            props.setAttributes( { titleContent: content } );
        }
        let onChangeContent = function( content ) {
            props.setAttributes( { content: content } );
        }
        return (
            <div className={ "medical-desc-point" }>
                <RichText 
                    tagName="h4"
                    value={ titleContent } 
                    placeholder='タイトル' 
                    onChange={ onChangeTitleContent } />
                <RichText
                    tagName="ul"
                    value={ content }
                    multiline="li"
                    onChange={ onChangeContent } />
            </div>
        );
    },
    save(props) {
        return (
            <div className={ "medical-desc-point" }>
                <RichText.Content
                    tagName="h4"
                    value={ props.attributes.titleContent } />
                <RichText.Content
                    tagName="ul"
                    value={ props.attributes.content } />
            </div>
        );
    },
});
