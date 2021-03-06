import { Line } from 'vue-chartjs'
export default {
  data(){
    return{

    }
  },
  props: {
    chartdata: {
      type: Object,
      default: null
    },
    options:{
      type: Object,
      default: null
    }
  },
  extends: Line,
  mounted () {
    this.renderChart(this.chartdata, this.options)
  }
}
