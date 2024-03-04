<template>
    <v-form ref="guildForm" v-model="valid" lazy-validation>
        <v-card class="px-4">
            <v-card-title>

                {{ guild.name }} Family Management
            </v-card-title>
            <v-card-text>
                <v-row>
                    <v-col cols="12" sm="6" md="6">
                        <v-text-field
                            v-model="guild.name"
                            :rules="[rules.required]"
                            label="Name"
                            required
                        ></v-text-field>
                    </v-col>
                    <v-col cols="12" sm="6" md="6">
                        <v-checkbox
                            v-model="guild.isActive"
                            label="Active"
                        ></v-checkbox>
                    </v-col>
                    <div class="v-col-6">
                        <v-select class="d-flex justify-center" variant="outlined"
                                  v-model="guild.logo" :items="options.logos"
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
                    <v-col cols="12" sm="6" md="6">
                        <v-select class="d-flex justify-center" variant="outlined"
                                  v-model="guild.kingdom_id" :items="options.kingdoms"
                                  item-title="name"
                                  item-value="id"
                                  label="Kingdom">
                        </v-select>
                    </v-col>
                    <v-col cols="12">
                        <v-textarea

                            v-model="guild.description"
                            label="Description"
                        ></v-textarea>
                    </v-col>
                </v-row>

                <v-card-actions>
                    <v-btn class="v-col-6" variant="flat" color="success" @click="updateGuild">Change</v-btn>
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
import {guildStore} from "@/store/guild";
import {authStore} from "@/store";

export default {
    name: "GuildForm",
    components: {
        vtoast,
    },

    props:{
        guild:{
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
        ...mapState(validationStore, ['rules']),
        ...mapState(authStore, ['user'])
    },
    methods: {

        ...mapActions(optionsStore, {fetchAll:'fetchAll'}),
        ...mapActions(guildStore, {update:'update'}),
        updateGuild() {
            this.update(this.guild)
                .then(this.fetchAll().then(()=>{
                    this.$root.vtoast.color = 'success'
                    this.$root.vtoast.show({message: 'Guild saved'})
                    this.$emit('close');
                }));
        },
        cancel() {
            this.$emit('close');
        }
    }
};
</script>
