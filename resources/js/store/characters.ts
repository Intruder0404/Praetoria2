// Utilities
import {defineStore} from 'pinia';
import {HTTP as axios} from '@/http-common';

export const charactersStore = defineStore('characters', {
    state: () => ({
        characterLoading: false,
        character: false
    }),
    actions: {
        async update(character) {
            this.loading = true;
            await axios.put('character/update/'+character.id, {character:character})
                .then(response => {
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
        },
    },
    getters: {
        isOptionsLoading(state) {
            return state.characterLoading;
        }
    },
})
