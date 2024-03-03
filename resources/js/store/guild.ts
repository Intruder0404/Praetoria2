// Utilities
import {defineStore} from 'pinia'
import {HTTP as axios} from '@/http-common';
import {User} from "@/models/User/User";
import {toRaw} from "vue";

interface IGuildStoreStates {
}


export const guildStore = defineStore('guild', {
    state: (): IGuildStoreStates => ({
    }),
    actions: {
        async add(guild){
            this.loading = true;
            const {data} = await axios.post('guild/add', {guild});
            this.loading = false;
            return data.data;
        },
        async update(guild){
            this.loading = true;
            const {data} = await axios.put('guild/update/'+guild.id, {guild});
            this.loading = false;
            return data.data;
        },
        async delete(guild){
            this.loading = true;
            const {data} = await axios.delete('guild/delete/'+guild.id);
            this.loading = false;
            return data.data;
        }
    },
    getters: {
    },
    persist: true,
})
