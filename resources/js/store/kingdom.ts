// Utilities
import {defineStore} from 'pinia'
import {HTTP as axios} from '@/http-common';
import {User} from "@/models/User/User";
import {toRaw} from "vue";

interface IKingdomStoreStates {
}


export const kingdomStore = defineStore('kingdom', {
    state: (): IKingdomStoreStates => ({
    }),
    actions: {
        async add(kingdom: any){
            this.loading = true;
            const {data} = await axios.post('kingdom/add', {kingdom});
            this.loading = false;
            return data.data;
        },
        async update(kingdom: any){
            this.loading = true;
            const {data} = await axios.put('kingdom/update/'+kingdom.id, {kingdom});
            this.loading = false;
            return data.data;
        },
        async delete(kingdom: any){
            this.loading = true;
            const {data} = await axios.delete('kingdom/delete/'+kingdom.id);
            this.loading = false;
            return data.data;
        }
    },
    getters: {
    },
    persist: true,
})
