
const pdfjs = require('pdfjs-dist/build/pdf')
const pdfjsworker = require('pdfjs-dist/build/pdf.worker.entry')
pdfjs.GlobalWorkerOptions.workerSrc = pdfjsWorker;

import {mapActions} from 'vuex'
import middleware from './middleware'
import wyswig from './Wyswig'
export default {
    data: () => ({
        valid: true,
        lazy:false,
        loading:false,
        judul:"",
        deskripsi:[],
        file:"",
        penerbit:"",
        pdf_url:'',
        totalPage:'',
        harga:0,
        hargaRules: [
            v => !!v || 'Harus diisi',
            v => /^[0-9,]+$/.test(v) || 'Format salah',
            v => v.split(',').join('') <= 100000000 || 'Tidak boleh lebih dari 100 juta'

        ],
        categori:[
            {
                id:'',
                description:'all'
            }
        ],
        id_categori:'',
        nameRules: [
          v => !!v || 'Tidak Boleh Kosong',
        ],
        index_edit_deskripsi:null,
        tab: null,
        deskrip:{
            title:'',
            deskripsi:''
        },
        DataDialog:false,
        kode:''

      }),
    methods: {
        ...mapActions({
            setSnakbar: 'snakbar/setSnakbar'
        }),

        tambah() {
            if(this.index_edit_deskripsi != null) {
                this.deskripsi.splice(this.index_edit_deskripsi,1,this.deskrip)
            } else {
                this.deskripsi.push({
                    deskripsi: this.deskrip.deskripsi,
                    title: this.deskrip.title
                })
            }


            this.cancle()
        },

        edit(index_edit) {
            this.index_edit_deskripsi = index_edit

            this.deskrip = this.deskripsi.find((_,index) => index === index_edit)
            this.DataDialog = true
        },

        cancle() {
            this.deskrip = {
                title: '',
                deskripsi: ''
            }
            this.index_edit_deskripsi = null
            this.DataDialog = false
        },
        hapus(index) {
            this.deskripsi.splice(index,1)
        },
        async eventChange(event){
            const files = event.target.files
             this.file = files[0]
              const fileReader = new FileReader()


            fileReader.onload = await function() {

                //Step 4:turn array buffer into typed array
                var typedarray = new Uint8Array(this.result);

                //Step 5:PDFJS should be able to read this
                let loadingTask = pdfjs.getDocument(typedarray)
                loadingTask.promise.then((doc) => {
                    console.log(doc.numPages)
                    let html = document.getElementById('dataPages')
                    html.innerText = doc.numPages
                })


            };
            //Step 3:Read the file as ArrayBuffer
            await fileReader.readAsArrayBuffer(this.file);
        },

        get_categori(){
            this.axios.get('books/category',this.config)
            .then((ress) => {
                if (window.location.pathname == '/books' || window.location.pathname == '/books-list') {
                    ress.data.forEach(element => {
                        this.categori.push({
                            id:element.id,
                            description:element.description,
                        })
                    });
                } else {
                    this.categori = ress.data
                }

            })
        },
        formatAsCurrency (value, dec) {
            dec = dec || 0
            if (value === null) {
                return null
            }
            return '' + value.toFixed(dec).replace(/(\d)(?=(\d\d\d)+(?!\d))/g, "$1,")
        },

    },

    mixins:[middleware,wyswig],
    computed: {
        backgroundColor(){
            return `background-color:${this.color}`
        },
        harga_convert:{
            get(){
                return this.formatAsCurrency(this.harga, 0)
            },
            set(newValue){
                this.harga= Number(newValue.replace(/[^0-9\.]/g, ''))
            }
        },
    },

    created(){

    }
}
