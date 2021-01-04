<template>
    <div width="600px" height="100%" class="container-auth">
    <v-container>
        <v-card
        class="card-auth"
        >
            <v-row
            justify="center"
            align="center"
            >
                <v-col
                class="col-12 col-sm-6"
                >
                    <img :src="imageRegister" width="100%" alt="">
                </v-col>

                <v-col
                class="col-12 col-sm-6"
                >
                <v-container>
                    <h3>Register</h3>
                     <v-alert
                    text
                    type="error"
                    icon="mdi-cloud-alert"
                    v-if="pesan_error"
                    >
                     {{pesan_error}}
                    </v-alert>

                     <v-alert
                    text
                    type="success"

                    v-if="pesan_success"
                    >
                     {{pesan_success}}
                    </v-alert>
                    <v-form
                        ref="form"
                        v-model="valid"
                        lazy-validation
                        v-if="pesan_success == ''"
                    >
                        <v-text-field
                        v-model="name"
                        :rules="nameRules"
                        label="Name"
                        required
                        ></v-text-field>
                           <div style="position:relative;width:100%">
                            <v-text-field
                            v-model="sekolah"
                            :rules="sekolahRules"
                            label="Sekolah"
                            required
                            @keyup="getSekolah"
                            style="position:relative"
                            >
                            </v-text-field>
                            <div class="list-barang" v-if="sekolahs.length > 0">
                                <ul>
                                    <li v-for="item in sekolahs" :key="item.sekolah" @click="select_sekolah(`${item.sekolah}`)">{{item.sekolah}}</li>
                                </ul>
                            </div>
                        </div>

                        <v-text-field
                        v-model="email"
                        :rules="emailRules"
                        label="E-mail"
                        required
                        ></v-text-field>



                        <v-text-field
                        v-model="password"
                        :rules="passwordRules"
                        type="password"
                        label="password"
                        required
                        ></v-text-field>

                        <v-text-field
                        v-model="passwordConfirm"
                        :rules="[passwordConfirmRules(password)]"
                        type="password"
                        label="Password Confirmation"
                        required
                        ></v-text-field>
                        <br>
                        <v-btn
                        :disabled="!valid"
                        color="pink"
                        class="mr-4 white--text"
                        rounded
                        block
                        :loading="loading"
                        @click="register"
                        depressed
                        >
                        Register
                        </v-btn>
                        <br>
                        <v-btn
                        :color="color"
                        class="mr-4 white--text"
                        rounded
                        block
                        to="/login"
                        depressed
                        >
                        Log-in
                        </v-btn>
                    </v-form>
                </v-container>

                </v-col>
            </v-row>
        </v-card>

    </v-container>

    </div>
</template>

<script>
import AuthMixin from '../mixins/AuthMixin'


export default {
    mixins:[AuthMixin],
    methods:{
        select_sekolah(sekolah){
            this.sekolah = sekolah
            this.sekolahs = []
        }
    }
}
</script>

<style scoped>
 .container-auth{
     display: flex;
 }
 .card-auth{
     margin: 0 auto;
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
