!function(e){var t={};function n(r){if(t[r])return t[r].exports;var c=t[r]={i:r,l:!1,exports:{}};return e[r].call(c.exports,c,c.exports,n),c.l=!0,c.exports}n.m=e,n.c=t,n.d=function(e,t,r){n.o(e,t)||Object.defineProperty(e,t,{enumerable:!0,get:r})},n.r=function(e){"undefined"!=typeof Symbol&&Symbol.toStringTag&&Object.defineProperty(e,Symbol.toStringTag,{value:"Module"}),Object.defineProperty(e,"__esModule",{value:!0})},n.t=function(e,t){if(1&t&&(e=n(e)),8&t)return e;if(4&t&&"object"==typeof e&&e&&e.__esModule)return e;var r=Object.create(null);if(n.r(r),Object.defineProperty(r,"default",{enumerable:!0,value:e}),2&t&&"string"!=typeof e)for(var c in e)n.d(r,c,function(t){return e[t]}.bind(null,c));return r},n.n=function(e){var t=e&&e.__esModule?function(){return e.default}:function(){return e};return n.d(t,"a",t),t},n.o=function(e,t){return Object.prototype.hasOwnProperty.call(e,t)},n.p="",n(n.s=3)}([function(e,t){!function(){e.exports=this.wp.element}()},function(e,t){!function(){e.exports=this.wp.editor}()},function(e,t){!function(){e.exports=this.wp.blocks}()},function(e,t,n){"use strict";n.r(t);var r=n(0),c=n(2),a={backgroundColor:"#900",color:"#fff",padding:"20px"};Object(c.registerBlockType)("kikoiro1/test",{title:"Example",icon:"universal-access-alt",category:"kikoiro1",example:{},edit:function(){return Object(r.createElement)("div",{class:"test"},"AAA!")},save:function(){return Object(r.createElement)("div",{style:a},"BBB!")}});var i=n(1);function o(e,t){var n=!(arguments.length>2&&void 0!==arguments[2])||arguments[2]?" ":"";return void 0!==e[t]?n+e[t]:""}Object(c.registerBlockType)("kikoiro1/sub-info",{title:"補足情報",icon:"universal-access-alt",category:"kikoiro1",example:{},edit:function(e){e.className;return Object(r.createElement)("div",{class:"test2"},Object(r.createElement)(i.InnerBlocks,{allowedBlocks:["core/image","core/paragraph"],template:[["core/paragraph",{placeholder:"title"}],["core/paragraph",{placeholder:"content"}]]}))},save:function(){return Object(r.createElement)("div",null,Object(r.createElement)(i.InnerBlocks.Content,null))}}),Object(c.registerBlockType)("kikoiro1/references",{title:"参考文献",icon:"universal-access-alt",category:"kikoiro1",attributes:{titleContent:{selector:"h2",type:"string",source:"html",default:"参考文献"},content:{selector:"ol",type:"array",source:"children"}},edit:function(e){var t=e.attributes.content,n=e.attributes.titleContent;return Object(r.createElement)("div",{class:"references"+o(e.attributes,"className")},Object(r.createElement)(i.RichText,{tagName:"h2",className:"a",value:n,onChange:function(t){e.setAttributes({titleContent:t})}}),Object(r.createElement)(i.RichText,{tagName:"ol",className:"references",value:t,multiline:"li",onChange:function(t){e.setAttributes({content:t})}}))},save:function(e){return Object(r.createElement)("div",{class:"references"+o(e.attributes,"className")},Object(r.createElement)(i.RichText.Content,{tagName:"h2",value:e.attributes.titleContent}),Object(r.createElement)(i.RichText.Content,{tagName:"ol",value:e.attributes.content}))}}),Object(c.registerBlockType)("kikoiro1/point-list",{title:"ポイントリスト",icon:"universal-access-alt",category:"kikoiro1",attributes:{titleContent:{selector:"span",type:"string",source:"html",default:"タイトル"},content:{selector:"ul",type:"array",source:"children"}},edit:function(e){var t=e.attributes.content,n=e.attributes.titleContent;return Object(r.createElement)("div",{class:"point-list"+o(e.attributes,"className")},Object(r.createElement)("h4",null,Object(r.createElement)(i.RichText,{tagName:"span",value:n,onChange:function(t){e.setAttributes({titleContent:t})}})),Object(r.createElement)(i.RichText,{tagName:"ul",value:t,multiline:"li",onChange:function(t){e.setAttributes({content:t})}}))},save:function(e){return Object(r.createElement)("div",{class:"point-list"+o(e.attributes,"className")},Object(r.createElement)("h4",null,Object(r.createElement)(i.RichText.Content,{tagName:"span",value:e.attributes.titleContent})),Object(r.createElement)(i.RichText.Content,{tagName:"ul",value:e.attributes.content}))}})}]);