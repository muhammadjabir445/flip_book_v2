<template>
  <div class="text-center">
    <v-dialog
      v-model="dialog_detail"
      width="900"
      @click:outside="close"
      @keydown.esc="close"
    >
      <v-card>
        <v-card-title :color="color">
          Detail Kode Aktivasi
        </v-card-title>

        <v-card-text>
            <v-container>
                <v-row justify="center" align="center">
                    <v-col
                        cols="12"
                    >
                    <v-text-field
                        v-model="keyword"
                        label="Pencarian"
                        v-on:keyup ="go_detail(page)"
                        :color="color"
                    ></v-text-field>
                    </v-col>
                </v-row>
            </v-container>

            <v-simple-table v-if="data !== []">
                <thead>
                    <tr>
                    <th class="text-left">No</th>
                    <th class="text-left">Kode</th>
                    <th class="text-left">Status</th>
                    <th class="text-left">User</th>
                    </tr>
                </thead>
                <tbody>
                    <tr v-for="(item,index) in data" :key="item.id">
                        <td class="text-left">{{ page | nomor(++index)}}</td>
                        <td class="text-left">{{item.kode}}</td>
                        <td class="text-left">{{item.status_code}}</td>
                        <td class="text-left">{{item.user ? item.user.name : item.status_code}}</td>
                    </tr>
                </tbody>
            </v-simple-table>
        </v-card-text>
 <PaginateComponent :page="page" :lengthpage="lengthpage" v-on:go="go_detail"/>
        <v-divider></v-divider>

        <v-card-actions>
          <v-spacer></v-spacer>
          <v-btn
            color="primary"
            text
            @click="close()"
          >
            Close
          </v-btn>
        </v-card-actions>
      </v-card>
    </v-dialog>
  </div>
</template>

<script>
import {mapActions, mapGetters} from 'vuex'
import middleware from '../../mixins/middleware'
export default {
    name: 'DetailAktivasi',
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

    // components:{
    //     'Progress' : Progress
    // },

    mixins:[middleware],
    props:{
        dialog_detail:Boolean,
        id_aktivasi:Number
    },
    methods:{
        close(){
            this.$emit('close')
            this.data = []
        },

        async go_detail(page = null){
            let url = 'aktivasi/' + this.id_aktivasi
            this.page = page == null ? this.page : page
            if(this.page > 1) {
                url = url + '?page=' +this.page + "&keyword=" + this.keyword
            }else{
                url = url + "?keyword=" + this.keyword
            }
            if (this.dialog_detail && this.id_aktivasi !== 0 && this.data) {
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
            } else {
                this.data = []
            }
        },
    },

    filters:{
        nomor: function(page,index) {
            let number = index
            if(page > 1 ) {
                number  = page - 1
                number = `${number}0`
                number = parseInt(number) + index
            } else {
                number = index
            }

            return number
        }
    },
    watch: {
    // whenever question changes, this function will run
         id_aktivasi: function (newQuestion, oldQuestion) {
            this.go_detail(this.page)
        }
    },

    beforeUpdate(){

    }
}
</script>

<style>

</style>
