// Utilities
import {defineStore} from 'pinia'
import {HTTP as axios} from '@/http-common';
import {User} from "@/models/User/User";
import {toRaw} from "vue";

interface IReligionStoreStates {
}


export const religionStore = defineStore('religion', {
    state: (): IReligionStoreStates => ({
    }),
    actions: {
        async add(religion){
            this.loading = true;
            const {data} = await axios.post('religion/add', {religion});
            this.loading = false;
            return data.data;
        },
        async update(religion){
            this.loading = true;
            const {data} = await axios.put('religion/update/'+religion.id, {religion});
            this.loading = false;
            return data.data;
        },
        async delete(religion){
            this.loading = true;
            const {data} = await axios.delete('religion/delete/'+religion.id);
            this.loading = false;
            return data.data;
        }
    },
    getters: {
    },
    persist: true,
})
