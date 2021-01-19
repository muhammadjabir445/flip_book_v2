<template>
    <v-app>
        <Progress v-if="loading"/>
        <v-container v-if="!loading">
            <BtnJudul text="List Buku Online Digital"/>

            <v-card
             :style="border"
            tile
             outlined
            >
                <v-card-text class>
                    <v-row>
                    <v-col cols="10">
                    <v-text-field
                    v-model="keyword"
                    label="Pencarian"
                    :color="color"
                    ></v-text-field>
                    </v-col>
                    <v-col cols="2">
                            <v-btn style="margin-top:15px !important" color="primary" v-on:click="go(page)" fab x-small dark >
                                <v-icon x-small >fal fa-search</v-icon>
                            </v-btn>
                    </v-col>
                    </v-row>

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
                            :to="{name:'mybook.read' , params:{kode:item.kode}}"
                            style="cursor:pointer"
                            >
                                <v-img


                                :src="item.foto"
                                ></v-img>

                                <!-- <v-card-title>{{item.judul}}</v-card-title> -->
                                <v-divider class="mx-2"></v-divider>

                                <v-card-actions align-center height="100%">
                                 <small :color="color" style="font-weight:bold;margin: 0 auto" class="text-center">{{item.judul}}</small>

                                </v-card-actions>
                                <v-divider class="mx-2"></v-divider>

                                <v-card-actions align-center height="100%" class="text-center">
                                 Rp. {{item.harga | formatPrice}}
                                </v-card-actions>
                            </v-card>
                        </v-col>
                    </v-row>
                </v-card-text>
                <PaginateComponent :page="page" :lengthpage="lengthpage" v-on:go="go"/>
                <v-card-actions class="">

                </v-card-actions>
            </v-card>
        </v-container>
    </v-app>

</template>
<script>

import CrudMixin from '../../mixins/CrudMixin'
export default {
    name: 'books-list',
    mixins:[CrudMixin],
    methods: {
        async go(page = null){
            this.loading = true
            let url = 'books-list/'+this.$route.params.category
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

    },
    watch:{
    $route (to, from){
            this.go()
        }
    },

    filters: {
        formatPrice(value) {
            let val = (value/1).toFixed().replace('.', ',')
            return val.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ".")
        },
    },


}
</script>

