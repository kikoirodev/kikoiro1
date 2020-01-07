import { registerBlockType } from '@wordpress/blocks';
import { InnerBlocks } from '@wordpress/editor';
import { getClassNameFromProperty } from './tools.js';

registerBlockType( 'kikoiro1/author-profile', {
    title: '序文（著者紹介）',
    icon: 'admin-users',
    category: 'kikoiro1',
    edit(props) {
        return (
            <div class={"interviewee_profile" + getClassNameFromProperty(props.attributes, "className") }>
                <InnerBlocks 
                            allowedBlocks={ [ 'core/paragraph' ] } 
                            templateLock='' 
                            template={[
                                [ 'core/paragraph', {} ] 
                            ]}
                />
            </div>
        );
    },
    save(props) {
        return (
            <div class={"interviewee_profile" + getClassNameFromProperty(props.attributes, "className") }>
                <InnerBlocks.Content />
            </div>
        );
    },
} );
