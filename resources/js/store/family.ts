// Utilities
import {defineStore} from 'pinia'
import {HTTP as axios} from '@/http-common';
import {User} from "@/models/User/User";
import {toRaw} from "vue";

interface IFamilyStoreStates {
}


export const familyStore = defineStore('family', {
    state: (): IFamilyStoreStates => ({
    }),
    actions: {
        async add(family){
            this.loading = true;
            const {data} = await axios.post('family/add', {family});
            this.loading = false;
            return data.data;
        },
        async update(family){
            this.loading = true;
            const {data} = await axios.put('family/update/'+family.id, {family});
            this.loading = false;
            return data.data;
        },
        async delete(family){
            this.loading = true;
            const {data} = await axios.delete('family/delete/'+family.id);
            this.loading = false;
            return data.data;
        }
    },
    getters: {
    },
    persist: true,
})
