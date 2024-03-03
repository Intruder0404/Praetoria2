<template>
    <v-form ref="religionForm" v-model="valid" lazy-validation>
        <v-card class="px-4">
            <v-card-title>
                {{ religion.name }} Family Management
            </v-card-title>
            <v-card-text>
                <v-row>
                    <v-col cols="12" sm="6" md="6">
                        <v-text-field
                            v-model="religion.name"
                            :rules="[rules.required]"
                            label="Name"
                            required
                        ></v-text-field>
                    </v-col>
                    <v-col cols="12" sm="6" md="6">
                        <v-checkbox
                            v-model="religion.isActive"
                            label="Active"
                        ></v-checkbox>
                    </v-col>
                </v-row>
                <v-data-table
                    :items="options.characters.filter(c=>c.religion.id === religion.id)"
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
                    <v-btn class="v-col-6" variant="flat" color="success" @click="updateFamily">Change</v-btn>
                    <v-btn class="v-col-6" variant="flat" color="error" @click="cancel">Close</v-btn>
                </v-card-actions>

            </v-card-text>
        </v-card>
    </v-form>
</template>
<script lang="ts">
import {mapActions, mapState} from "pinia";
import vtoast from "@/components/stack/vtoast.vue";
import {optionsStore} from "@/store/options";
import {validationStore} from "@/store/validation";
import {religionStore} from "@/store/religion";

export default {
    name: "ReligionForm",
    components: {
        vtoast,
    },
    props:{
        religion:{
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
        ...mapActions(religionStore, {update:'update'}),
        updateFamily() {
            this.update(this.religion)
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
