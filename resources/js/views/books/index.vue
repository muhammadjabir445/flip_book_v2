<template>
    <v-app>
        <Progress v-if="loading"/>
        <v-container v-if="!loading">
            <BtnJudul text="Data Buku"/>

            <v-card
             :style="border"
            tile
            >
                <v-card-text class="text-center">
                    <v-container>
                        <v-row justify="center" align="center">
                            <v-col
                                cols="3"
                            >
                            <v-text-field
                                v-model="keyword"
                                label="Pencarian"
                                v-on:keyup="go(page)"
                                :color="color"
                            ></v-text-field>
                            </v-col>

                            <v-col cols="3">
                                <v-select
                                v-model="id_categori"
                                :items="categori"

                                label="Kategori"
                                item-text="description"
                                item-value="id"
                                @change="go(page)"
                                ></v-select>
                            </v-col>

                            <v-col
                                cols="6"
                                align="right"
                            >
                                <v-btn color="primary"  :to="urlcreate" small tile>
                                    Tambah Data
                                </v-btn>
                            </v-col>
                        </v-row>
                    </v-container>

                    <v-simple-table>
                        <template v-slot:default>
                        <thead>
                            <tr>
                            <th class="text-left">Nomor</th>
                            <th class="text-left">Sampul</th>
                            <th class="text-left">Judul</th>
                            <th class="text-left">Penerbit</th>
                            <th class="text-left">Total Pages</th>
                            <th class="text-left">Kategori</th>
                            <th class="text-left">Status</th>
                            <th class="text-left">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr v-for="(item,index) in data" :key="item.id">
                                <td class="text-left">{{++index}}</td>
                                <td class="text-left">
                                    <v-img :src="item.foto" height="120px" width="80px" v-if="item.foto"/>
                                    {{!item.foto ? 'Sedang diproses' : ''}}
                                </td>
                                <td class="text-left">{{item.judul}}</td>
                                <td class="text-left">{{item.penerbit}}</td>
                                <td class="text-left">{{item.pages}}</td>
                                <td class="text-left">{{item.categori}}</td>
                                <td class="text-left">
                                <v-btn :loading="item.loading" :color="item.status == 1 ? 'success' : 'red'" class="white--text" v-on:click="changeStatus(item.id)" x-small >
                                    {{ item.status == 1 ? 'Publish' : 'No-Publish'}}
                                </v-btn></td>
                                <td class="text-left">
                                <v-btn color="success" v-on:click="edit(item.id)" fab x-small dark >
                                    <v-icon>mdi-circle-edit-outline</v-icon>
                                </v-btn>
                                <v-btn color="error" fab x-small @click="dialogDelete(item.id)" >
                                    <v-icon>mdi-delete-outline</v-icon>
                                </v-btn>
                                </td>
                            </tr>
                        </tbody>
                        </template>
                    </v-simple-table>
                </v-card-text>
                <PaginateComponent :page="page" :lengthpage="lengthpage" v-on:go="go"/>
                <v-card-actions class="">

                </v-card-actions>
            </v-card>

            <v-dialog
            v-model="dialog"
            max-width="340"
            >
            <v-card>
                <v-card-title class="headline">Apa anda yakin menghapus ?</v-card-title>

                <v-card-actions>
                <v-spacer></v-spacer>

                <v-btn

                    text
                    @click="dialog = false"
                >
                    Cancel
                </v-btn>

                <v-btn
                    color="red"
                    text
                    @click="deleteData()"
                >
                    Delete
                </v-btn>
                </v-card-actions>
            </v-card>
            </v-dialog>
        </v-container>
    </v-app>

</template>
<script>

import CrudMixin from '../../mixins/CrudMixin'

export default {
    name: 'users',
    data() {
        return {
            categori:[
            {
                id:'',
                description:'all'
            }
            ],
            id_categori:''
        }
    },
    mixins:[CrudMixin],
    methods: {
        async changeStatus(id) {
            let data = this.data.find((x) => x.id === id)
            let index = this.data.findIndex(x => x.id === id)
            data.loading = true
            this.data.splice(index,1,data)
            await this.axios.get('books/' + id + '/status',this.config)
            .then((ress) => {
                this.data[index].status = !this.data[index].status
                this.setSnakbar({
                    color_snakbar:'success',
                    pesan:ress.data.message,
                    status:true
                })
            })
            .catch((err) => {
                 console.log(err.response)
                this.setSnakbar({
                    pesan:err.response.data.message,
                    status:true
                })
            })
            data.loading = false
            this.data.splice(index,1,data)
        },
        async go(page = null){

            let url = this.url
            this.page = page == null ? this.page : page
            if(this.page > 1) {
                url = url + '?page=' +this.page + "&keyword=" + this.keyword
            }else{
                url = url + "?keyword=" + this.keyword
            }
            url = url + '&category=' + this.id_categori
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
        }
    },
    created(){
        this.get_categori()
    }
}
</script>

