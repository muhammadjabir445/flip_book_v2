import Progress from '../components/Progress'
import {mapActions, mapGetters} from 'vuex'
import middleware from './middleware'
export default {
    data(){
        return {
            data : [],
            page: 1,
            lengthpage: null,
            loading:true,
            keyword:'',
            urlcreate: '',
            url: '',
            dialog:false,
            idDelete: null
        }
    },

    components:{
        'Progress' : Progress
    },

    mixins:[middleware],
    methods : {
        ...mapActions({
            setSnakbar:'snakbar/setSnakbar'
        }),

        // method ambil data
        async go(page = null){
            let url = this.url
            this.page = page == null ? this.page : page

            url = url + '?page=' +this.page + "&keyword=" + this.keyword

            await this.axios.get(url,this.config)
            .then((ress)=>{
                this.data = ress.data.data
                this.page = ress.data.current_page ? ress.data.current_page : ress.data.meta.current_page
                this.lengthpage = ress.data.last_page ? ress.data.last_page : ress.data.meta.last_page
            })
            .catch((err)=>{
                console.log(err.response)
            })
            this.loading = false
        },

        // method edit
        edit(id){
            let url = this.url + `/${id}/edit`
            this.$router.push(url)
        },

        // method delete
        deleteData(){
            let url = this.url + `/${this.idDelete}`
            this.axios.delete(url,this.config)
            .then((ress) => {
                this.setSnakbar({
                    color_snakbar:'success',
                    pesan:ress.data.message,
                    status:true
                })
                this.go(this.page)
                this.dialog = false
            })
            .catch((err)=>{
                console.log(err.response)
                this.setSnakbar({
                    pesan:err.response.data.message,
                    status:true
                })
            })
        },

        dialogDelete(id){
            this.idDelete = id
            this.dialog = true
        }
    },

    mounted() {

    },

    async created(){
        this.url = window.location.pathname
        await this.go()
        this.urlcreate = this.url + '/create'
    }
}
