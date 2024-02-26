// Utilities
import {defineStore} from 'pinia'
import {HTTP as axios} from '@/http-common';
import {User} from "@/models/User/User";
import {toRaw} from "vue";

interface IAuthStoreStates {
    accessToken: string;
    error?: string;
    loading: boolean;
    user?: User;
    modifiableUser: User;
}

interface ILoginResponse {
    data: ILoginData;
}

interface ILoginData {
    massage: string;
    token: string;
    user: User;
}

export const authStore = defineStore('auth', {
    state: (): IAuthStoreStates => ({
        accessToken: '',
        error: null,
        loading: false,
        user: null,
        modifiableUser: null,
    }),
    actions: {
        async register(registerData: any) {
            this.loading = true;
            await axios.post('auth/register', {
                ...registerData
            })
                .then((response: any) => {
                    this.loading = false;
                })
                .catch(error => {
                    this.error = error.response.data.error;
                    this.loading = false;
                    throw new Error('Email or Password is incorrect');
                });
        },
        async LogIn(loginData: any) {
            this.loading = true;
            await axios.post('auth/login', {
                ...loginData
            })
                .then((response: any) => {
                    this.user = response.data.user;
                    this.modifiableUser = structuredClone(toRaw(response.data.user));
                    this.accessToken = response.data.token;
                    this.error = null;
                    this.loading = false;
                })
                .catch(error => {
                    this.accessToken = '';
                    this.error = error.response.data.error;
                    this.loading = false;
                    throw new Error('Email or Password is incorrect');
                });
            localStorage.setItem('access_token', this.getAccess);
        },
        async logOut() {
            this.loading = true;
            axios.post('auth/logout')
                .then(response => {
                    localStorage.removeItem('access_token');
                    this.user = null;
                    this.accessToken = '';
                    this.loading = false;
                })
                .catch(error => {
                    localStorage.removeItem('access_token');
                    this.user = null;
                    this.accessToken = '';
                    this.loading = false;
                })
        },
        async updateUser() {
            this.loading = true;
            axios.post('updateUser', {user: this.modifiableUser})
                .then(response => {
                    this.user = response.data.data
                    this.modifiableUser = structuredClone(toRaw(response.data.data));
                    this.loading = false;
                })
                .catch(error => {
                    if (error && error.response.data && error.response.data.errors) {
                        error.value = Object.values(error.response.data.errors)
                    } else {
                        error.value = error.response.data.message || ""
                    }
                    this.loading = false;
                })
        }
    },
    getters: {
        isAuthenticated: (state): boolean => !!state.user,
        getUser: (state): User | null => state.user,
        getAccess: (state): string => state.accessToken,
        isAuthLoading: (state): boolean => state.loading
    },
    persist: true,
})
