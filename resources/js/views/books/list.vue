<template>
    <v-app>
        <Progress v-if="loading"/>
        <v-container v-if="!loading">
            <BtnJudul text="List Buku CV EKA PRIMA MANDIRI"/>

            <v-card
             :style="border"
            tile
             outlined
            >
                <v-card-text class="text-center">
                     <v-text-field
                                v-model="keyword"
                                label="Pencarian"
                                v-on:keyup ="go(page)"
                                :color="color"
                    ></v-text-field>
                     <v-row
                    justify="center"
                    >
                        <v-col
                        cols="12"
                        md="3"
                        v-for="item in data"
                        :key="item.id"
                        style="height:420px !important"
                        >
                            <v-card
                            tile
                            height="100%"
                            to="my-book/activation"
                            style="cursor:pointer"
                            >
                                <v-img


                                :src="item.foto"
                                ></v-img>

                                <!-- <v-card-title>{{item.judul}}</v-card-title> -->
                                <v-divider class="mx-4"></v-divider>

                                <v-card-actions align-center height="100%">
                                 <small :color="color" style="font-weight:bold;margin: 0 auto" class="text-center">{{item.judul}}</small>

                                </v-card-actions>
                            </v-card>
                        </v-col>
                    </v-row>
                </v-card-text>
                <PaginateComponent :page="page" :lengthpage="lengthpage" v-on:go="go"/>
                <v-card-actions class="">

                </v-card-actions>
            </v-card>
        </v-container>
    </v-app>

</template>
<script>

import CrudMixin from '../../mixins/CrudMixin'
export default {
    name: 'books-list',
    mixins:[CrudMixin],
    methods: {
    }
}
</script>

