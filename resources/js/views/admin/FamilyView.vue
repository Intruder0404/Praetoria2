<template>
    <v-form ref="familyForm" v-model="valid" lazy-validation>
        <v-card class="px-4">
            <v-card-title>
                {{ family.name }} Family
            </v-card-title>
            <v-card-text class="d-flex flex-wrap">
                <div class="v-col-2">
                    {{ family.animal }}
                </div>
                <div class="v-col-2">
                    <v-img width="100px" :src="family.logo"></v-img>
                </div>
                <p class="v-col-6">
                    {{ family.pater_familia.name }}
                </p>
                <p class="v-col-12">
                    {{ family.description }}
                </p>
                <v-data-table
                    :headers="headers"
                    :items="options.characters.filter(c=>c.family.id === family.id)"
                >
                    <template #item.rank="{ value }">
                        {{ value ? value.name : '' }}
                    </template>
                    <template #item.family="{ value }">
                        {{ value ? value.name : '' }}
                    </template>
                    <template #item.religion="{ value }">
                        {{ value ? value.name : '' }}
                    </template>
                    <template #item.guild="{ value }">
                        {{ value ? value.name : '' }}
                    </template>
                    <template #item.actions="{ value }">
                        <v-icon
                            size="small"
                            class="me-2"
                            @click="editItem(item)"
                        >
                            mdi-arrow-up-drop-circle-outline
                        </v-icon>
                    </template>
                </v-data-table>
            </v-card-text>
        </v-card>
    </v-form>
</template>
<script lang="ts">
import {mapActions, mapState} from "pinia";
import vtoast from "@/components/stack/vtoast.vue";
import {optionsStore} from "@/store/options";
import {familyStore} from "@/store/family";
import {validationStore} from "@/store/validation";
import {Family} from "@/models/Family/Family";
import {Character} from "@/models/Character/Character";

export default {
    name: "FamilyForm",
    components: {
        vtoast,
    },
    props: {
        family: {
            type: {}
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
        ...mapState(validationStore, ['rules']),
        headers() {
            const headers = [];
            if (this.options.characters !== undefined && this.options.characters.length > 0) {
                let character = new Character();
                for (const property in character) {
                    if (!property.includes('_id')&&!property.includes('family')) {
                        headers.push(
                            {
                                title: property,
                                align: 'start',
                                sortable: false,
                                key: property,
                            }
                        );
                    }
                }
                headers.push(
                    {
                        title: 'Actions',
                        align: '',
                        sortable: false,
                        value: 'actions',
                    }
                );
            }
            return headers;
        }
    },
    methods: {
        ...mapActions(optionsStore, {fetchAll: 'fetchAll'}),
        ...mapActions(familyStore, {update: 'update'}),
        updateFamily() {
            this.update(this.family)
                .then(this.fetchAll().then(() => {
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
