<template>
        <v-container>
            <v-card
            tile
            >
                <v-card-text class="text-center" style="align-content: center;">
                    <br>
                    <br>
                    <h2>Dapatkan Buku Digital dengan menggunakan kode Aktivasi</h2>
                    <br>
                    <v-text-field
                        outlined
                        v-model="kode"
                        label="Kode"
                        style="width:40%;align-content: center;margin:auto"
                        v-if="!data_aktivasi && !pesan_success"
                        >
                    </v-text-field>
                    {{pesan_error}}
                    <div style="width:80%;align-content: center;margin:auto" v-if="data_aktivasi">
                        <table width="100%" style="border-collapse:collapse">
                            <tr>
                                <td>Kode Aktivasi</td>
                                <td>{{data_aktivasi.kode}}</td>
                            </tr>
                            <tr>
                                <td>Judul Buku</td>
                                <td>{{data_aktivasi.aktivasi.book.judul_buku}}</td>
                            </tr>
                            <tr>
                                <td>Status Kode</td>
                                <td>
                                    <v-btn :color="data_aktivasi.status == 0 ? 'primary' : 'success'" class="white--text" x-small >
                                        {{data_aktivasi.status == 0 ? 'Belum Terpakai' : 'Sudah Terpakai'}}
                                    </v-btn>
                                </td>
                            </tr>
                        </table>
                    </div>

                    <h1 v-if="pesan_success">{{pesan_success}}</h1>
                    <br>
                    <v-btn
                    color="secondary"
                    tile
                    width="300px"
                    depressed
                    v-if="data_aktivasi || pesan_success"
                    @click="cancel()"
                    >
                    {{data_aktivasi ? 'Cancel' : 'Ulangi'}}
                    </v-btn>
                    <v-btn
                    width="300px"
                    color="success"
                    tile
                    @click="data_aktivasi ? aktivasi_get() : aktivasi_check() "
                    depressed
                    >
                    {{data_aktivasi ? 'Aktifkan' : 'Check Kode'}}
                    </v-btn>
                </v-card-text>
                <v-card-actions class="">

                </v-card-actions>
            </v-card>
        </v-container>

</template>
<script>
import middleware from '../../mixins/middleware'
export default {
    name: 'aktivasi.active',
    data() {
        return {
            kode:'',
            pesan_error:'',
            data_aktivasi:'',
            pesan_success:''
        }
    },
    mixins:[middleware],
    methods:{
        aktivasi_check(){
            this.pesan_error = ''
            this.pesan_success = ''
            this.axios.get('aktivasi/check?kode=' + this.kode ,this.config)
            .then((ress) => {
                 this.data_aktivasi = ress.data.aktivasi
            })
            .catch((err) => {
                this.pesan_error = err.response.data.message
            })
        },

        aktivasi_get(){
            this.pesan_error = ''
            this.pesan_success = ''
             this.axios.get(`aktivasi/${this.kode}/aktive` ,this.config)
            .then((ress) => {
                 this.pesan_success = ress.data.message
                 this.data_aktivasi = ''
            })
            .catch((err) => {
                this.pesan_error = err.response.data.message
            })
        },

        cancel() {
            this.data_aktivasi = ''
            this.pesan_error = ''
            this.pesan_success = ''
        }
    }

}
</script>

