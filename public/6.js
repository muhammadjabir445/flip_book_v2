(window.webpackJsonp=window.webpackJsonp||[]).push([[6],{189:function(e,t,i){"use strict";var n=i(18),a=i.n(n),r=i(13),s=i(53),o=i(75),l={components:{TiptapVuetify:o.o},data:function(){return{extensions:[o.g,o.a,o.j,o.q,o.n,o.i,o.k,o.c,o.l,[o.f,{options:{levels:[1,2,3]}}],o.b,o.d,o.h,o.m,o.e]}}};function c(e,t,i,n,a,r,s){try{var o=e[r](s),l=o.value}catch(e){return void i(e)}o.done?t(l):Promise.resolve(l).then(n,a)}function d(e,t){var i=Object.keys(e);if(Object.getOwnPropertySymbols){var n=Object.getOwnPropertySymbols(e);t&&(n=n.filter((function(t){return Object.getOwnPropertyDescriptor(e,t).enumerable}))),i.push.apply(i,n)}return i}function u(e,t,i){return t in e?Object.defineProperty(e,t,{value:i,enumerable:!0,configurable:!0,writable:!0}):e[t]=i,e}var p=i(202);i(208);p.GlobalWorkerOptions.workerSrc=pdfjsWorker;var v,f;t.a={data:function(){return{valid:!0,lazy:!1,loading:!1,judul:"",deskripsi:[],file:"",penerbit:"",pdf_url:"",totalPage:"",categori:[{id:"",description:"all"}],id_categori:"",nameRules:[function(e){return!!e||"Tidak Boleh Kosong"}],index_edit_deskripsi:null,tab:null,deskrip:{title:"",deskripsi:""},DataDialog:!1,kode:""}},methods:function(e){for(var t=1;t<arguments.length;t++){var i=null!=arguments[t]?arguments[t]:{};t%2?d(Object(i),!0).forEach((function(t){u(e,t,i[t])})):Object.getOwnPropertyDescriptors?Object.defineProperties(e,Object.getOwnPropertyDescriptors(i)):d(Object(i)).forEach((function(t){Object.defineProperty(e,t,Object.getOwnPropertyDescriptor(i,t))}))}return e}({},Object(r.b)({setSnakbar:"snakbar/setSnakbar"}),{tambah:function(){null!=this.index_edit_deskripsi?this.deskripsi.splice(this.index_edit_deskripsi,1,this.deskrip):this.deskripsi.push({deskripsi:this.deskrip.deskripsi,title:this.deskrip.title}),this.cancle()},edit:function(e){this.index_edit_deskripsi=e,this.deskrip=this.deskripsi.find((function(t,i){return i===e})),this.DataDialog=!0},cancle:function(){this.deskrip={title:"",deskripsi:""},this.index_edit_deskripsi=null,this.DataDialog=!1},hapus:function(e){this.deskripsi.splice(e,1)},eventChange:(v=a.a.mark((function e(t){var i,n;return a.a.wrap((function(e){for(;;)switch(e.prev=e.next){case 0:return i=t.target.files,this.file=i[0],n=new FileReader,e.next=5,function(){var e=new Uint8Array(this.result);p.getDocument(e).promise.then((function(e){console.log(e.numPages),document.getElementById("dataPages").innerText=e.numPages}))};case 5:return n.onload=e.sent,e.next=8,n.readAsArrayBuffer(this.file);case 8:case"end":return e.stop()}}),e,this)})),f=function(){var e=this,t=arguments;return new Promise((function(i,n){var a=v.apply(e,t);function r(e){c(a,i,n,r,s,"next",e)}function s(e){c(a,i,n,r,s,"throw",e)}r(void 0)}))},function(e){return f.apply(this,arguments)}),get_categori:function(){var e=this;this.axios.get("books/category",this.config).then((function(t){"/books"==window.location.pathname||"/books-list"==window.location.pathname?t.data.forEach((function(t){e.categori.push({id:t.id,description:t.description})})):e.categori=t.data}))}}),mixins:[s.a,l],computed:{backgroundColor:function(){return"background-color:".concat(this.color)}},created:function(){}}},203:function(e,t){},204:function(e,t){},205:function(e,t){},206:function(e,t){},207:function(e,t){},404:function(e,t,i){"use strict";i.r(t);var n=i(18),a=i.n(n);function r(e,t,i,n,a,r,s){try{var o=e[r](s),l=o.value}catch(e){return void i(e)}o.done?t(l):Promise.resolve(l).then(n,a)}var s,o,l={name:"book.create",mixins:[i(189).a],methods:{save:(s=a.a.mark((function e(){var t,i,n=this;return a.a.wrap((function(e){for(;;)switch(e.prev=e.next){case 0:return this.totalPage=document.getElementById("dataPages").textContent,this.loading=!0,t="/"+(t=(t=window.location.pathname).split("/"))[1],(i=new FormData).append("judul",this.judul),i.append("penerbit",this.penerbit),i.append("file",this.file),i.append("kode",this.kode),i.append("id_categori",this.id_categori),i.append("pages",this.totalPage),i.append("deskripsi",JSON.stringify(this.deskripsi)),e.next=15,this.axios.post(t,i,this.config).then((function(e){n.setSnakbar({status:!0,pesan:e.data.message,color_snakbar:"success"}),n.$router.push(t)})).catch((function(e){400==e.response.status?n.setSnakbar({color_snakbar:"red",status:!0,pesan:e.response.data.message}):n.setSnakbar({status:!0,color_snakbar:"red",pesan:"Terjadi Kesalahan"}),console.log(e.response)}));case 15:this.loading=!1;case 16:case"end":return e.stop()}}),e,this)})),o=function(){var e=this,t=arguments;return new Promise((function(i,n){var a=s.apply(e,t);function o(e){r(a,i,n,o,l,"next",e)}function l(e){r(a,i,n,o,l,"throw",e)}o(void 0)}))},function(){return o.apply(this,arguments)}),page:function(e){this.totalPage=e}},created:function(){this.get_categori()}},c=i(19),d=Object(c.a)(l,(function(){var e=this,t=e.$createElement,i=e._self._c||t;return i("v-app",[i("v-container",[i("BtnJudul",{attrs:{text:"Tambah Buku"}}),e._v(" "),i("v-card",{style:e.border,attrs:{tile:""}},[i("v-card-text",[i("v-container",[i("v-form",{ref:"form",attrs:{"lazy-validation":e.lazy},model:{value:e.valid,callback:function(t){e.valid=t},expression:"valid"}},[i("label",{attrs:{for:"",align:"left"}},[e._v("Buku Baru")]),e._v(" "),i("v-text-field",{attrs:{rules:e.nameRules,label:"Kode buku",required:""},model:{value:e.kode,callback:function(t){e.kode=t},expression:"kode"}}),e._v(" "),i("v-text-field",{attrs:{rules:e.nameRules,label:"Judul buku",required:""},model:{value:e.judul,callback:function(t){e.judul=t},expression:"judul"}}),e._v(" "),i("v-text-field",{attrs:{rules:e.nameRules,label:"Penerbit",required:""},model:{value:e.penerbit,callback:function(t){e.penerbit=t},expression:"penerbit"}}),e._v(" "),i("v-select",{attrs:{items:e.categori,rules:[function(e){return!!e||"Item is required"}],label:"Kategori","item-text":"description","item-value":"id",required:""},model:{value:e.id_categori,callback:function(t){e.id_categori=t},expression:"id_categori"}}),e._v(" "),i("p",{attrs:{id:"dataPages"}}),e._v(" "),i("input",{ref:"foto_profile",attrs:{type:"file",id:"foto_profile",accept:""},on:{change:e.eventChange}}),e._v(" "),i("br"),e._v(" "),i("br"),e._v(" "),i("v-btn",{attrs:{color:"success",depressed:"",small:"",dark:""},on:{click:function(t){e.DataDialog=!0}}},[e._v("\n                                Tambah Deskripsi\n                    ")]),e._v(" "),i("br"),e._v(" "),i("br"),e._v(" "),e.deskripsi.length>0?i("div",{staticClass:"tab-deskripsi"},[i("v-tabs",{attrs:{"background-color":e.color,dark:"","next-icon":"mdi-arrow-right-bold-box-outline","prev-icon":"mdi-arrow-left-bold-box-outline","show-arrows":""},model:{value:e.tab,callback:function(t){e.tab=t},expression:"tab"}},[i("v-tabs-slider",{attrs:{color:"white"}}),e._v(" "),e._l(e.deskripsi,(function(t,n){return i("v-tab",{key:n},[e._v("\n                            "+e._s(t.title)+"\n                        ")])}))],2),e._v(" "),i("v-tabs-items",{model:{value:e.tab,callback:function(t){e.tab=t},expression:"tab"}},e._l(e.deskripsi,(function(t,n){return i("v-tab-item",{key:n},[i("v-card",[i("v-card-text",{staticStyle:{position:"relative"},domProps:{innerHTML:e._s(t.deskripsi)}}),e._v(" "),i("div",{staticStyle:{position:"absolute",top:"0px",right:"0px"}},[i("v-btn",{attrs:{depressed:"",dark:"","x-small":"",color:"success"},on:{click:function(t){return e.edit(n)}}},[i("v-icon",{attrs:{dark:"",small:""}},[e._v("fal fa-pencil")])],1),e._v(" "),i("v-btn",{attrs:{depressed:"",dark:"","x-small":"",color:"red"},on:{click:function(t){return e.hapus(n)}}},[i("v-icon",{attrs:{dark:"",small:""}},[e._v("fal fa-trash")])],1)],1)],1)],1)})),1)],1):e._e(),e._v(" "),i("v-row",[i("v-col",{attrs:{cols:"12",align:"right"}},[i("v-btn",{attrs:{disabled:!e.valid,color:"success",tile:"",loading:e.loading},on:{click:function(t){return e.save()}}},[e._v("\n                            Simpan\n                            ")])],1)],1)],1)],1)],1),e._v(" "),i("v-card-actions",{})],1)],1),e._v(" "),i("v-dialog",{attrs:{width:"650"},model:{value:e.DataDialog,callback:function(t){e.DataDialog=t},expression:"DataDialog"}},[i("v-card",{attrs:{tile:""}},[i("v-card-title",{staticClass:"white--text",style:e.backgroundColor,attrs:{"primary-title":""}},[e._v("\n      Tambah deskripsi\n    ")]),e._v(" "),i("v-card-text",[i("v-text-field",{attrs:{label:"Title",required:""},model:{value:e.deskrip.title,callback:function(t){e.$set(e.deskrip,"title",t)},expression:"deskrip.title"}}),e._v(" "),i("tiptap-vuetify",{attrs:{extensions:e.extensions},model:{value:e.deskrip.deskripsi,callback:function(t){e.$set(e.deskrip,"deskripsi",t)},expression:"deskrip.deskripsi"}})],1),e._v(" "),i("v-divider"),e._v(" "),i("v-card-actions",[i("v-spacer"),e._v(" "),i("v-btn",{staticClass:"white--text",attrs:{color:"red",tile:""},on:{click:function(t){return e.cancle()}}},[e._v("\n        Cancel\n      ")]),e._v(" "),i("v-btn",{attrs:{color:"success",tile:""},on:{click:function(t){return e.tambah()}}},[e._v("\n        Save\n      ")])],1)],1)],1)],1)}),[],!1,null,"7a705ee2",null);t.default=d.exports}}]);
//# sourceMappingURL=6.js.map