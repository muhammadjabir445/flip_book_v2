<template>
    <v-app>
        <v-container>
            <BtnJudul text="Tambah Artikel"/>

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
                        <label for="" align="left">Artikel Baru Baru</label>


                        <v-text-field
                        v-model="judul"
                        :rules="nameRules"
                        label="Judul Artikel"
                        required
                        ></v-text-field>

                        <label for="" align="left">Isi Artikel</label>
                        <tiptap-vuetify
                        v-model="isi_artikel"
                        :extensions="extensions"
                        />
                        <label for="" align="left">Foto Sampul</label>
                        <input type="file" id="foto_profile" ref="foto_profile" accept="image/*" @change="eventChange">
                        <v-img :src="imgurl" />
                        <v-row>
                            <v-col
                            cols="12"
                            align="right"
                            >
                            <v-btn
                                :disabled="loading"
                                color="red"
                                tile
                                style="color:white !important"
                                @click="$router.go(-1)"
                                >
                                Batal
                                </v-btn>
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

import ArtikelMixin from '../../mixins/ArtikelMixin'
export default {
    name: 'artikel.create',

    mixins:[ArtikelMixin],
    methods:{
        async save(){
            this.loading = true
            let url = window.location.pathname
            url = url.split('/')
            url = "/" + url[1]
            let data = new FormData()
            data.append('judul',this.judul)
            data.append('foto',this.foto)
            data.append('isi_artikel',this.isi_artikel)

            await this.axios.post(url,data,this.config)
            .then((ress) => {
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

        eventChange(event){
           const files = event.target.files
            this.foto = files[0]
             const fileReader = new FileReader()
            fileReader.addEventListener('load',()=>{
                this.imgurl=fileReader.result
            })
             fileReader.readAsDataURL(this.foto)
       }



    },

    created(){

    }

}
</script>

<style lang="css" scoped>
</style>
