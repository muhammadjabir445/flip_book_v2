<template>
    <v-app>
        <v-container>
            <BtnJudul text="Edit Buku"/>

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

                          <v-text-field
                        v-model="kode"
                        :rules="nameRules"
                        label="Kode buku"
                        required
                        ></v-text-field>

                        <v-text-field
                        v-model="judul"
                        :rules="nameRules"
                        label="Judul buku"
                        required
                        ></v-text-field>

                        <v-text-field
                        v-model="penerbit"
                        :rules="nameRules"
                        label="Penerbit"
                        required
                        ></v-text-field>

                        <v-text-field
                        outlined
                        v-model="harga_convert"
                        :rules="hargaRules"
                        label="Harga"
                        required
                        ></v-text-field>

                         <v-select
                            v-model="id_categori"
                            :items="categori"
                            :rules="[v => !!v || 'Item is required']"
                            label="Kategori"
                            item-text="description"
                            item-value="id"
                            required
                        ></v-select>

                        <p id="dataPages" style="display:none">{{totalPage}}</p>

                        <input type="file" id="foto_profile" ref="foto_profile" accept="" @change="eventChange"> <small>Kosongkan jika tidak ganti file</small>
                        <br>
                        <br>
                        <v-btn color="success" depressed small dark @click="DataDialog=true" >
                                    Tambah Deskripsi
                        </v-btn>

                        <br>
                        <br>
                        <div class="tab-deskripsi" v-if="deskripsi.length > 0">
                            <v-tabs
                            background-color="cyan"
                            dark
                            v-model="tab"
                            next-icon="mdi-arrow-right-bold-box-outline"
                            prev-icon="mdi-arrow-left-bold-box-outline"
                            show-arrows
                            >
                            <v-tabs-slider color="yellow"></v-tabs-slider>
                            <v-tab

                                v-for="(item,index) in deskripsi"
                                :key="index"
                            >
                                {{ item.title }}
                            </v-tab>
                            </v-tabs>


                            <v-tabs-items v-model="tab">
                                <v-tab-item
                                    v-for="(item,index) in deskripsi"
                                    :key="index"
                                >
                                    <v-card>
                                    <v-card-text v-html="item.deskripsi" style="position:relative">


                                    </v-card-text>
                                    <div style="position:absolute;top:0px;right:0px;">
                                         <v-btn @click="edit(index)" depressed dark x-small color="success">
                                                <v-icon dark small>fal fa-pencil</v-icon>
                                        </v-btn>
                                         <v-btn @click="hapus(index)" depressed dark x-small color="red">
                                                <v-icon dark small>fal fa-trash</v-icon>
                                        </v-btn>
                                    </div>

                                    </v-card>
                                </v-tab-item>
                            </v-tabs-items>

                        </div>

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

    <v-dialog
      v-model="DataDialog"
      width="650"
    >
      <v-card
      tile
      >
        <v-card-title
          class="white--text"
          :style="backgroundColor"
          primary-title
        >
          Tambah deskripsi
        </v-card-title>

        <v-card-text>



                <v-text-field
                v-model="deskrip.title"
                label="Title"
                required
                ></v-text-field>

                <tiptap-vuetify
                v-model="deskrip.deskripsi"
                :extensions="extensions"
                />
        </v-card-text>

        <v-divider></v-divider>

        <v-card-actions>
          <v-spacer></v-spacer>
          <v-btn
            color="red"
            tile
            class="white--text"
            @click="cancle()"
          >
            Cancel
          </v-btn>

           <v-btn
            color="success"
            tile
            @click="tambah()"
          >
            Save
          </v-btn>
        </v-card-actions>
      </v-card>
    </v-dialog>
    </v-app>

</template>
<script>
// import {mapActions} from 'vuex'
import BookMixins from '../../mixins/BookMixins'
export default {
    name: 'masterdata.edit',

    mixins:[BookMixins],
    methods:{
        async save(){
            this.totalPage = document.getElementById('dataPages').textContent
            this.loading = true
            let url = window.location.pathname
            url = url.split('/')
            url = `${url[1]}/${url[2]}`
            let data = new FormData()
           data.append('judul',this.judul)
            data.append('penerbit',this.penerbit)
            data.append('file',this.file)
            data.append('kode',this.kode)
            data.append('pages',this.totalPage)
            data.append('harga',this.harga)

            data.append('id_categori',this.id_categori)
            data.append('deskripsi' , JSON.stringify(this.deskripsi))
            data.append('_method','PUT')

            await this.axios.post(url,data,this.config)
            .then((ress) => {
                console.log(ress)
                this.setSnakbar({
                    status:true,
                    pesan:ress.data.message,
                    color_snakbar:'success'
                })
                this.$router.go(-1)
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

        go(){
         let url = window.location.pathname
         this.axios.get(url,this.config)
         .then((ress) => {
             let book = ress.data.book
             this.judul = book.judul
             this.kode = book.kode
             this.harga = book.harga
             this.penerbit = book.penerbit
             this.deskripsi = book.deskripsi
             this.totalPage = book.pages
         })
         .catch((err) => console.log(err.response))
        }

    },

    async created(){
        await this.go()
        this.get_categori()
    }

}
</script>
