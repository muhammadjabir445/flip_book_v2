<template>
    <div width="600px">
    <v-container>
        <v-card>
            <v-row
            justify="center"
            align="center"
            >
                <v-col
                class="col-12 col-sm-6"
                >
                    <img :src="imageLogin" width="100%" alt="">
                </v-col>

                <v-col
                class="col-12 col-sm-6"
                >
                <v-container>
                    <h3>Login</h3>

                    <v-form
                        ref="form"
                        v-model="valid"
                        lazy-validation
                    >
                        <!-- <v-text-field
                        v-model="name"
                        :counter="10"
                        :rules="nameRules"
                        label="Name"
                        required
                        ></v-text-field> -->

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
                        <small ><router-link to="/reset-password"> Lupa password ?</router-link></small>
                        <br>
                        <br>
                        <v-btn
                        :disabled="!valid"
                        :color="color"
                        class="mr-4 white--text"
                        rounded
                        block
                        depressed
                        :loading="loading"
                        @click="login"
                        >
                        Log-in
                        </v-btn>
                        <br>

                        <v-btn
                        class="mr-4 white--text"
                        rounded
                        block
                        depressed
                        color="pink"
                        to="/register"
                        >
                        Register
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

<style>

</style>
