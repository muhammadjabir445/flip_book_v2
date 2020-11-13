<template>
    <v-app>
        <Progress v-if="loading"/>
        <v-container v-if="!loading">
            <BtnJudul text="Kode Aktivasi"/>

            <v-card
             :style="border"
            tile
            >
                <v-card-text class="text-center">
                    <v-container>
                        <v-row justify="center" align="center">
                            <v-col
                                cols="6"
                            >
                            <v-text-field
                                v-model="keyword"
                                label="Pencarian"
                                v-on:keyup ="go(page)"
                                :color="color"
                            ></v-text-field>
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
                            <th class="text-left">Judul</th>
                            <th class="text-left">Tanggal</th>
                            <th class="text-left">Total aktivasi</th>
                            <th class="text-left">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr v-for="(item,index) in data" :key="item.id">
                                <td class="text-left">{{++index}}</td>
                                <td class="text-left">{{item.book.judul_buku}}</td>
                                <td class="text-left">{{item.tanggal}}</td>
                                <td class="text-left">{{item.total_aktivasi}}</td>
                                <td class="text-left">
                                <v-btn color="primary" @click="openDetail(item.id)" class="white--text" x-small >
                                    Detail
                                </v-btn>
                                <v-btn color="red" class="white--text" @click="cetak_pdf(item.id)" x-small :loading="item.loading" >
                                    PDF
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

            <DetailAktivasi :dialog_detail="dialog_detail" :id_aktivasi="id_aktivasi" v-on:close="closeDetail()" />
    </v-app>

</template>
<script>

import CrudMixin from '../../mixins/CrudMixin'
import DetailAktivasi from '../../components/external/DetailAktivasi'
import download from 'downloadjs'
export default {
    name: 'aktivasi',
    mixins:[CrudMixin],
    data() {
        return {
            dialog_detail:false,
            id_aktivasi:0
        }
    },
    methods:{
        openDetail(id){
            this.dialog_detail = true
            this.id_aktivasi = id
        },

        closeDetail(){
            this.dialog_detail = false
            this.id_aktivasi = 0
        },
        async cetak_pdf(id){
            let aktivasi = this.data.find((x) => x.id === id)
            aktivasi.loading = true
            let index_aktivasi = this.data.findIndex(x => x.id == aktivasi.id)
            this.data.splice(index_aktivasi,1,aktivasi)
            await this.axios.get('aktivasi/' + id + '/pdf',{
                responseType: 'blob',
                headers: this.config.headers
            })
            .then((ress) => {
                 const content = ress.headers['content-type'];

                download(ress.data, aktivasi.tanggal + '.pdf',content)
            })
            .catch(err => console.log(err))
             aktivasi.loading = false
            this.data.splice(index_aktivasi,1,aktivasi)

        }
    },
    components:{
        DetailAktivasi
    }

}
</script>

