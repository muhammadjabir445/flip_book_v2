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
                    <img :src="imagePassword" width="100%" alt="">
                </v-col>

                <v-col
                class="col-12 col-sm-6"
                >
                <v-container>
                    <h3>Reset Password</h3>
                     <v-alert
                    text
                    type="error"
                    icon="mdi-cloud-alert"
                    v-if="pesan_error"
                    >
                     {{pesan_error}}
                    </v-alert>
                    <v-form
                        ref="form"
                        v-model="valid"
                        lazy-validation
                        v-if="!pesan_success"

                    >

                        <v-text-field
                        v-model="email"
                        :rules="emailRules"
                        label="E-mail"
                        required
                        v-if="!$route.params.token"
                        ></v-text-field>

                        <v-text-field
                        v-model="password"
                        :rules="nameRules"
                        type="password"
                        label="password"
                        required
                        v-if="$route.params.token"
                        ></v-text-field>

                        <v-text-field
                        v-model="passwordConfirm"
                        :rules="[passwordConfirmRules(password)]"
                        type="password"
                        label="Password Confirmation"
                        required
                        v-if="$route.params.token"
                        ></v-text-field>
                        <br>
                        <v-btn
                        :disabled="!valid"
                        color="pink"
                        class="mr-4 white--text"
                        rounded
                        block
                        :loading="loading"
                        @click="$route.params.token ? gantiPassword() : sendEmail() "
                        depressed
                        >
                        Reset Password
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
                    <div v-else>
                        <h2 v-html="pesan_success"></h2>
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
                    </div>
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
    data() {
        return {
            pesan_success:''
        }
    },
    methods:{
        async sendEmail(){
            this.loading = true
            this.pesan_error = ''
            let data = new FormData
            data.append('email',this.email)
            await this.axios.post(window.location.pathname,data)
            .then((ress) => {
                this.pesan_success = 'Silakan Check Email anda'
            })
            .catch((err) => {
                this.pesan_error = err.response.data.message
            })
            this.loading = false
        },
        async gantiPassword(){
            this.loading = true
            this.pesan_error = ''
            let data = new FormData
            data.append('password',this.password)
            data.append('token',this.$route.params.token)
            await this.axios.post(window.location.pathname,data)
            .then((ress) => {
                this.pesan_success = 'Berhasil reset password silakan <router-link to="/login">Login</router-link>'
            })
            .catch((err) => {
                this.pesan_error = err.response.data.message
            })
            this.loading = false
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
</style>
