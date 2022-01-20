import Vuex from 'vuex'
import axios from 'axios'

const store = new Vuex.Store({
    state: {
        accessToken: null,
        refreshToken: null,
    },
    mutations: {
        updateStorage (state, { access, refresh }) {
            state.accessToken = access
            state.refreshToken = refresh
            localStorage.setItem( 'token', JSON.stringify(state.accessToken) );
        },
        destroyToken (state) {
            state.accessToken = null
            state.refreshToken = null
        }
    },
    getters: {
        loggedIn (state) {
            return state.accessToken != null
        },
        async token()   {
            return await JSON.parse( localStorage.getItem('token') );
        },
        bearerToken(state) {
            return 'Bearer ' + state.accessToken;
        }
    },
    actions: {
        userLogin (context, usercredentials) {
            return new Promise((resolve, reject) => {
                const data = {
                    email: usercredentials.email,
                    password: usercredentials.password
                }

                const config = {
                    headers: {
                        'Accept': 'application/json'
                    }
                };
                axios.post('/api/login', data, config)
                    .then(response => {
                        context.commit('updateStorage', { access: response.data['access_token'], refresh: '' })
                        resolve({ status: 200 })
                    })
                    .catch(err => reject(err))
            })
        },
        userRegister (context, usercredentials){
            return new Promise((resolve, reject) => {
                const data = {
                    name: usercredentials.name,
                    email: usercredentials.email,
                    password: usercredentials.password,
                    password_confirmation: usercredentials.password_confirmation
                }

                const config = {
                    headers: {
                        'Accept': 'application/json'
                    }
                };
                axios.post('/api/register', data, config)
                    .then(response => {
                        context.commit('updateStorage', { access: response.data['access_token'], refresh: '' })
                        resolve({ status: 200 })
                    })
                    .catch(err => reject(err))
            })
        },
        userLogout (context) {
            if (context.getters.loggedIn) {
                context.commit('destroyToken')
            }
        }
    }
})

export default store
