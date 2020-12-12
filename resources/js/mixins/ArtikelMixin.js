import {mapActions} from 'vuex'
import middleware from './middleware'
import wyswig from './Wyswig'
export default {
    data: () => ({
        valid: true,
        lazy:false,
        loading:false,
        judul:'',
        isi_artikel:'',
        foto:'',
        imgurl:'',
        nameRules: [
          v => !!v || 'Tidak Boleh Kosong',
        ],

      }),
    methods: {
        ...mapActions({
            setSnakbar: 'snakbar/setSnakbar'
        }),

    },
    computed: {

    },

    mixins:[middleware,wyswig],

    created(){
    }
}
