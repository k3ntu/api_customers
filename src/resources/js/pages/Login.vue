<template>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Login</div>

                    <div class="card-body">

                        <div class="row mb-3">
                            <label for="email" class="col-md-4 col-form-label text-md-end">Email</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control" v-model="state.userForm.email" required autocomplete="email" autofocus>

                                <span v-show="state.errorMessage.length > 0" class="invalid-feedback" role="alert">
                                    <strong>{{ state.errorMessage }}</strong>
                                </span>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="password" class="col-md-4 col-form-label text-md-end">
                                Password
                            </label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control" v-model="state.userForm.password" required autocomplete="current-password">

                                <span v-show="state.errorMessage.length > 0" class="invalid-feedback" role="alert">
                                    <strong>{{ state.errorMessage }}</strong>
                                </span>

                            </div>
                        </div>

                        <div class="row mb-0">
                            <div class="col-md-8 offset-md-4">
                                <button type="submit" class="btn btn-primary" @click="doLogin">
                                    Login
                                </button>

                                <router-link to="/register" class="btn btn-link">
                                    Sign in
                                </router-link>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
</template>

<script>
import { reactive, onMounted } from 'vue'
import { useToast } from 'vue-toastification'
import store from './../store'
import router from './../routes/router'

export default {
    setup(_, context) {
        const toast = useToast();

        const state = reactive({
            loading: false,
            userForm: {
                email: '',
                password: '',
            },
            errorMessage: '',
        })

        const doLogin = async () => {

            await store.dispatch('userLogin', state.userForm)
                .then((res) => {
                    if (res.status === 200) {
                        toast.success('Login successfully!')
                        router.push('/home');
                    }
                }).catch(err => {
                    toast.error('User not found!!!')
                });
        }

        return {
            state,
            doLogin,
        }
    }
}
</script>

