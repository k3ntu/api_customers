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
        },
        destroyToken (state) {
            state.accessToken = null
            state.refreshToken = null
        }
    },
    getters: {
        loggedIn (state) {
            return state.accessToken != null
        }
    },
    actions: {
        userLogin (context, usercredentials){
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
        userLogout (context) {
            if (context.getters.loggedIn) {
                context.commit('destroyToken')
            }
        }
    }
})

export default store
