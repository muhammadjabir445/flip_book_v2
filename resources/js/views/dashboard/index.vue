<template>
    <v-container>
        <v-card
             :style="border"
            tile
            outlined
            >
                <v-card-text class="text-center">
                   <v-row justify="center">
                       <v-col
                       cols="12"
                       md="3"
                       >
                        <v-card
                            tile
                            outlined
                        >

                            <v-card-text>
                                <h4>Total User</h4>
                                <h3>{{total_user}}</h3>
                                <v-icon class="icon-dashboard" color="red">fal fa-users</v-icon>
                            </v-card-text>
                        </v-card>
                       </v-col>

                        <v-col
                       cols="12"
                       md="3"
                       >
                        <v-card
                            tile
                            outlined
                        >

                            <v-card-text>
                                <h4>Total Buku Publish</h4>
                                <h3>{{total_buku_publish}}</h3>
                                <v-icon class="icon-dashboard" color="primary">fal fa-book</v-icon>
                            </v-card-text>
                        </v-card>
                       </v-col>

                        <v-col
                       cols="12"
                       md="3"
                       >
                        <v-card
                            tile
                            outlined
                        >

                            <v-card-text>
                                <h4>Total Buku</h4>
                                <h3>{{total_buku}}</h3>
                                <v-icon class="icon-dashboard" color="orange">fal fa-book</v-icon>
                            </v-card-text>
                        </v-card>
                       </v-col>

                        <v-col
                       cols="12"
                       md="3"
                       >
                        <v-card
                            tile
                            outlined
                        >

                            <v-card-text>
                                <h4>Total Kode Aktivasi</h4>
                                <h3>{{total_aktivasi}}</h3>
                                <v-icon class="icon-dashboard" color="blue">fal fa-key</v-icon>

                            </v-card-text>
                        </v-card>
                       </v-col>
                   </v-row>

                   <v-row>
                       <v-col cols="12"
                       md="6"
                       >
                        <v-card
                        tile
                        >
                            <BarChart :height="350" :chartdata="chartData" :options="options" />
                        </v-card>
                       </v-col>
                        <v-col cols="12"
                       md="6"
                       >
                        <v-card
                        tile
                        >
                            <BarChart :height="350" :chartdata="chartData" :options="options" v-if="loading"/>
                        </v-card>
                       </v-col>
                   </v-row>
                </v-card-text>
                <v-card-actions class="">

                </v-card-actions>
            </v-card>
        <!-- <BarChart :height="350" :chartdata="chartData" :options="options" /> -->
    </v-container>

</template>

<script>
import BarChart from '../../components/external/BarChart'
import middleware from '../../mixins/middleware'
export default {
    components:{
        BarChart
    },
    data() {
        return {
            total_user: '',
            total_buku_publish:'',
            total_buku:'',
            total_aktivasi:'',
            loading:false,
            chartData:
                {
                labels:[],
                    datasets: [
                        {
                        label: 'Terpakai',
                        backgroundColor: 'rgba(255, 99, 132, 0.2)',
                        data: []
                        },
                        {
                        label: 'Belum Terpakai',
                        backgroundColor: 'rgba(54, 162, 235, 0.2)',
                        data: []
                        }
                    ],
                },
            options: {
                scales: {
                    yAxes: [{
                        ticks: {
                            beginAtZero: true
                        }
                    }]
                }
            }

        }
    },

    mixins:[middleware],

    methods: {
        async go() {
            await this.axios.get(window.location.pathname,this.config)
            .then((ress) => {
                console.log(ress)
                let data = ress.data
                this.total_user = data.total_user
                this.total_buku_publish = data.total_buku_publish
                this.total_buku = data.total_buku
                this.total_aktivasi = data.total_aktivasi
                let terpakai = []
                data.total_kode.forEach(x => {
                    var judul = x.judul.slice(0,20) + '...'
                     this.chartData.labels.push(judul)

                     this.chartData.datasets[0].data.push(x.total_aktive)
                     this.chartData.datasets[1].data.push(x.total_nonaktive)
                });

            })

            this.loading = true

        }
    },

    created() {
        this.go()
    }
}
</script>

<style scoped>
    .icon-dashboard{
        font-size: 50px;
        position: absolute;
        top: 5px;
        right: 10px;
        opacity: 0.1;
    }
</style>
