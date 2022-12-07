!function(){"use strict";var e,o={557:function(e,o,r){var l=window.wp.blocks,t=window.wp.i18n,c=JSON.parse('{"$schema":"https://json.schemastore.org/block.json","apiVersion":2,"name":"wp-oer-plugin/wp-oer-resource-block","version":"0.1.0","title":"OER Resource Block","category":"oer-block-category","keywords":["OER","resource"],"icon":{"foreground":"#121212","src":"media-document"},"description":"This block displays a single resource on a page.","attributes":{"resources":{"type":"object"},"selectedResource":{"type":"number"},"alignment":{"type":"string"},"blockWidth":{"type":"string"},"showThumbnail":{"type":"boolean","default":false},"showTitle":{"type":"boolean","default":false},"showDescription":{"type":"boolean","default":false},"showSubjects":{"type":"boolean","default":false},"showGrades":{"type":"boolean","default":false},"withBorder":{"type":"boolean","default":false},"blockId":{"type":"string"},"firstLoad":{"type":"boolean","default":true},"isChanged":{"type":"boolean","default":false}},"supports":{"html":false},"textdomain":"wp-oer-resource-block","editorScript":"file:./build/index.js","editorStyle":"file:./build/index.css","style":"file:./build/style-index.css"}'),n=window.wp.element,s=window.wp.blockEditor,a=window.wp.components,u=window.jQuery,i=r.n(u);(0,l.registerBlockType)(c,{edit:function(e){var o=(0,t.__)("Loading...","wp-oer-resource-block"),r=[{label:(0,t.__)("Select a resource","wp-oer-resource-block"),value:""}];const{attributes:l,setAttributes:c,className:u,clientId:b}=e,p=[{label:(0,t.__)("Select Alignment","wp-oer-resource-block"),value:""},{label:(0,t.__)("Left","wp-oer-resource-block"),value:"left"},{label:(0,t.__)("Center","wp-oer-resource-block"),value:"center"},{label:(0,t.__)("Right","wp-oer-resource-block"),value:"right"}];if(void 0!==l.resources){l.resources.length>0&&(o=(0,t.__)("There are ","wp-oer-resource-block")+l.resources.length+(0,t.__)(" resources to choose from. Please select one.","wp-oer-resource-block"));let e=l.resources.map((e=>({label:e.title,value:e.id})));r=r.concat(e)}else wp.apiFetch({url:oer_resource.home_url+"/wp-json/oer-resource-block/v1/resources"}).then((e=>{c({resources:e})}));return b!==l.blockId&&c({blockId:b}),void 0!==l.selectedResource&&(h=l,d=l.blockId,w={action:"oer_display_resource_block",params:h},i().ajax({url:oer_resource.ajaxurl,type:"POST",data:w,success:function(e){i()("#block-"+d+" .wp-block-wp-oer-plugin-wp-oer-resource-block").html(""),i()("#block-"+d+" .wp-block-wp-oer-plugin-wp-oer-resource-block").html(e)},error:function(e,o,r){console.log(r)}})),[(0,n.createElement)(n.Fragment,null,(0,n.createElement)(s.InspectorControls,{className:u},(0,n.createElement)(a.PanelBody,{title:(0,t.__)("OER Resource Options","wp-oer-resource-block"),initialOpen:!0},(0,n.createElement)(a.PanelRow,null,(0,n.createElement)(a.SelectControl,{className:"oer-resource-block-resource-field",label:(0,t.__)("Resource","wp-oer-resource-block"),value:l.selectedResource,options:r,onChange:e=>{c({selectedResource:parseInt(e),isChanged:!0})}})),(0,n.createElement)(a.PanelRow,null,(0,n.createElement)(a.SelectControl,{className:"oer-resource-block-alignment-field",label:(0,t.__)("Alignment","wp-oer-resource-block"),value:l.alignment,options:p,onChange:e=>{c({alignment:e,isChanged:!0})}})),(0,n.createElement)(a.PanelRow,null,(0,n.createElement)(a.TextControl,{className:"oer-resource-block-width-field",label:(0,t.__)("Width in pixels(optional)","wp-oer-resource-block"),value:l.blockWidth,onChange:e=>{c({blockWidth:e,isChanged:!0})}})),(0,n.createElement)(a.PanelRow,null,(0,n.createElement)(a.CheckboxControl,{className:"oer-resource-block-show-thumbnail",label:(0,t.__)("Show thumbnail","wp-oer-resource-block"),checked:l.showThumbnail,onChange:e=>{c({showThumbnail:e,isChanged:!0})}})),(0,n.createElement)(a.PanelRow,null,(0,n.createElement)(a.CheckboxControl,{className:"oer-resource-block-show-title",label:(0,t.__)("Show title","wp-oer-resource-block"),checked:l.showTitle,onChange:e=>{c({showTitle:e,isChanged:!0})}})),(0,n.createElement)(a.PanelRow,null,(0,n.createElement)(a.CheckboxControl,{className:"oer-resource-block-show-description",label:(0,t.__)("Show description","wp-oer-resource-block"),checked:l.showDescription,onChange:e=>{c({showDescription:e,isChanged:!0})}})),(0,n.createElement)(a.PanelRow,null,(0,n.createElement)(a.CheckboxControl,{className:"oer-resource-block-show-subjects",label:(0,t.__)("Show subjects","wp-oer-resource-block"),checked:l.showSubjects,onChange:e=>{c({showSubjects:e,isChanged:!0})}})),(0,n.createElement)(a.PanelRow,null,(0,n.createElement)(a.CheckboxControl,{className:"oer-resource-block-show-grade-levels",label:(0,t.__)("Show grade levels","wp-oer-resource-block"),checked:l.showGrades,onChange:e=>{c({showGrades:e,isChanged:!0})}})),(0,n.createElement)(a.PanelRow,null,(0,n.createElement)(a.CheckboxControl,{className:"oer-resource-block-show-with-border",label:(0,t.__)("Show block with border","wp-oer-resource-block"),checked:l.withBorder,onChange:e=>{c({withBorder:e,isChanged:!0})}}))))),(0,n.createElement)("div",(0,s.useBlockProps)(),(0,n.createElement)("div",{className:"wp-block-wp-oer-plugin-wp-oer-resource-block"},o))];var h,d,w}})}},r={};function l(e){var t=r[e];if(void 0!==t)return t.exports;var c=r[e]={exports:{}};return o[e](c,c.exports,l),c.exports}l.m=o,e=[],l.O=function(o,r,t,c){if(!r){var n=1/0;for(i=0;i<e.length;i++){r=e[i][0],t=e[i][1],c=e[i][2];for(var s=!0,a=0;a<r.length;a++)(!1&c||n>=c)&&Object.keys(l.O).every((function(e){return l.O[e](r[a])}))?r.splice(a--,1):(s=!1,c<n&&(n=c));if(s){e.splice(i--,1);var u=t();void 0!==u&&(o=u)}}return o}c=c||0;for(var i=e.length;i>0&&e[i-1][2]>c;i--)e[i]=e[i-1];e[i]=[r,t,c]},l.n=function(e){var o=e&&e.__esModule?function(){return e.default}:function(){return e};return l.d(o,{a:o}),o},l.d=function(e,o){for(var r in o)l.o(o,r)&&!l.o(e,r)&&Object.defineProperty(e,r,{enumerable:!0,get:o[r]})},l.o=function(e,o){return Object.prototype.hasOwnProperty.call(e,o)},function(){var e={826:0,46:0};l.O.j=function(o){return 0===e[o]};var o=function(o,r){var t,c,n=r[0],s=r[1],a=r[2],u=0;if(n.some((function(o){return 0!==e[o]}))){for(t in s)l.o(s,t)&&(l.m[t]=s[t]);if(a)var i=a(l)}for(o&&o(r);u<n.length;u++)c=n[u],l.o(e,c)&&e[c]&&e[c][0](),e[n[u]]=0;return l.O(i)},r=self.webpackChunkwp_oer_resource_block=self.webpackChunkwp_oer_resource_block||[];r.forEach(o.bind(null,0)),r.push=o.bind(null,r.push.bind(r))}();var t=l.O(void 0,[46],(function(){return l(557)}));t=l.O(t)}();