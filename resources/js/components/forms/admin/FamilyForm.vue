<template>
    <v-form ref="familyForm" v-model="valid" lazy-validation>
        <v-card class="px-4">
            <v-card-title>
                {{ family.name }} Family Management
            </v-card-title>
            <v-card-text>
                <v-row>
                    <v-text-field
                        class="v-col-6"
                        v-model="family.name"
                        :rules="[rules.required]"
                        label="Name"
                        required
                    ></v-text-field>
                    <v-text-field
                        class="v-col-6"
                        v-model="family.animal"
                        label="Animal"
                    ></v-text-field>
                    <div class="v-col-6">
                        <v-select class="d-flex justify-center" variant="outlined"
                                  v-model="family.logo" :items="options.logos"
                                  item-value="url"
                                  label="Logo">
                            <template #item="{ props,item }">
                                <v-list-item v-bind="props" title="">
                                    <v-img width="100px" :src="'/'+item.value"/>
                                </v-list-item>
                            </template>
                            <template #selection="{ item }">
                                <v-img width="100px" :src="'/'+item.value"/>
                            </template>
                        </v-select>
                    </div>
                    <div class="v-col-6">
                        <v-select variant="outlined"
                                  v-model="family.pater_familia.id" :items="options.characters"
                                  item-title="name"
                                  item-value="id"
                                  label="Pater Familia">
                        </v-select>
                    </div>
                    <v-textarea
                        class="v-col-12"
                        v-model="family.description"
                        label="Description"
                    ></v-textarea>
                </v-row>
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
                    if (!property.includes('_id')) {
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
