<template>
    <v-form ref="guildForm" v-model="valid" lazy-validation>
        <v-card class="px-4">
            <v-card-title>
<<<<<<< HEAD:resources/js/components/forms/FamilyForm.vue
                {{ modifiedFamily.name }} Family Management
=======
                {{ guild.name }} Family Management
>>>>>>> ee8b7ff9dbdac153d25a934953b78d7e6fbb26e1:resources/js/components/forms/admin/GuildForm.vue
            </v-card-title>
            <v-card-text>
                <v-row>
                    <v-col cols="12" sm="6" md="6">
                        <v-text-field
<<<<<<< HEAD:resources/js/components/forms/FamilyForm.vue
                            v-if="user.characters.find(c => c.isActive).family.pater_familia.id === user.id"
                            v-model="modifiedFamily.name"
=======
                            v-model="guild.name"
>>>>>>> ee8b7ff9dbdac153d25a934953b78d7e6fbb26e1:resources/js/components/forms/admin/GuildForm.vue
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
<<<<<<< HEAD:resources/js/components/forms/FamilyForm.vue
                            v-if="user.characters.find(c => c.isActive).family.pater_familia.id === user.id"
                            v-model="modifiedFamily.isActive"
=======
                            v-model="guild.isActive"
>>>>>>> ee8b7ff9dbdac153d25a934953b78d7e6fbb26e1:resources/js/components/forms/admin/GuildForm.vue
                            label="Active"
                        ></v-checkbox>
                    </v-col>
                    <v-col cols="12" sm="6" md="6">
<<<<<<< HEAD:resources/js/components/forms/FamilyForm.vue
                        <v-select
                            v-if="user.characters.find(c => c.isActive).family.pater_familia.id === user.id"
                            class="d-flex justify-center" variant="outlined"
                            v-model="modifiedFamily.logo" :items="options.logos"
                            label="Logo">
=======
                        <v-select class="d-flex justify-center" variant="outlined"
                                  v-model="guild.logo" :items="options.logos"
                                  label="Logo">
>>>>>>> ee8b7ff9dbdac153d25a934953b78d7e6fbb26e1:resources/js/components/forms/admin/GuildForm.vue
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
<<<<<<< HEAD:resources/js/components/forms/FamilyForm.vue
                            v-if="user.characters.find(c => c.isActive).family.pater_familia.id === user.id"
                            v-model="modifiedFamily.animal"
                            label="Animal"
                        ></v-text-field>
                        <div v-else>
                            {{ modifiedFamily.animal }}
                        </div>
                    </v-col>
                    <v-col cols="12" sm="6" md="6">
                        <v-select class="d-flex justify-center" variant="outlined"
                                  v-if="modifiedFamily.pater_familia==null"
                                  v-model="modifiedFamily.pater_familia" :items="options.characters"
=======
                            v-model="guild.animal"
                            label="Animal"
                        ></v-text-field>
                    </v-col>-->
                    <v-col cols="12" sm="6" md="6">
                        <v-select class="d-flex justify-center" variant="outlined"
                                  v-model="guild.kingdom_id" :items="options.kingdoms"
>>>>>>> ee8b7ff9dbdac153d25a934953b78d7e6fbb26e1:resources/js/components/forms/admin/GuildForm.vue
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
<<<<<<< HEAD:resources/js/components/forms/FamilyForm.vue
                            v-if="user.characters.find(c => c.isActive).family.pater_familia.id === user.id"
                            v-model="modifiedFamily.description"
=======
                            v-model="guild.description"
>>>>>>> ee8b7ff9dbdac153d25a934953b78d7e6fbb26e1:resources/js/components/forms/admin/GuildForm.vue
                            label="Description"
                        ></v-textarea>
                        <div>
                            {{family.description}}
                        </div>
                    </v-col>
                </v-row>
<<<<<<< HEAD:resources/js/components/forms/FamilyForm.vue
                <v-data-table
                    :items="options.characters.filter(c=>c.family.id === modifiedFamily.id)"
=======
<!--                <v-data-table
                    :items="options.characters.filter(c=>c.family.id === guild.id)"
>>>>>>> ee8b7ff9dbdac153d25a934953b78d7e6fbb26e1:resources/js/components/forms/admin/GuildForm.vue
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
import {familyStore} from "@/store/family";
import {validationStore} from "@/store/validation";
import {Family} from "@/models/Family/Family";
<<<<<<< HEAD:resources/js/components/forms/FamilyForm.vue
import {authStore} from "@/store/auth";
import _ from "lodash";
=======
import {guildStore} from "@/store/guild";
>>>>>>> ee8b7ff9dbdac153d25a934953b78d7e6fbb26e1:resources/js/components/forms/admin/GuildForm.vue

export default {
    name: "GuildForm",
    components: {
        vtoast,
    },
<<<<<<< HEAD:resources/js/components/forms/FamilyForm.vue
    props: {
        family: {
            type: {}
=======
    props:{
        guild:{
            type:{}
>>>>>>> ee8b7ff9dbdac153d25a934953b78d7e6fbb26e1:resources/js/components/forms/admin/GuildForm.vue
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
<<<<<<< HEAD:resources/js/components/forms/FamilyForm.vue
        ...mapActions(optionsStore, {fetchAll: 'fetchAll'}),
        ...mapActions(familyStore, {update: 'update'}),
        updateFamily() {
            this.update(this.modifiedFamily)
                .then(this.fetchAll().then(() => {
                    this.user.characters.find(c => c.isActive).family = this.modifiedFamily;
                    this.$root.vtoast.show({message: 'Family saved', color: 'success'});
=======
        ...mapActions(optionsStore, {fetchAll:'fetchAll'}),
        ...mapActions(guildStore, {update:'update'}),
        updateGuild() {
            this.update(this.guild)
                .then(this.fetchAll().then(()=>{
                    this.$root.vtoast.color = 'success'
                    this.$root.vtoast.show({message: 'Guild saved'})
>>>>>>> ee8b7ff9dbdac153d25a934953b78d7e6fbb26e1:resources/js/components/forms/admin/GuildForm.vue
                    this.$emit('close');
                }));
        },
        cancel() {
            this.$emit('close');
        }
    }
};
</script>
