!function(e){var t={};function n(c){if(t[c])return t[c].exports;var r=t[c]={i:c,l:!1,exports:{}};return e[c].call(r.exports,r,r.exports,n),r.l=!0,r.exports}n.m=e,n.c=t,n.d=function(e,t,c){n.o(e,t)||Object.defineProperty(e,t,{enumerable:!0,get:c})},n.r=function(e){"undefined"!=typeof Symbol&&Symbol.toStringTag&&Object.defineProperty(e,Symbol.toStringTag,{value:"Module"}),Object.defineProperty(e,"__esModule",{value:!0})},n.t=function(e,t){if(1&t&&(e=n(e)),8&t)return e;if(4&t&&"object"==typeof e&&e&&e.__esModule)return e;var c=Object.create(null);if(n.r(c),Object.defineProperty(c,"default",{enumerable:!0,value:e}),2&t&&"string"!=typeof e)for(var r in e)n.d(c,r,function(t){return e[t]}.bind(null,r));return c},n.n=function(e){var t=e&&e.__esModule?function(){return e.default}:function(){return e};return n.d(t,"a",t),t},n.o=function(e,t){return Object.prototype.hasOwnProperty.call(e,t)},n.p="",n(n.s=8)}([function(e,t){!function(){e.exports=this.wp.element}()},function(e,t){!function(){e.exports=this.wp.editor}()},function(e,t){!function(){e.exports=this.wp.blocks}()},function(e,t){!function(){e.exports=this.wp.components}()},function(e,t){!function(){e.exports=this.wp.compose}()},function(e,t){!function(){e.exports=this.wp.richText}()},function(e,t){!function(){e.exports=this.wp.blockEditor}()},function(e,t){!function(){e.exports=this.wp.data}()},function(e,t,n){"use strict";n.r(t);var c=n(0),r=n(2),a=n(1);function o(e,t){var n=!(arguments.length>2&&void 0!==arguments[2])||arguments[2]?" ":"";return void 0!==e[t]?n+e[t]:""}Object(r.registerBlockType)("kikoiro1/sub-info",{title:"補足情報",icon:"editor-ul",category:"kikoiro1",example:{},edit:function(e){e.className;return Object(c.createElement)("div",{class:"test2"},Object(c.createElement)(a.InnerBlocks,{allowedBlocks:["core/image","core/paragraph"],template:[["core/paragraph",{placeholder:"title"}],["core/paragraph",{placeholder:"content"}]]}))},save:function(){return Object(c.createElement)("div",null,Object(c.createElement)(a.InnerBlocks.Content,null))}}),Object(r.registerBlockType)("kikoiro1/references",{title:"参考文献",icon:"editor-ol",category:"kikoiro1",attributes:{titleContent:{selector:"h2",type:"string",source:"html",default:"参考文献"},content:{selector:"ol",type:"array",source:"children"}},edit:function(e){var t=e.attributes.content,n=e.attributes.titleContent;return Object(c.createElement)("div",{class:"references"+o(e.attributes,"className")},Object(c.createElement)(a.RichText,{tagName:"h2",value:n,onChange:function(t){e.setAttributes({titleContent:t})}}),Object(c.createElement)(a.RichText,{tagName:"ol",value:t,multiline:"li",onChange:function(t){e.setAttributes({content:t})}}))},save:function(e){return Object(c.createElement)("div",{class:"references"+o(e.attributes,"className")},Object(c.createElement)(a.RichText.Content,{tagName:"h2",value:e.attributes.titleContent}),Object(c.createElement)(a.RichText.Content,{tagName:"ol",value:e.attributes.content}))}}),Object(r.registerBlockType)("kikoiro1/point-list",{title:"ポイントリスト",icon:"editor-ul",category:"kikoiro1",attributes:{titleContent:{selector:"span",type:"string",source:"html",default:"タイトル"}},edit:function(e){var t=e.attributes.titleContent;return Object(c.createElement)("div",{class:"point-list"+o(e.attributes,"className")},Object(c.createElement)("h4",null,Object(c.createElement)(a.RichText,{tagName:"span",value:t,onChange:function(t){e.setAttributes({titleContent:t})}})),Object(c.createElement)(a.InnerBlocks,{allowedBlocks:["core/list","core/paragraph"],template:[["core/list",{}]]}))},save:function(e){return Object(c.createElement)("div",{class:"point-list"+o(e.attributes,"className")},Object(c.createElement)("h4",null,Object(c.createElement)(a.RichText.Content,{tagName:"span",value:e.attributes.titleContent})),Object(c.createElement)(a.InnerBlocks.Content,null))}}),Object(r.registerBlockType)("kikoiro1/interview-q",{title:"インタビュー設問",icon:"microphone",category:"kikoiro1",attributes:{content:{selector:"p",type:"string",source:"html",default:"設問"}},transforms:{from:[{type:"block",blocks:["core/paragraph"],transform:function(e){var t=e.content;return Object(r.createBlock)("kikoiro1/interview-q",{content:t})}}],to:[{type:"block",blocks:["core/paragraph"],transform:function(e){var t=e.content;return Object(r.createBlock)("core/paragraph",{content:t})}}]},edit:function(e){var t=e.attributes.content;return Object(c.createElement)(a.RichText,{tagName:"p",className:"interview_q",value:t,onChange:function(t){e.setAttributes({content:t})}})},save:function(e){return Object(c.createElement)(a.RichText.Content,{tagName:"p",className:"interview_q",value:e.attributes.content})}}),Object(r.registerBlockType)("kikoiro1/interview-a",{title:"インタビュー回答",icon:"microphone",category:"kikoiro1",attributes:{content:{selector:"p",type:"string",source:"html",default:"設問"}},transforms:{from:[{type:"block",blocks:["core/paragraph"],transform:function(e){var t=e.content;return Object(r.createBlock)("kikoiro1/interview-a",{content:t})}}],to:[{type:"block",blocks:["core/paragraph"],transform:function(e){var t=e.content;return Object(r.createBlock)("core/paragraph",{content:t})}}]},edit:function(e){var t=e.attributes.content;return Object(c.createElement)(a.RichText,{tagName:"p",className:"interview_a",value:t,onChange:function(t){e.setAttributes({content:t})}})},save:function(e){return Object(c.createElement)(a.RichText.Content,{tagName:"p",className:"interview_a",value:e.attributes.content})}}),Object(r.registerBlockType)("kikoiro1/interviewee-profile",{title:"インタビュイープロフィール（当事者本人）",icon:"admin-users",category:"kikoiro1",edit:function(e){return Object(c.createElement)("div",{class:"interviewee_profile"+o(e.attributes,"className")},Object(c.createElement)("h4",null,"お話を伺った方のプロフィール"),Object(c.createElement)(a.InnerBlocks,{templateLock:"all",template:[["core/list",{}]]}))},save:function(e){return Object(c.createElement)("div",{class:"interviewee_profile"+o(e.attributes,"className")},Object(c.createElement)("h4",null,"お話を伺った方のプロフィール"),Object(c.createElement)(a.InnerBlocks.Content,null))}}),Object(r.registerBlockType)("kikoiro1/interviewee-profile-f",{title:"インタビュイープロフィール（当事者家族）",icon:"admin-users",category:"kikoiro1",edit:function(e){return Object(c.createElement)("div",{class:"interviewee_profile"+o(e.attributes,"className")},Object(c.createElement)("h4",null,"お話を伺った方のプロフィール"),Object(c.createElement)(a.InnerBlocks,{templateLock:"all",template:[["core/list",{}],["core/paragraph",{placeholder:"誰が当事者か（例：「娘さんのこと」）"}],["core/list",{}]]}))},save:function(e){return Object(c.createElement)("div",{class:"interviewee_profile"+o(e.attributes,"className")},Object(c.createElement)("h4",null,"お話を伺った方のプロフィール"),Object(c.createElement)(a.InnerBlocks.Content,null))}}),Object(r.registerBlockType)("kikoiro1/nextpage",{title:"改ページ",icon:"editor-break",category:"kikoiro1",attributes:{content:{selector:"strong",type:"string",source:"html",default:""}},edit:function(e){var t=e.attributes.content;return Object(c.createElement)("p",{class:"nextpage"+o(e.attributes,"className")},Object(c.createElement)(a.RichText,{tagName:"strong",value:t,onChange:function(t){e.setAttributes({content:t})}}),Object(c.createElement)("span",{dangerouslySetInnerHTML:{__html:"\x3c!--nextpage--\x3e"}}))},save:function(e){return Object(c.createElement)("p",{class:"nextpage"+o(e.attributes,"className")},Object(c.createElement)(a.RichText.Content,{tagName:"strong",value:e.attributes.content}),Object(c.createElement)("span",{dangerouslySetInnerHTML:{__html:"\x3c!--nextpage--\x3e"}}))}}),Object(r.registerBlockType)("kikoiro1/medical-desc",{title:"医学的説明",icon:"editor-table",category:"kikoiro1",attributes:{titleContent:{selector:"h3",type:"string",source:"html"},titleContent2:{selector:"h4",type:"string",source:"html"}},edit:function(e){var t=e.attributes.titleContent,n=e.attributes.titleContent2;return Object(c.createElement)("div",{class:"medical-desc"+o(e.attributes,"className")},Object(c.createElement)(a.RichText,{tagName:"h3",value:t,placeholder:"タイトル",onChange:function(t){e.setAttributes({titleContent:t})}}),Object(c.createElement)(a.RichText,{tagName:"h4",value:n,placeholder:"サブタイトル",onChange:function(t){e.setAttributes({titleContent2:t})}}),Object(c.createElement)(a.InnerBlocks,{allowedBlocks:["kikoiro1/medical-desc-disease","kikoiro1/medical-desc-point"],template:[["kikoiro1/medical-desc-disease",{}]]}))},save:function(e){return Object(c.createElement)("div",{class:"medical-desc"+o(e.attributes,"className")},Object(c.createElement)(a.RichText.Content,{tagName:"h3",value:e.attributes.titleContent}),Object(c.createElement)(a.RichText.Content,{tagName:"h4",value:e.attributes.titleContent2}),Object(c.createElement)(a.InnerBlocks.Content,null))}}),Object(r.registerBlockType)("kikoiro1/medical-desc-disease",{title:"医学的説明-疾患",icon:"editor-table",category:"kikoiro1",parent:["kikoiro1/medical-desc"],attributes:{titleContent:{selector:"h4",type:"string",source:"html"}},edit:function(e){var t=e.attributes.titleContent;return Object(c.createElement)("div",{class:"medical-desc-disease"},Object(c.createElement)(a.RichText,{tagName:"h4",value:t,placeholder:"表題",onChange:function(t){e.setAttributes({titleContent:t})}}),Object(c.createElement)(a.InnerBlocks,{templateLock:"all",template:[["core/table",{}]]}))},save:function(e){return Object(c.createElement)("div",{class:"medical-desc-disease"},Object(c.createElement)(a.RichText.Content,{tagName:"h4",value:e.attributes.titleContent}),Object(c.createElement)(a.InnerBlocks.Content,null))}}),Object(r.registerBlockType)("kikoiro1/medical-desc-point",{title:"医学的説明-ポイント",icon:"editor-ul",category:"kikoiro1",parent:["kikoiro1/medical-desc"],attributes:{titleContent:{selector:"h4",type:"string",source:"html"},content:{selector:"ul",type:"array",source:"children"}},edit:function(e){var t=e.attributes.titleContent,n=e.attributes.content;return Object(c.createElement)("div",{className:"medical-desc-point"},Object(c.createElement)(a.RichText,{tagName:"h4",value:t,placeholder:"タイトル",onChange:function(t){e.setAttributes({titleContent:t})}}),Object(c.createElement)(a.RichText,{tagName:"ul",value:n,multiline:"li",onChange:function(t){e.setAttributes({content:t})}}))},save:function(e){return Object(c.createElement)("div",{className:"medical-desc-point"},Object(c.createElement)(a.RichText.Content,{tagName:"h4",value:e.attributes.titleContent}),Object(c.createElement)(a.RichText.Content,{tagName:"ul",value:e.attributes.content}))}});var i=n(3);Object(r.registerBlockType)("kikoiro1/main-ul",{title:"本文-リスト",icon:"editor-ul",category:"kikoiro1",attributes:{content:{selector:"ul",type:"string",source:"html",multiline:"li",default:""},isWhiteBackground:{type:"boolean",default:!1},isWideVerticalMargin:{type:"boolean",default:!1}},transforms:{from:[{type:"block",blocks:["core/list"],transform:function(e){return console.log(e),Object(r.createBlock)("kikoiro1/main-ul",{content:e.values})}}],to:[{type:"block",blocks:["core/list"],transform:function(e){return console.log(e),Object(r.createBlock)("core/list",{values:e.content,ordered:!1})}}]},edit:function(e){var t=e.attributes.content;return[Object(c.createElement)(a.InspectorControls,null,Object(c.createElement)(i.PanelBody,{title:"設定"},Object(c.createElement)(i.CheckboxControl,{label:"背景色を白にする",checked:e.attributes.isWhiteBackground||!1,onChange:function(t){e.setAttributes({isWhiteBackground:t})}}),Object(c.createElement)(i.CheckboxControl,{label:"行マージン広め",checked:e.attributes.isWideVerticalMargin||!1,onChange:function(t){e.setAttributes({isWideVerticalMargin:t})}}))),Object(c.createElement)(a.RichText,{tagName:"ul",className:"withPadding ".concat(o(e.attributes,"className")," \n                    ").concat(!0===e.attributes.isWhiteBackground?"whiteBackground":""," \n                    ").concat(!0===e.attributes.isWideVerticalMargin?"withItemBottomMarginWide":"withItemBottomMargin"),multiline:"li",value:t,onChange:function(t){e.setAttributes({content:t})}})]},save:function(e){return Object(c.createElement)(a.RichText.Content,{tagName:"ul",className:"withPadding ".concat(o(e.attributes,"className")," \n                    ").concat(!0===e.attributes.isWhiteBackground?"whiteBackground":""," \n                    ").concat(!0===e.attributes.isWideVerticalMargin?"withItemBottomMarginWide":"withItemBottomMargin"),value:e.attributes.content})}}),Object(r.registerBlockType)("kikoiro1/main-ol",{title:"本文-リスト",icon:"editor-ol",category:"kikoiro1",attributes:{content:{selector:"ol",type:"string",source:"html",multiline:"li",default:""},isWhiteBackground:{type:"boolean",default:!1},isWideVerticalMargin:{type:"boolean",default:!1}},transforms:{from:[{type:"block",blocks:["core/list"],transform:function(e){return console.log(e),Object(r.createBlock)("kikoiro1/main-ol",{content:e.values})}}],to:[{type:"block",blocks:["core/list"],transform:function(e){return console.log(e),Object(r.createBlock)("core/list",{values:e.content,ordered:!1})}}]},edit:function(e){var t=e.attributes.content;return[Object(c.createElement)(a.InspectorControls,null,Object(c.createElement)(i.PanelBody,{title:"設定"},Object(c.createElement)(i.CheckboxControl,{label:"背景色を白にする",checked:e.attributes.isWhiteBackground||!1,onChange:function(t){e.setAttributes({isWhiteBackground:t})}}),Object(c.createElement)(i.CheckboxControl,{label:"行マージン広め",checked:e.attributes.isWideVerticalMargin||!1,onChange:function(t){e.setAttributes({isWideVerticalMargin:t})}}))),Object(c.createElement)(a.RichText,{tagName:"ol",className:"withPadding ".concat(o(e.attributes,"className")," \n                    ").concat(!0===e.attributes.isWhiteBackground?"whiteBackground":""," \n                    ").concat(!0===e.attributes.isWideVerticalMargin?"withItemBottomMarginWide":"withItemBottomMargin"),multiline:"li",value:t,onChange:function(t){e.setAttributes({content:t})}})]},save:function(e){return Object(c.createElement)(a.RichText.Content,{tagName:"ol",className:"withPadding ".concat(o(e.attributes,"className")," \n                    ").concat(!0===e.attributes.isWhiteBackground?"whiteBackground":""," \n                    ").concat(!0===e.attributes.isWideVerticalMargin?"withItemBottomMarginWide":"withItemBottomMargin"),value:e.attributes.content})}}),Object(r.registerBlockType)("kikoiro1/h3",{title:"見出し（H3）",icon:"editor-textcolor",category:"kikoiro1",attributes:{content:{selector:"h3",type:"string",source:"html",default:""},headingStyle:{type:"string",default:"normal"}},transforms:{from:[{type:"block",blocks:["core/heading","kikoiro1/h4"],transform:function(e){var t=e.content;return Object(r.createBlock)("kikoiro1/h3",{content:t})}}],to:[{type:"block",blocks:["core/heading"],transform:function(e){var t=e.content;return Object(r.createBlock)("core/heading",{content:t,level:3})}},{type:"block",blocks:["kikoiro1/h4"],transform:function(e){var t=e.content;return Object(r.createBlock)("kikoiro1/h4",{content:t})}}]},edit:function(e){var t=e.attributes.content;return[Object(c.createElement)(a.InspectorControls,null,Object(c.createElement)(i.PanelBody,{title:"設定"},Object(c.createElement)(i.RadioControl,{label:"スタイル",help:"",selected:e.attributes.headingStyle||"normal",options:[{label:"ノーマル",value:"normal"},{label:"下線付き",value:"underline"},{label:"●付き",value:"dot"}],onChange:function(t){e.setAttributes({headingStyle:t})}}))),Object(c.createElement)(a.RichText,{tagName:"h3",multiline:"false",className:"".concat(e.attributes.headingStyle," ").concat(o(e.attributes,"className")),value:t,onChange:function(t){e.setAttributes({content:t})}})]},save:function(e){return Object(c.createElement)(a.RichText.Content,{tagName:"h3",multiline:"false",className:"".concat(e.attributes.headingStyle," ").concat(o(e.attributes,"className")),value:e.attributes.content})}}),Object(r.registerBlockType)("kikoiro1/h4",{title:"見出し（H4）",icon:"editor-textcolor",category:"kikoiro1",attributes:{content:{selector:"h4",type:"string",source:"html",default:""},headingStyle:{type:"string",default:"normal"}},transforms:{from:[{type:"block",blocks:["core/heading"],transform:function(e){var t=e.content;return Object(r.createBlock)("kikoiro1/h4",{content:t})}}],to:[{type:"block",blocks:["core/heading"],transform:function(e){var t=e.content;return Object(r.createBlock)("core/heading",{content:t,level:4})}}]},edit:function(e){var t=e.attributes.content;return[Object(c.createElement)(a.InspectorControls,null,Object(c.createElement)(i.PanelBody,{title:"設定"},Object(c.createElement)(i.RadioControl,{label:"スタイル",help:"",selected:e.attributes.headingStyle||"normal",options:[{label:"ノーマル",value:"normal"},{label:"下線付き",value:"underline"},{label:"●付き",value:"dot"}],onChange:function(t){e.setAttributes({headingStyle:t})}}))),Object(c.createElement)(a.RichText,{tagName:"h4",multiline:"false",className:"".concat(e.attributes.headingStyle," ").concat(o(e.attributes,"className")),value:t,onChange:function(t){e.setAttributes({content:t})}})]},save:function(e){return Object(c.createElement)(a.RichText.Content,{tagName:"h4",multiline:"false",className:"".concat(e.attributes.headingStyle," ").concat(o(e.attributes,"className")),value:e.attributes.content})}}),Object(r.registerBlockType)("kikoiro1/faq-item",{title:"FAQアイテム",icon:"editor-help",category:"kikoiro1",attributes:{titleContent:{selector:"span",type:"string",source:"html",default:""}},edit:function(e){var t=e.attributes.titleContent;return Object(c.createElement)("div",{class:"faqItem"+o(e.attributes,"className")},Object(c.createElement)("h2",null,Object(c.createElement)(a.RichText,{tagName:"span",value:t,placeholder:"質問タイトル",onChange:function(t){e.setAttributes({titleContent:t})}})),Object(c.createElement)(a.InnerBlocks,{allowedBlocks:["core/paragraph"],template:[["core/paragraph",{}]]}))},save:function(e){return Object(c.createElement)("div",{class:"faqItem"+o(e.attributes,"className")},Object(c.createElement)("h2",null,Object(c.createElement)(a.RichText.Content,{tagName:"span",value:e.attributes.titleContent})),Object(c.createElement)(a.InnerBlocks.Content,null))}});var l=n(4),s=n(6),u=n(7),b=n(5),m=Object(l.compose)(Object(u.withSelect)((function(e){return{selectedBlock:e("core/editor").getSelectedBlock()}})),Object(l.ifCondition)((function(e){return e.selectedBlock&&"core/heading"!==e.selectedBlock.name})))((function(e){return Object(c.createElement)(s.RichTextToolbarButton,{icon:"admin-appearance",title:"マーカー",onClick:function(){e.onChange(Object(b.toggleFormat)(e.value,{type:"kikoiro1/marker"}))},isActive:e.isActive})}));Object(b.registerFormatType)("kikoiro1/marker",{title:"マーカー",tagName:"span",className:"emphasize",edit:m}),Object(r.registerBlockType)("kikoiro1/separator",{title:"仕切り線",icon:"minus",category:"kikoiro1",attributes:{isFullWidth:{type:"boolean",default:!1}},edit:function(e){return[Object(c.createElement)(a.InspectorControls,null,Object(c.createElement)(i.PanelBody,{title:"設定"},Object(c.createElement)(i.CheckboxControl,{label:"コンテンツ幅に合わせる",checked:e.attributes.isFullWidth||!1,onChange:function(t){e.setAttributes({isFullWidth:t})}}))),Object(c.createElement)("hr",{className:"contentSeparator ".concat(o(e.attributes,"className")," ").concat(!0===e.attributes.isFullWidth?"fullWidth":"")})]},save:function(e){return Object(c.createElement)("hr",{className:"contentSeparator ".concat(o(e.attributes,"className")," ").concat(!0===e.attributes.isFullWidth?"fullWidth":"")})}}),Object(r.registerBlockType)("kikoiro1/p",{title:"本文段落",icon:"editor-paragraph",category:"kikoiro1",attributes:{content:{selector:"p",type:"string",source:"html",default:""},id:{type:"string",default:""},useAsAnchor:{type:"boolean",default:!1}},transforms:{from:[{type:"block",blocks:["core/paragraph"],transform:function(e){var t=e.content;return Object(r.createBlock)("kikoiro1/p",{content:t})}}],to:[{type:"block",blocks:["core/paragraph"],transform:function(e){var t=e.content;return Object(r.createBlock)("core/paragraph",{content:t})}}]},edit:function(e){var t=e.attributes.content;return[Object(c.createElement)(a.InspectorControls,null,Object(c.createElement)(i.PanelBody,{title:"設定"},Object(c.createElement)(i.TextControl,{label:"ID",value:e.attributes.id,onChange:function(t){e.setAttributes({id:t})}}),Object(c.createElement)(i.CheckboxControl,{label:"アンカーとして使用",checked:e.attributes.useAsAnchor||!1,onChange:function(t){e.setAttributes({useAsAnchor:t})}}))),Object(c.createElement)(a.RichText,{tagName:"p",multiline:"false",id:"".concat(e.attributes.id),className:"".concat(!0===e.attributes.useAsAnchor?"anchorLink":""," ").concat(o(e.attributes,"className")),value:t,onChange:function(t){e.setAttributes({content:t})}})]},save:function(e){return Object(c.createElement)(a.RichText.Content,{tagName:"p",multiline:"false",id:"".concat(e.attributes.id),className:"".concat(!0===e.attributes.useAsAnchor?"anchorLink":""," ").concat(o(e.attributes,"className")),value:e.attributes.content})}}),Object(r.registerBlockType)("kikoiro1/annotation",{title:"注釈",icon:"editor-ul",category:"kikoiro1",attributes:{content:{selector:"ul",type:"array",source:"children"}},edit:function(e){var t=e.attributes.content;return Object(c.createElement)("div",{class:"annotation"+o(e.attributes,"className")},Object(c.createElement)("hr",{class:"contentSeparator fullWidth"}),Object(c.createElement)(a.RichText,{tagName:"ul",multiline:"li",value:t,onChange:function(t){e.setAttributes({content:t})}}))},save:function(e){return Object(c.createElement)("div",{class:"annotation"+o(e.attributes,"className")},Object(c.createElement)("hr",{class:"contentSeparator fullWidth"}),Object(c.createElement)(a.RichText.Content,{tagName:"ul",value:e.attributes.content}))}}),Object(r.registerBlockType)("kikoiro1/process",{title:"本文-手順",icon:"editor-ol",category:"kikoiro1",attributes:{content:{selector:"p",type:"string",source:"html",default:""}},transforms:{from:[{type:"block",blocks:["core/paragraph"],transform:function(e){var t=e.content;return Object(r.createBlock)("kikoiro1/process",{content:t})}}],to:[{type:"block",blocks:["core/paragraph"],transform:function(e){var t=e.content;return Object(r.createBlock)("core/paragraph",{content:t})}}]},edit:function(e){var t=e.attributes.content;return[Object(c.createElement)(a.RichText,{tagName:"p",className:"process ".concat(o(e.attributes,"className")),value:t,onChange:function(t){e.setAttributes({content:t})}})]},save:function(e){return Object(c.createElement)(a.RichText.Content,{tagName:"p",className:"process ".concat(o(e.attributes,"className")),value:e.attributes.content})}}),Object(r.registerBlockType)("kikoiro1/detail-button",{title:"ボタン（別ページへ移動）",icon:"arrow-right-alt",category:"kikoiro1",attributes:{content:{selector:"p",type:"string",source:"html",default:""}},transforms:{from:[{type:"block",blocks:["core/paragraph"],transform:function(e){var t=e.content;return Object(r.createBlock)("kikoiro1/detail-button",{content:t})}}],to:[{type:"block",blocks:["core/paragraph"],transform:function(e){var t=e.content;return Object(r.createBlock)("core/paragraph",{content:t})}}]},edit:function(e){var t=e.attributes.content;return Object(c.createElement)(a.RichText,{tagName:"p",multiline:"false",className:"readMore ".concat(o(e.attributes,"className")),value:t,onChange:function(t){e.setAttributes({content:t})}})},save:function(e){return Object(c.createElement)(a.RichText.Content,{tagName:"p",multiline:"false",className:"readMore ".concat(o(e.attributes,"className")),value:e.attributes.content})}}),Object(r.registerBlockType)("kikoiro1/sources",{title:"出典",icon:"editor-ul",category:"kikoiro1",attributes:{titleContent:{selector:"h2",type:"string",source:"html",default:"出典"},content:{selector:"ul",type:"array",source:"children"}},edit:function(e){var t=e.attributes.content,n=e.attributes.titleContent;return Object(c.createElement)("div",{class:"references"+o(e.attributes,"className")},Object(c.createElement)(a.RichText,{tagName:"h2",value:n,onChange:function(t){e.setAttributes({titleContent:t})}}),Object(c.createElement)(a.RichText,{tagName:"ul",value:t,multiline:"li",onChange:function(t){e.setAttributes({content:t})}}))},save:function(e){return Object(c.createElement)("div",{class:"references"+o(e.attributes,"className")},Object(c.createElement)(a.RichText.Content,{tagName:"h2",value:e.attributes.titleContent}),Object(c.createElement)(a.RichText.Content,{tagName:"ul",value:e.attributes.content}))}}),Object(r.registerBlockType)("kikoiro1/interviewee-profile",{title:"インタビュイープロフィール（当事者本人）",icon:"admin-users",category:"kikoiro1",edit:function(e){return Object(c.createElement)("div",{class:"interviewee_profile"+o(e.attributes,"className")},Object(c.createElement)("h4",null,"お話を伺った方のプロフィール"),Object(c.createElement)(a.InnerBlocks,{templateLock:"all",template:[["core/list",{}]]}))},save:function(e){return Object(c.createElement)("div",{class:"interviewee_profile"+o(e.attributes,"className")},Object(c.createElement)("h4",null,"お話を伺った方のプロフィール"),Object(c.createElement)(a.InnerBlocks.Content,null))}})}]);