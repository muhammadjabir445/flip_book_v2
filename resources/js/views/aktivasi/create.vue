<template>
    <v-app>
        <v-container>
            <BtnJudul text="Tambah Buku"/>

            <v-card
            :style="border"
            tile
            >
                <!-- <v-card-text class="text-center"> -->
                <v-card-text>
                    <v-container>
                        <v-form
                        ref="form"
                        v-model="valid"
                        :lazy-validation="lazy"
                        >
                        <label for="" align="left">Buku Baru</label>

                        <div style="position:relative;width:100%">
                            <v-text-field
                            outlined
                            v-model="book"
                            :rules="nameRules"
                            label="Nama buku"
                            required
                            @keyup="getBook"
                            style="position:relative"
                            >
                            </v-text-field>
                            <div class="list-barang" v-if="books.length > 0">
                                <ul>
                                    <li v-for="item in books" :key="item.id" @click="select_book(`${item.kode} - ${item.judul}`)">{{item.kode}} - {{item.judul}}</li>
                                </ul>
                            </div>
                        </div>

                        <v-text-field
                        outlined
                        v-model="total_convert"
                        :rules="totalRules"
                        label="Total Aktivasi"
                        required
                        >
                        </v-text-field>


                        <v-row>
                            <v-col
                            cols="12"
                            align="right"
                            >
                              <v-btn
                                :disabled="!valid"
                                color="success"
                                tile
                                @click="save()"
                                :loading="loading"
                                >
                                Simpan
                                </v-btn>
                            </v-col>
                        </v-row>

                    </v-form>
                    </v-container>

                </v-card-text>

                <v-card-actions class="">

                </v-card-actions>
            </v-card>
        </v-container>
    </v-app>

</template>
<script>
// import {mapActions} from 'vuex'

import AktivasiMixin from '../../mixins/AktivasiMixin'
export default {
    name: 'aktivasi.create',

    mixins:[AktivasiMixin],
    methods:{
        async save(){
            this.loading = true
            let url = window.location.pathname
            url = url.split('/')
            url = "/" + url[1]
            let data = new FormData()

            let kode = this.book.split('-')
            data.append('total',this.total)
            data.append('kode_buku',kode[0])

            await this.axios.post(url,data,this.config)
            .then((ress) => {
                console.log(ress)
                this.setSnakbar({
                    status:true,
                    pesan:ress.data.message,
                    color_snakbar:'success'
                })
                this.$router.push(url)
            })
            .catch((err)=>{
                if (err.response.status == 400 ) {
                    this.setSnakbar({
                    color_snakbar:'red',
                    status:true,
                    pesan:err.response.data.message,
                    })
                }else{
                    this.setSnakbar({
                    status:true,
                    color_snakbar:'red',
                    pesan:"Terjadi Kesalahan",
                    })
                }

                console.log(err.response)
            })
            this.loading = false

        },
    }

}
</script>

<style lang="css" scoped>
    .sembunyi {
        display: none;
    }
    .tampil {
        display: block;
    }

    .list-barang{
        background-color:white;
        position:relative;
        left:0px;
        bottom:30px;
        width:100%;
        -webkit-box-shadow: 4px 6px 5px -4px rgba(0,0,0,0.75);
        -moz-box-shadow: 4px 6px 5px -4px rgba(0,0,0,0.75);
        box-shadow: 4px 6px 5px -4px rgba(0,0,0,0.75);
        z-index: 100;
    }
    .list-barang ul li {

        padding-top: 15px;
        padding-bottom: 15px;
        padding-left: 10px;
    }
    .list-barang ul {
        list-style: none;
        padding: 0px;
    }
    .list-barang ul li:hover {
        cursor:pointer;
         background-color:rgb(233, 233, 233);
    }
</style>
