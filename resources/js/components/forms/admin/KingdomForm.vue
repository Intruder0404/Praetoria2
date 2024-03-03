<template>
    <v-form ref="kingdomForm" v-model="valid" lazy-validation>
        <v-card class="px-4">
            <v-card-title>
                {{ kingdom.name }} Kingdom Management
            </v-card-title>
            <v-card-text>
                <v-row>
                    <v-col cols="12" sm="6" md="6">
                        <v-text-field
                            v-model="kingdom.name"
                            :rules="[rules.required]"
                            label="Name"
                            required
                        ></v-text-field>
                    </v-col>
                    <v-col cols="12" sm="6" md="6">
                        <v-checkbox
                            v-model="kingdom.isActive"
                            label="Active"
                        ></v-checkbox>
                    </v-col>
                </v-row>
                <v-data-table
                    :items="options.characters.filter(c=>c.guild&&c.guild.kingdom?c.guild.kingdom.id === kingdom.id:false)"
                >
                    <template #item.rank="{ value }">
                        {{ value.name }}
                    </template>
                    <template #item.family="{ value }">
                        {{ value.name }}
                    </template>
                    <template #item.religion="{ value }">
                        {{ value.name }}
                    </template>
                </v-data-table>

                <v-card-actions>
                    <v-btn class="v-col-6" variant="flat" color="success" @click="updateKingdom">Change</v-btn>
                    <v-btn class="v-col-6" variant="flat" color="error" @click="cancel">Close</v-btn>
                </v-card-actions>

            </v-card-text>
        </v-card>
    </v-form>
</template>
<script lang="ts">
import {mapActions, mapState} from "pinia";
import vtoast from "@/components/stack/vtoast.vue";
import {optionsStore,kingdomStore,validationStore} from "@/store";

export default {
    name: "KingdomForm",
    components: {
        vtoast,
    },
    props:{
        kingdom:{
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
        ...mapActions(kingdomStore, {update:'update'}),
        updateKingdom() {
            this.update(this.kingdom)
                .then(this.fetchAll().then(()=>{
                    this.$emit('close');
                }));
        },
        cancel() {
            this.$emit('close');
        }
    }
};
</script>
