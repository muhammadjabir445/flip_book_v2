(window.webpackJsonp=window.webpackJsonp||[]).push([[15],{185:function(t,e,a){var n=a(187);"string"==typeof n&&(n=[[t.i,n,""]]);var r={hmr:!0,transform:void 0,insertInto:void 0};a(12)(n,r);n.locals&&(t.exports=n.locals)},186:function(t,e,a){"use strict";var n=a(185);a.n(n).a},187:function(t,e,a){(t.exports=a(11)(!1)).push([t.i,"\n.v-progress-circular[data-v-de464190]{\n  \tmargin: 1rem;\n  \tmargin-top:170px !important;\n}\n/* .v-application .primary--text{\n      color: #4caf50 !important;\n\n  } */\n.v-progress-circular__overlay[data-v-de464190]{\n     text-align: center !important;\n}\n",""])},188:function(t,e,a){"use strict";var n=a(18),r=a.n(n),i={name:"prgoraees",mixins:[a(73).a]},s=(a(186),a(19)),o=Object(s.a)(i,(function(){var t=this.$createElement,e=this._self._c||t;return e("div",{staticClass:"text-center mx-auto"},[e("v-progress-circular",{staticClass:"mx-auto",attrs:{indeterminate:"",color:this.color,size:200}})],1)}),[],!1,null,"de464190",null).exports,c=a(13),l=a(53);function u(t,e,a,n,r,i,s){try{var o=t[i](s),c=o.value}catch(t){return void a(t)}o.done?e(c):Promise.resolve(c).then(n,r)}function d(t){return function(){var e=this,a=arguments;return new Promise((function(n,r){var i=t.apply(e,a);function s(t){u(i,n,r,s,o,"next",t)}function o(t){u(i,n,r,s,o,"throw",t)}s(void 0)}))}}function v(t,e){var a=Object.keys(t);if(Object.getOwnPropertySymbols){var n=Object.getOwnPropertySymbols(t);e&&(n=n.filter((function(e){return Object.getOwnPropertyDescriptor(t,e).enumerable}))),a.push.apply(a,n)}return a}function p(t,e,a){return e in t?Object.defineProperty(t,e,{value:a,enumerable:!0,configurable:!0,writable:!0}):t[e]=a,t}var f,g;e.a={data:function(){return{data:[],page:1,lengthpage:null,loading:!0,keyword:"",urlcreate:"",url:"",dialog:!1,idDelete:null}},components:{Progress:o},mixins:[l.a],methods:function(t){for(var e=1;e<arguments.length;e++){var a=null!=arguments[e]?arguments[e]:{};e%2?v(Object(a),!0).forEach((function(e){p(t,e,a[e])})):Object.getOwnPropertyDescriptors?Object.defineProperties(t,Object.getOwnPropertyDescriptors(a)):v(Object(a)).forEach((function(e){Object.defineProperty(t,e,Object.getOwnPropertyDescriptor(a,e))}))}return t}({},Object(c.b)({setSnakbar:"snakbar/setSnakbar"}),{go:(g=d(r.a.mark((function t(){var e,a,n=this,i=arguments;return r.a.wrap((function(t){for(;;)switch(t.prev=t.next){case 0:return e=i.length>0&&void 0!==i[0]?i[0]:null,a=this.url,this.page=null==e?this.page:e,a=a+"?page="+this.page+"&keyword="+this.keyword,t.next=6,this.axios.get(a,this.config).then((function(t){n.data=t.data.data,n.page=t.data.current_page?t.data.current_page:t.data.meta.current_page,n.lengthpage=t.data.last_page?t.data.last_page:t.data.meta.last_page})).catch((function(t){console.log(t.response)}));case 6:this.loading=!1;case 7:case"end":return t.stop()}}),t,this)}))),function(){return g.apply(this,arguments)}),edit:function(t){var e=this.url+"/".concat(t,"/edit");this.$router.push(e)},deleteData:function(){var t=this,e=this.url+"/".concat(this.idDelete);this.axios.delete(e,this.config).then((function(e){t.setSnakbar({color_snakbar:"success",pesan:e.data.message,status:!0}),t.go(t.page),t.dialog=!1})).catch((function(e){console.log(e.response),t.setSnakbar({pesan:e.response.data.message,status:!0})}))},dialogDelete:function(t){this.idDelete=t,this.dialog=!0}}),mounted:function(){},created:(f=d(r.a.mark((function t(){return r.a.wrap((function(t){for(;;)switch(t.prev=t.next){case 0:return this.url=window.location.pathname,t.next=3,this.go();case 3:this.urlcreate=this.url+"/create";case 4:case"end":return t.stop()}}),t,this)}))),function(){return f.apply(this,arguments)})}},401:function(t,e,a){"use strict";a.r(e);var n={name:"menumanagement",mixins:[a(188).a]},r=a(19),i=Object(r.a)(n,(function(){var t=this,e=t.$createElement,a=t._self._c||e;return a("v-app",[t.loading?a("Progress"):t._e(),t._v(" "),t.loading?t._e():a("v-container",[a("BtnJudul",{attrs:{text:"Data Menu"}}),t._v(" "),a("v-card",{style:t.border,attrs:{tile:""}},[a("v-card-text",{staticClass:"text-center"},[a("v-container",[a("v-row",{attrs:{justify:"center",align:"center"}},[a("v-col",{attrs:{cols:"6"}},[a("v-text-field",{attrs:{label:"Pencarian",color:t.color},on:{keyup:function(e){return t.go(t.page)}},model:{value:t.keyword,callback:function(e){t.keyword=e},expression:"keyword"}})],1),t._v(" "),a("v-col",{attrs:{cols:"6",align:"right"}},[a("v-btn",{attrs:{color:"primary",to:t.urlcreate,small:"",tile:""}},[t._v("\n                                Tambah Data\n                            ")])],1)],1)],1),t._v(" "),a("v-simple-table",{scopedSlots:t._u([{key:"default",fn:function(){return[a("thead",[a("tr",[a("th",{staticClass:"text-left"},[t._v("Description")]),t._v(" "),a("th",{staticClass:"text-left"},[t._v("Url")]),t._v(" "),a("th",{staticClass:"text-left"},[t._v("Icon")]),t._v(" "),a("th",{staticClass:"text-left"},[t._v("Priority")]),t._v(" "),a("th",{staticClass:"text-left"},[t._v("Aksi")])])]),t._v(" "),a("tbody",t._l(t.data,(function(e){return a("tr",{key:e.id},[a("td",{staticClass:"text-left"},[t._v(t._s(e.description))]),t._v(" "),a("td",{staticClass:"text-left"},[t._v(t._s(e.url))]),t._v(" "),a("td",{staticClass:"text-left"},[a("v-icon",[t._v(t._s(e.icon))])],1),t._v(" "),a("td",{staticClass:"text-left"},[t._v("\n                                "+t._s(e.priority)+"\n                            ")]),t._v(" "),a("td",{staticClass:"text-left",attrs:{width:"30%"}},[a("v-btn",{attrs:{color:"success",fab:"","x-small":"",dark:""},on:{click:function(a){return t.edit(e.id)}}},[a("v-icon",[t._v("mdi-circle-edit-outline")])],1),t._v(" "),a("v-btn",{attrs:{color:"error",fab:"","x-small":""},on:{click:function(a){return t.dialogDelete(e.id)}}},[a("v-icon",[t._v("mdi-delete-outline")])],1)],1)])})),0)]},proxy:!0}],null,!1,940978567)})],1),t._v(" "),a("PaginateComponent",{attrs:{page:t.page,lengthpage:t.lengthpage},on:{go:t.go}}),t._v(" "),a("v-card-actions",{})],1),t._v(" "),a("v-dialog",{attrs:{"max-width":"340"},model:{value:t.dialog,callback:function(e){t.dialog=e},expression:"dialog"}},[a("v-card",[a("v-card-title",{staticClass:"headline"},[t._v("Apa anda yakin menghapus ?")]),t._v(" "),a("v-card-actions",[a("v-spacer"),t._v(" "),a("v-btn",{attrs:{text:""},on:{click:function(e){t.dialog=!1}}},[t._v("\n                Cancel\n            ")]),t._v(" "),a("v-btn",{attrs:{color:"red",text:""},on:{click:function(e){return t.deleteData()}}},[t._v("\n                Delete\n            ")])],1)],1)],1)],1)],1)}),[],!1,null,null,null);e.default=i.exports}}]);