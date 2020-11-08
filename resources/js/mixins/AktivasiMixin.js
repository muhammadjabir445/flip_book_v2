import {mapActions} from 'vuex'
import middleware from './middleware'
export default {
    data: () => ({
        valid: true,
        lazy:false,
        loading:false,
        book:'',
        total:0,
        books:[],
        nameRules: [
          v => !!v || 'Tidak Boleh Kosong',
        ],
        totalRules: [
            v => !!v || 'Harus diisi',
            v => /^[0-9,]+$/.test(v) || 'Format salah',
            v => v.split(',').join('') <= 10000 || 'Tidak boleh lebih dari 10 ribu'

        ],

      }),
    methods: {
        ...mapActions({
            setSnakbar: 'snakbar/setSnakbar'
        }),

        getBook(){
            this.axios.get('books/create?keyword=' + this.book ,this.config)
            .then((ress) => {
                this.books = ress.data.data
            })
            .catch((err) => console.log(err))
        },
        formatAsCurrency (value, dec) {
            dec = dec || 0
            if (value === null) {
                return null
            }
            return '' + value.toFixed(dec).replace(/(\d)(?=(\d\d\d)+(?!\d))/g, "$1,")
        },
        select_book(judul_book) {
            this.book = judul_book
            this.books = []
        },

    },
    computed: {
        total_convert:{
            get(){
                return this.formatAsCurrency(this.total, 0)
            },
            set(newValue){
                this.total= Number(newValue.replace(/[^0-9\.]/g, ''))
            }
        },
    },

    mixins:[middleware],

    created(){
    }
}
