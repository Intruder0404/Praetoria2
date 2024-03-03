// Utilities
import {defineStore} from 'pinia'
import {HTTP as axios} from '@/http-common';
import {User} from "@/models/User/User";
import {toRaw} from "vue";

interface IUserStoreStates {
}
export const userStore = defineStore('user', {
    state: (): IUserStoreStates => ({
    }),
    actions: {
        async add(user){
            this.loading = true;
            const {data} = await axios.post('user/add', {user});
            this.loading = false;
            return data.data;
        },
        async update(user){
            this.loading = true;
            const {data} = await axios.put('user/update/'+user.id, {user});
            this.loading = false;
            return data.data;
        },
        async delete(user){
            this.loading = true;
            const {data} = await axios.delete('user/delete/'+user.id);
            this.loading = false;
            return data.data;
        }
    },
    getters: {
    },
    persist: true,
})
