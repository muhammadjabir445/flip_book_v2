<template>
    <v-app>
        <v-container class="container fw">
            <Flipbook
            class="flipbook"
            :pages="pages"
            :startPage="pageNum"
            v-slot="flipbook"
            ref="flipbook"
            style="margin:0px"
            >
            <div class="action-bar">
                <!-- <left-icon
                class="btn left btn-left"
                :class="{ disabled: !flipbook.canFlipLeft }"
                @click="flipbook.flipLeft"
                /> -->
                <plus-icon
                class="btn plus"
                :class="{ disabled: !flipbook.canZoomIn }"
                @click="flipbook.zoomIn"
                />
                <span class="page-num">
                Page {{ flipbook.page }} of {{ flipbook.numPages }}
                </span>
                <minus-icon
                class="btn minus"
                :class="{ disabled: !flipbook.canZoomOut }"
                @click="flipbook.zoomOut"
                />
                <!-- <right-icon
                class="btn right btn-right"
                :class="{ disabled: !flipbook.canFlipRight }"
                @click="flipbook.flipRight"
                /> -->
            </div>
            </Flipbook>
            <left-icon
                class="btn left btn-left"
                @click="flip_left"

            />
            <right-icon
                class="btn right btn-right"
                @click="flip_right"

            />
        </v-container>
            <v-container>
                <div class="tab-deskripsi" v-if="data.deskripsi.length > 0">
            <v-tabs
            :background-color="color"
            dark
            v-model="tab"
            next-icon="mdi-arrow-right-bold-box-outline"
            prev-icon="mdi-arrow-left-bold-box-outline"
            show-arrows
            >
            <v-tabs-slider color="white"></v-tabs-slider>
            <v-tab

                v-for="(item,index) in data.deskripsi"
                :key="index"
            >
                {{ item.title }}
            </v-tab>
            </v-tabs>


            <v-tabs-items v-model="tab">
                <v-tab-item
                    v-for="(item,index) in data.deskripsi"
                    :key="index"
                >
                    <v-card>
                    <v-card-text v-html="item.deskripsi" style="position:relative">


                    </v-card-text>

                    </v-card>
                </v-tab-item>
            </v-tabs-items>

            </div>
            </v-container>
    </v-app>

</template>
<script>
import middleware from '../../mixins/middleware'
import 'vue-material-design-icons/styles.css'
import LeftIcon from 'vue-material-design-icons/ChevronLeftCircle'
import RightIcon from 'vue-material-design-icons/ChevronRightCircle'
import PlusIcon from 'vue-material-design-icons/PlusCircle'
import MinusIcon from 'vue-material-design-icons/MinusCircle'
import Flipbook from 'flipbook-vue'
export default {
    name: 'by-book.read',
    data() {
        return {
            loading:true,
            totalPage:0,
            pages:[null],
            pageNum:0,
            judul_buku:'',
            data:{}
        }
    },
    components: { Flipbook, LeftIcon, RightIcon, PlusIcon, MinusIcon },
    methods:{
        async go() {
            let url = window.location.pathname
            await this.axios.get(url,this.config)
            .then((res) => {

                this.data = res.data.data
            })
            .catch((err) => console.log(err.ressponse))
            let foto = this.data.foto.split('/')

            let page_foto = `${document.location.origin}/${foto[3]}/${foto[4]}/${foto[5]}/`


            for (let index = 0; index < this.data.pages; index++) {
                this.pages.push(`${page_foto}/${foto[5]}-${index}.jpg`)

            }
        },
        flip_right() {
            this.$refs.flipbook.flipRight()
            // console.log(this.data.status_read)
            // console.log(this.$refs.flipbook.page)
             if (this.data.status_read == 1 && this.$refs.flipbook.page >= 10) {
                this.$router.push({name:'mybook.aktivasi'})
            }

        },
        flip_left() {
            this.$refs.flipbook.flipLeft()

            // this.$refs.flipbook.startPage = 4
            // console.log(this.$refs.flipbook.numPages)
        }

    },
   mounted(){
       this.$watch(() => {
           if (this.data.status_read == 1 && this.$refs.flipbook.page >= 10) {
                this.$router.push({name:'mybook.aktivasi'})
            }
           return this.$refs.flipbook.page
       },
       (val) => {
            return val
        }
       )
   },
    created(){
        this.go()
    },
    mixins:[middleware]
}
</script>

<style lang="css" scoped>
/* .viewport{
    height: 100vh;
    position: relative;
} */
@media(min-width:1024px) {
    .flipbook {
    height: 100vh !important;
    margin: auto !important;
    /* margin-top: 0px !important; */
    }

}

@media(max-width:1023px) {
   .flipbook {
    height: 100vh;
    margin-top: -30% !important;
    }
    .fw .btn-left {
    margin-top: -20% !important;
    }
    .fw .btn-right {
    margin-top: -20% !important;
    }
    .action-bar {

    bottom: 40px !important;

    }
}

@media(width:411px) and (height:823px) {
   .flipbook {
    height: 100vh;
    margin-top: -40% !important;
    }
    .fw .btn-left {
 margin-top: -30% !important;
    }
    .fw .btn-right {
   margin-top: -30% !important;
    }

    .action-bar {

    bottom: 100px !important;

    }

}

@media(width:540px) and (height:720px) {
    .flipbook {
    height: 100vh !important;
    margin: auto !important;
    /* margin-top: 0px !important; */
    }

}

@media(width:375px) and (height:812px) {
   .flipbook {
    height: 100vh;
    margin-top: -45% !important;
    }

    .fw .btn-left {
    margin-top: -32% !important;
}
.fw .btn-right {
    margin-top: -32% !important;
}
}

@media(width:280px) and (height:653px) {
   .flipbook {
    height: 100vh;
    margin-top: -60% !important;
    }

    .fw .btn-left {
    margin-top: -40% !important;
}
.fw .btn-right {
    margin-top: -40% !important;
}
}
/* @media only screen and (max-height:653px) {
    .flipbook {
    height: 40vh;
        margin: auto !important;

    }

} */

.flipbook img {
    height: 100vh;
    width:100vh
}

a {
  color: inherit;
}
.container {
    position: relative;
}
.action-bar {
  width: 100%;
  height: 30px;
  /* padding: 10px 0; */
  display: flex;
  justify-content: center;
  align-items: center;
  position: absolute;
  bottom: 0px;
  z-index: 2;
}
.fw .btn {
  font-size: 30px;
  color: #999;
}
.fw .btn:hover{
    cursor: pointer;
}
.fw .btn-left {
  position: absolute;
  left: 0px;
  top:50%;
}
.fw .btn-right {
  position: absolute;
  right: 0px;
  top:50%;
}
.fw .btn svg {
  bottom: 0;
}
.fw .btn:not(:first-child) {
  margin-left: 10px;
}
.has-mouse .container .btn:hover {
  color: #ccc;
  filter: drop-shadow(1px 1px 5px #000);
  cursor: pointer;
}
.fw .btn:active {
  filter: none !important;
}
.fw .btn.disabled {
  color: #666;
  pointer-events: none;
}
.fw .page-num {
  font-size: 12px;
  margin-left: 10px;
}
.flipbook .viewport {
  width: 90vw;
  /* height: 100vw !important; */
}
.flipbook .bounding-box {
  box-shadow: 0 0 20px #000;
}
.credit {
  font-size: 12px;
  line-height: 20px;
  margin: 10px;
}
</style>
