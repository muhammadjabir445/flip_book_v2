(window.webpackJsonp=window.webpackJsonp||[]).push([[27],{189:function(t,e,n){"use strict";var a=n(74);e.a={components:{TiptapVuetify:a.o},data:function(){return{extensions:[a.g,a.a,a.j,a.q,a.n,a.i,a.k,a.c,a.l,[a.f,{options:{levels:[1,2,3]}}],a.b,a.d,a.h,a.m,a.e]}}}},190:function(t,e,n){"use strict";var a=n(13),r=n(53),i=n(189);function o(t,e){var n=Object.keys(t);if(Object.getOwnPropertySymbols){var a=Object.getOwnPropertySymbols(t);e&&(a=a.filter((function(e){return Object.getOwnPropertyDescriptor(t,e).enumerable}))),n.push.apply(n,a)}return n}function s(t,e,n){return e in t?Object.defineProperty(t,e,{value:n,enumerable:!0,configurable:!0,writable:!0}):t[e]=n,t}e.a={data:function(){return{valid:!0,lazy:!1,loading:!1,judul:"",isi_artikel:"",foto:"",imgurl:"",nameRules:[function(t){return!!t||"Tidak Boleh Kosong"}]}},methods:function(t){for(var e=1;e<arguments.length;e++){var n=null!=arguments[e]?arguments[e]:{};e%2?o(Object(n),!0).forEach((function(e){s(t,e,n[e])})):Object.getOwnPropertyDescriptors?Object.defineProperties(t,Object.getOwnPropertyDescriptors(n)):o(Object(n)).forEach((function(e){Object.defineProperty(t,e,Object.getOwnPropertyDescriptor(n,e))}))}return t}({},Object(a.b)({setSnakbar:"snakbar/setSnakbar"})),computed:{},mixins:[r.a,i.a],created:function(){}}},411:function(t,e,n){"use strict";n.r(e);var a=n(18),r=n.n(a);function i(t,e,n,a,r,i,o){try{var s=t[i](o),l=s.value}catch(t){return void n(t)}s.done?e(l):Promise.resolve(l).then(a,r)}function o(t){return function(){var e=this,n=arguments;return new Promise((function(a,r){var o=t.apply(e,n);function s(t){i(o,a,r,s,l,"next",t)}function l(t){i(o,a,r,s,l,"throw",t)}s(void 0)}))}}var s,l,c={name:"artikel.create",mixins:[n(190).a],methods:{save:(l=o(r.a.mark((function t(){var e,n,a=this;return r.a.wrap((function(t){for(;;)switch(t.prev=t.next){case 0:return this.loading=!0,e="artikel/"+this.$route.params.id,(n=new FormData).append("judul",this.judul),n.append("foto",this.foto),n.append("isi_artikel",this.isi_artikel),n.append("_method","PUT"),t.next=9,this.axios.post(e,n,this.config).then((function(t){a.setSnakbar({status:!0,pesan:t.data.message,color_snakbar:"success"}),a.$router.go(-1)})).catch((function(t){400==t.response.status?a.setSnakbar({color_snakbar:"red",status:!0,pesan:t.response.data.message}):a.setSnakbar({status:!0,color_snakbar:"red",pesan:"Terjadi Kesalahan"}),console.log(t.response)}));case 9:this.loading=!1;case 10:case"end":return t.stop()}}),t,this)}))),function(){return l.apply(this,arguments)}),eventChange:function(t){var e=this,n=t.target.files;this.foto=n[0];var a=new FileReader;a.addEventListener("load",(function(){e.imgurl=a.result})),a.readAsDataURL(this.foto)},go:(s=o(r.a.mark((function t(){var e,n=this;return r.a.wrap((function(t){for(;;)switch(t.prev=t.next){case 0:return e=window.location.pathname,t.next=3,this.axios.get(e,this.config).then((function(t){var e=document.location.origin,a=t.data.artikel;n.judul=a.judul,n.isi_artikel=a.isi_artikel,n.imgurl=e+"/storage/".concat(a.foto)})).catch((function(t){console.log(t)}));case 3:case"end":return t.stop()}}),t,this)}))),function(){return s.apply(this,arguments)})},created:function(){this.go()}},u=n(19),d=Object(u.a)(c,(function(){var t=this,e=t.$createElement,n=t._self._c||e;return n("v-app",[n("v-container",[n("BtnJudul",{attrs:{text:"Edit Artikel"}}),t._v(" "),n("v-card",{style:t.border,attrs:{tile:""}},[n("v-card-text",[n("v-container",[n("v-form",{ref:"form",attrs:{"lazy-validation":t.lazy},model:{value:t.valid,callback:function(e){t.valid=e},expression:"valid"}},[n("label",{attrs:{for:"",align:"left"}},[t._v("Artikel Baru Baru")]),t._v(" "),n("v-text-field",{attrs:{rules:t.nameRules,label:"Judul Artikel",required:""},model:{value:t.judul,callback:function(e){t.judul=e},expression:"judul"}}),t._v(" "),n("label",{attrs:{for:"",align:"left"}},[t._v("Isi Artikel")]),t._v(" "),n("tiptap-vuetify",{attrs:{extensions:t.extensions},model:{value:t.isi_artikel,callback:function(e){t.isi_artikel=e},expression:"isi_artikel"}}),t._v(" "),n("label",{attrs:{for:"",align:"left"}},[t._v("Foto Sampul")]),t._v(" "),n("input",{ref:"foto_profile",attrs:{type:"file",id:"foto_profile",accept:"image/*"},on:{change:t.eventChange}}),t._v(" "),n("small",[t._v("Kosongkan jika tidak ingin ganti foto sampul")]),t._v(" "),n("v-img",{attrs:{src:t.imgurl}}),t._v(" "),n("v-row",[n("v-col",{attrs:{cols:"12",align:"right"}},[n("v-btn",{staticStyle:{color:"white !important"},attrs:{disabled:t.loading,color:"red",tile:""},on:{click:function(e){return t.$router.go(-1)}}},[t._v("\n                            Batal\n                            ")]),t._v(" "),n("v-btn",{attrs:{disabled:!t.valid,color:"success",tile:"",loading:t.loading},on:{click:function(e){return t.save()}}},[t._v("\n                            Simpan\n                            ")])],1)],1)],1)],1)],1),t._v(" "),n("v-card-actions",{})],1)],1)],1)}),[],!1,null,"5115d6de",null);e.default=d.exports}}]);