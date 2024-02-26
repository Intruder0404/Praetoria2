<template>
    <v-card class="px-4">
        <v-card-title>
            Account Modification
        </v-card-title>
        <v-card-text>
            <div class="d-flex flex-wrap justify-space-around" v-if="!selectedCharacter">
                <v-card
                    class="v-col-2" v-for="(character,idx) in user.characters"
                    :key="idx"
                    color="primary"
                    hover
                >
                    <v-card-title
                    >
                        {{ character.name }}
                    </v-card-title>
                    <v-card-text>
                        <v-img :src="'/rank/'+character.rank.name+'.png'">

                        </v-img>
                    </v-card-text>
                    <v-card-actions>
                        <v-btn color="surface-variant" variant="text" icon="mdi-heart"></v-btn>

                        <v-btn color="surface-variant" variant="text" icon="mdi-cog-outline"
                               @click="changeCharacter(character)"></v-btn>
                    </v-card-actions>
                </v-card>
            </div>
            <v-card v-else>
                <v-card-title
                >
                    {{ selectedCharacter.name }}
                </v-card-title>
                <v-card-text class="d-flex flex-row">
                    <div class="v-col-4">
                        {{ selectedCharacter.rank.name }}
                        <v-img width="300" :src="'/rank/'+selectedCharacter.rank.name+'.png'">

                        </v-img>
                    </div>
                    <div class="v-col-4">
                        <v-autocomplete
                            label="famille"
                            :items="getOptions.families"
                            item-title="name"
                            return-object
                            v-model="selectedCharacter.family"
                        >
                        </v-autocomplete>
                        <v-autocomplete
                            label="religion"
                            :items="getOptions.religions"
                            item-title="name"
                            return-object
                            v-model="selectedCharacter.religion"
                        >
                        </v-autocomplete>
                        <v-autocomplete
                            label="rank"
                            :items="getOptions.ranks"
                            item-title="name"
                            return-object
                            v-model="selectedCharacter.rank"
                        >
                        </v-autocomplete>
                    </div>
                </v-card-text>
                <v-card-actions>
                    <v-btn color="surface-variant" variant="text" icon="mdi-check"
                           @click="updateSelectedCharacter"></v-btn>

                    <v-btn color="surface-variant" variant="text" icon="mdi-cancel"
                           @click="cancelCharacterChange"></v-btn>
                </v-card-actions>
            </v-card>
        </v-card-text>
    </v-card>
</template>
<script lang="ts">
import {toRaw} from "vue";
import {mapActions, mapState} from "pinia";
import {authStore} from "@/store/auth";
import {optionsStore} from "@/store/options";
import {charactersStore} from "@/store/characters";

export default {
    name: "App",
    components: {},
    data() {
        return {
            selectedCharacter: null,
        };
    },
    mounted() {
        this.$root.vtoast = this.$refs.vtoast
    },
    computed: {
        ...mapState(authStore, ['user']),
        ...mapState(optionsStore, ['getOptions']),
    },
    methods: {
        ...mapActions(charactersStore, ['update']),
        updateSelectedCharacter() {
            this.update(this.selectedCharacter).then(()=>{
                let index = this.getOptions.characters.findIndex(c=>c.id === this.selectedCharacter.id);
                this.getOptions.characters[index] = this.selectedCharacter;
                this.selectedCharacter = null;
            })
        },
        changeCharacter(newChar) {
            this.selectedCharacter = newChar
        },
        changeRank(rank) {
            this.selectedCharacter.rank = rank
        },
        cancelCharacterChange() {
            /*let index = this.characters.findIndex(c=>c.id === this.selectedCharacter.id);
            if(index != -1)
              this.characters[index] = structuredClone(toRaw(this.selectedCharacter));*/
            this.selectedCharacter = null;
        },
        ...mapActions(charactersStore, ['getCharactersByUser', 'updateCharacter'])
    }
};
</script>
