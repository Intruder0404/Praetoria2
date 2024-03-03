<template>
    <v-card class="px-4">
        <v-card-title>
            Character management
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
                <v-card
                    class="v-col-2"
                    color="primary"
                >
                    <v-card-text class="h-100">
                        <v-btn
                            color="primary"
                            hover
                            class="w-100 h-100"
                        >
                            <v-icon @click="createCharacter">
                                mdi-plus
                            </v-icon>
                        </v-btn>
                    </v-card-text>
                </v-card>
            </div>
            <character-form v-else @close="selectedCharacter=null" :character="selectedCharacter"></character-form>
        </v-card-text>
    </v-card>
</template>
<script lang="ts">
import {mapActions, mapState} from "pinia";
import {optionsStore,characterStore,authStore} from "@/store";
import {Character} from "@/models/Character/Character";
import {CharacterForm} from "@/components";

export default {
    name: "App",
    components: {
        CharacterForm
    },
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
        ...mapState(optionsStore, ['options']),
    },
    methods: {
        ...mapActions(characterStore, ['add','update']),
        createCharacter(){
            let newChar = new Character();
            newChar.id = 0;
            newChar.user_id = this.user.id;
            newChar.name = '';
            newChar.rank = this.options.ranks.find(r=>r.id=1);
            this.selectedCharacter = newChar;
        },
        addNewCharacter(){
            this.add(this.selectedCharacter).then((newCharacter)=>{
                this.options.characters.push(newCharacter);
                this.user.characters.push(newCharacter);
                this.selectedCharacter = null;
            });
        },
        updateSelectedCharacter() {
            this.update(this.selectedCharacter).then(()=>{
                let index = this.options.characters.findIndex(c=>c.id === this.selectedCharacter.id);
                this.options.characters[index] = this.selectedCharacter;
                this.selectedCharacter = null;
            })
        },
        changeCharacter(newChar) {
            this.selectedCharacter = newChar
        },
        cancelCharacterChange() {
            this.selectedCharacter = null;
        }
    }
};
</script>
