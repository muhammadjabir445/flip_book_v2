<template>
<div>
    <v-container justify-center>


        <v-text-field
        v-model="keyword"
        label="Pencarian"
        v-on:keyup ="go(page)"
        :color="color"
        style="width:40%;align-content: center;margin:auto"
    ></v-text-field>
         <v-row
        justify="center"
        >
            <v-col
            cols="12"
            md="3"
            v-for="item in data"
            :key="item.id"
             style="min-height:420px !important"
            >
                <v-card
                tile

                height="100%"
                >
                    <v-img
                    height="100%"


                    :src="item.foto"
                    ></v-img>

                    <v-card-title>{{item.judul}}</v-card-title>
                    <v-divider class="mx-4"></v-divider>

                    <v-card-actions>
                    <v-btn
                        :color="color"
                        text
                        block
                        :to="'my-book/' + item.kode + '/read'"
                    >
                        BACA BUKU
                    </v-btn>
                    </v-card-actions>
                </v-card>
            </v-col>
        </v-row>
        <PaginateComponent :page="page" :lengthpage="lengthpage" v-on:go="go" v-if="lengthpage > 1"/>
    </v-container>

</div>


</template>
<script>
import {mapActions, mapGetters} from 'vuex'
import middleware from '../../mixins/middleware'
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

    mixins:[middleware],
    methods : {
        ...mapActions({
            setSnakbar:'snakbar/setSnakbar'
        }),

        // method ambil data
        async go(page = null){
            let url = 'my-book'
            this.page = page == null ? this.page : page
            if(this.page > 1) {
                url = url + '?page=' +this.page + "&keyword=" + this.keyword
            }else{
                url = url + "?keyword=" + this.keyword
            }
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

    },

    mounted() {

    },

    created(){
        this.go()
    }
}

</script>
