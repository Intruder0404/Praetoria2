// Utilities
import {defineStore} from 'pinia';
import {HTTP as axios} from '@/http-common';

export const characterStore = defineStore('character', {
    state: () => ({
        characterLoading: false,
        character: false
    }),
    actions: {
        async update(character) {
            this.loading = true;

            this.loading = true;
            const {data} = await axios.put('character/update/'+character.id, {character});
            this.loading = false;
            return data.data;
        },
        async add(character) {
            this.loading = true;
            const {data} = await axios.post('character/add', {character:character});
            this.loading = false;
            return data.data;
        },
        async delete(character){
            this.loading = true;
            const {data} = await axios.delete('character/character/'+character.id);
            this.loading = false;
            return data.data;
        },
    },
    getters: {
        isOptionsLoading(state) {
            return state.characterLoading;
        }
    },
})
