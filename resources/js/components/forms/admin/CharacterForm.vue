<template>
    <v-form ref="familyForm" v-model="valid" lazy-validation>
        <v-card>
            <v-card-title
            >
                {{ character.name }}
            </v-card-title>
            <v-card-text class="d-flex flex-row">
                <div class="v-col-4">
                    {{ character.rank.name }}
                    <v-img width="300" :src="'/rank/'+character.rank.name+'.png'">

                    </v-img>
                </div>
                <div class="v-col-4">
                    <v-text-field v-model="character.name">

                    </v-text-field>
                    <v-autocomplete
                        label="guild"
                        :items="options.guilds"
                        item-title="name"
                        item-value="id"
                        v-model="character.guild_id"
                    >
                    </v-autocomplete>
                    <v-autocomplete
                        label="famille"
                        :items="options.families"
                        item-title="name"
                        item-value="id"
                        v-model="character.family_id"
                    >
                    </v-autocomplete>
                    <v-autocomplete
                        label="religion"
                        :items="options.religions"
                        item-title="name"
                        item-value="id"
                        v-model="character.religion_id"
                    >
                    </v-autocomplete>
                    <v-autocomplete
                        label="rank"
                        :items="options.ranks"
                        item-title="name"
                        item-value="id"
                        v-model="character.rank_id"
                    >
                    </v-autocomplete>
                </div>
            </v-card-text>
            <v-card-actions>
                <v-btn class="v-col-6" variant="flat" color="success" @click="updateCharacter">Change</v-btn>
                <v-btn class="v-col-6" variant="flat" color="error" @click="cancel">Close</v-btn>
            </v-card-actions>
        </v-card>
    </v-form>
</template>
<script lang="ts">
import {mapActions, mapState} from "pinia";
import vtoast from "@/components/stack/vtoast.vue";
import {optionsStore} from "@/store/options";
import {validationStore} from "@/store/validation";
import {characterStore} from "@/store/character";

export default {
    name: "FamilyForm",
    components: {
        vtoast,
    },
    props:{
        character:{
            type:{}
        }
    },
    data() {
        return {
            valid: true,
            loading: false
        };
    },
    computed: {
        ...mapState(optionsStore, ['options']),
        ...mapState(validationStore, ['rules'])
    },
    methods: {
        ...mapActions(optionsStore, {fetchAll:'fetchAll'}),
        ...mapActions(characterStore, {update:'update'}),
        updateCharacter() {
            this.update(this.character)
                .then(this.fetchAll().then(()=>{
                    this.$root.vtoast.color = 'success'
                    this.$root.vtoast.show({message: 'Family saved'})
                    this.$emit('close');
                }));
        },
        cancel() {
            this.$emit('close');
        }
    }
};
</script>
