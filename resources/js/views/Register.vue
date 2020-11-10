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
                    <v-form
                        ref="form"
                        v-model="valid"
                        lazy-validation
                    >
                        <v-text-field
                        v-model="name"
                        :rules="nameRules"
                        label="Name"
                        required
                        ></v-text-field>

                        <v-text-field
                        v-model="email"
                        :rules="emailRules"
                        label="E-mail"
                        required
                        ></v-text-field>

                        <v-text-field
                        v-model="password"
                        :rules="nameRules"
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
    mixins:[AuthMixin]
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
