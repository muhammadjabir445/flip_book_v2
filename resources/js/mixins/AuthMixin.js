import {mapActions,mapGetters} from 'vuex'
import store from '../stores'
import axios from 'axios'

export default {
    name: 'Login',
     data: () => ({
      valid: false,
      password: '',
      nameRules: [
        v => !!v || 'Password is required',

      ],
      name:'',
      email: '',
      emailRules: [
        v => !!v || 'E-mail is required',
        v => /.+@.+\..+/.test(v) || 'E-mail must be valid',
      ],
      passwordConfirm:'',
      passwordConfirmRules(password){
          return v => v === password || 'Harus sama'
      },
      pesan_error:'',
      loading:false
    }),

    methods : {
        ...mapActions({
            setAuth:'auth/setAuth',
            setSnakbar:'snakbar/setSnakbar'
        }),

        async login(){
            this.loading = true
            let data = new FormData()
            data.append('email',this.email)
            data.append('password',this.password)
            await this.axios.post('/login',data)
            .then((ress) => {
                this.setAuth({
                    user: ress.data.user,
                    token : ress.data.access_token,
                    menu : ress.data.menu
                })
                localStorage.setItem('token', this.token);

                this.$router.push('/dahsboard')
            })
            .catch((err) =>{
                this.setSnakbar({
                    color_snakbar:'red',
                    pesan : 'Email atau Password salah',
                    status : true
                })
            })
            this.loading = false
        },
        async register(){
            this.loading = true
            this.pesan_error = ''
            let data = new FormData()
            data.append('email',this.email)
            data.append('password',this.password)
            data.append('name',this.name)
            await this.axios.post('/register',data)
            .then((ress) => {
                console.log(ress)
                this.setAuth({
                    user: ress.data.user,
                    token : ress.data.access_token,
                    menu : ress.data.menu
                })
                localStorage.setItem('token', this.token);

                this.$router.push('/dahsboard')
            })
            .catch((err) =>{
                console.log(err.response)
                // this.setSnakbar({
                //     color_snakbar:'red',
                //     pesan : 'Email atau Password salah',
                //     status : true
                // })
                this.pesan_error = err.response.data.message
            })
            this.loading = false
        }
    },
    computed: {
        ...mapGetters({
            user:'auth/user',
            menu: 'auth/menu',
            token : 'auth/token',
            beforeUrl : 'BeforeUrl/url',
            color: 'color/color'
        }),
        imageLogin(){
            return document.location.origin+'/login.jpg'
        },
        imageRegister(){
            return document.location.origin+'/register.jpg'
        }
    },
    async beforeRouteEnter(to, from, next){
        // console.log(to)
        // console.log(from)
        // console.log(next)
        let token = localStorage.getItem('token')
        let config = {
            headers: {
            'Authorization': 'Bearer ' + token,
            }
        }
        if (token) {
            await axios.get('/api/me',config)
            .then((ress) =>{
                store.dispatch('auth/setAuth',{
                    user: ress.data.user,
                    token : ress.data.access_token,
                    menu : ress.data.menu
                })
                next('login')
            }
                )
            .catch((err) =>console.log(err))
        }
        next()
    },
//    async beforeMount(){
//        let token = localStorage.token
//        if (token) {
//            let config = {
//                 headers: {
//                 'Authorization': 'Bearer ' + token,
//                 }
//             }
//             await this.axios.get('/me',config)
//                 .then((ress) =>{
//                     console.log(ress.data)
//                 }
//                     )
//                 .catch((err) =>console.log(err))
//        }
//     }

}
