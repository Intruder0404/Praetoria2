<template>
    <v-card class="px-4">
        <v-card-title>

            {{ user.characters.find(c => c.isActive).family.name }} Family Management
        </v-card-title>
        <v-card-text>
            <v-form ref="registerForm" v-model="valid" lazy-validation>
                <v-row>
                    <v-col cols="12" sm="6" md="6">
                        <v-text-field
                            v-model="user.characters.find(c => c.isActive).family.name"
                            :rules="[rules.required]"
                            label="Name"
                            required
                        ></v-text-field>
                    </v-col>
                    <v-col cols="12" sm="6" md="6">
                        <v-checkbox
                            v-model="user.characters.find(c => c.isActive).family.isActive"
                            label="Active"
                        ></v-checkbox>
                    </v-col>
                    <v-col cols="12" sm="6" md="6">
                        <v-text-field
                            v-model="user.characters.find(c => c.isActive).family.logo"
                            label="Logo"
                            required></v-text-field>
                    </v-col>
                    <v-col cols="12" sm="6" md="6">
                        <v-text-field
                            v-model="user.characters.find(c => c.isActive).family.animal"
                            label="Animal"
                        ></v-text-field>
                    </v-col>
                    <v-col cols="12">
                        <v-textarea
                            v-model="user.characters.find(c => c.isActive).family.description"
                            label="Description"
                        ></v-textarea>
                    </v-col>
                </v-row>
                <v-data-table
                    :items="options.characters.filter(c=>c.family.id === user.characters.find(c => c.isActive).family.id)"
                >
                    <template #item.rank="{ value }">
                        {{value.name}}
                    </template>
                    <template #item.family="{ value }">
                        {{value.name}}
                    </template>
                </v-data-table>
            </v-form>
        </v-card-text>
    </v-card>
</template>
<script lang="ts">
import {mapActions, mapState} from "pinia";
import vtoast from "@/components/stack/vtoast.vue";
import {authStore} from "@/store/auth";
import {optionsStore} from "@/store/options";

export default {
    name: "family",
    components: {
        vtoast,
    },
    data() {
        return {
            valid: true,
            itemsPerPage: 5,
            loading: false,
            verify: null,
            showPass: false,
            family: null,
            rules: {
                required: value => !!value || "Required.",
                min: v => (v && v.length >= 8) || "Min 8 characters"
            },
            loginEmailRules: [
                v => !!v || "Required",
                v => /.+@.+\..+/.test(v) || "E-mail must be valid"
            ],
            emailRules: [
                v => !!v || "Required",
                v => /.+@.+\..+/.test(v) || "E-mail must be valid"
            ]
        };
    },
    computed: {
        ...mapState(authStore, ["user", 'isAuthenticated']),
        ...mapState(optionsStore, ['options'])
    },
    methods: {
        ...mapActions(authStore, ['updateUser']),
        ...mapActions(optionsStore, ['fetchAll']),
        validate() {
            this.updateUser().then(() => {
                this.fetchAll()
            });
        },
        test(val) {
            alert(val);
        }
    }
};
</script>
