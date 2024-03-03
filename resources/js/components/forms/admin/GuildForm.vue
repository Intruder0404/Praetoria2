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
                        <div v-else>
                            {{ family.name }}
                        </div>
                    </v-col>
                    <v-col cols="12" sm="6" md="6">
                        <v-checkbox
                            v-model="guild.isActive"
                            label="Active"
                        ></v-checkbox>
                    </v-col>
                    <v-col cols="12" sm="6" md="6">

                        <v-select class="d-flex justify-center" variant="outlined"
                                  v-model="guild.logo" :items="options.logos"
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
                        <v-img v-else width="100px" :src="'/'+family.logo"/>
                    </v-col>
<!--                    <v-col cols="12" sm="6" md="6">
                        <v-text-field

                            v-model="guild.animal"
                            label="Animal"
                        ></v-text-field>
                    </v-col>-->
                    <v-col cols="12" sm="6" md="6">
                        <v-select class="d-flex justify-center" variant="outlined"
                                  v-model="guild.kingdom_id" :items="options.kingdoms"
                                  item-title="name"
                                  item-value="id"
                                  label="Kingdom">
                        </v-select>
                        <v-select class="d-flex justify-center" variant="outlined"
                                  v-else-if="user.characters.find(c => c.isActive).family.pater_familia.id === user.id"
                                  v-model="modifiedFamily.pater_familia.id" :items="options.characters"
                                  item-title="name"
                                  item-value="id"
                                  label="Pater Familia">
                        </v-select>
                        <div v-else>
                                {{modifiedFamily.pater_familia?modifiedFamily.pater_familia:''}}
                        </div>
                    </v-col>
                    <v-col cols="12">
                        <v-textarea

                            v-model="guild.description"
                            label="Description"
                        ></v-textarea>
                        <div>
                            {{family.description}}
                        </div>
                    </v-col>
                </v-row>

<!--                <v-data-table
                    :items="options.characters.filter(c=>c.family.id === guild.id)"
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
                    <template #item.action="{ value }">
                        <v-icon
                            size="small"
                            class="me-2"
                            @click="editItem(item)"
                        >
                            mdi-arrow-up-drop-circle-outline
                        </v-icon>
                    </template>
                </v-data-table>-->

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
            loading: false,
            modifiedFamily:_.cloneDeep(this.family)
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
