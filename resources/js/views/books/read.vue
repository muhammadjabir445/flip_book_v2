<template>
    <v-app>
        <v-container class="container">
            <Flipbook
            class="flipbook"
            :pages="pages"
            :startPage="pageNum"
            v-slot="flipbook"
            ref="flipbook"

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
                    <v-card height="300px">
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
                console.log(res)
                this.data = res.data.data
            })
            .catch((err) => console.log(err.ressponse))
            let foto = this.data.foto.split('/')
            console.log(foto)
            let page_foto = `${document.location.origin}/${foto[3]}/${foto[4]}/${foto[5]}/`


            for (let index = 0; index < this.data.pages; index++) {
                this.pages.push(`${page_foto}/${foto[5]}-${index}.jpg`)

            }
        },
        flip_right() {
            this.$refs.flipbook.flipRight()
        },
        flip_left() {
            this.$refs.flipbook.flipLeft()
        }

    },
    created(){
        this.go()
    },
    mixins:[middleware]
}
</script>

<style scoped>
.viewport{
    position: relative;
}
.flipbook {
    height: 100vh;
    margin: auto !important;
}

.flipbook .img {
    width: 100%;
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
  padding: 10px 0;
  display: flex;
  justify-content: center;
  align-items: center;
  position: absolute;
  bottom: 0px;
  z-index: 100;
}
.container .btn {
  font-size: 30px;
  color: #999;
}
.container .btn:hover{
    cursor: pointer;
}
.container .btn-left {
  position: absolute;
  left: 0px;
  top:50%;
}
.container .btn-right {
  position: absolute;
  right: 0px;
  top:50%;
}
.container .btn svg {
  bottom: 0;
}
.container .btn:not(:first-child) {
  margin-left: 10px;
}
.has-mouse .container .btn:hover {
  color: #ccc;
  filter: drop-shadow(1px 1px 5px #000);
  cursor: pointer;
}
.container .btn:active {
  filter: none !important;
}
.container .btn.disabled {
  color: #666;
  pointer-events: none;
}
.container .page-num {
  font-size: 12px;
  margin-left: 10px;
}
.flipbook .viewport {
  width: 90vw;
  height: calc(100vh - 50px - 40px);
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
