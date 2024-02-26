<template>
    <v-card class="px-4">
        <v-card-title>
            Account Modification
        </v-card-title>
        <v-form ref="registerForm" v-model="valid" lazy-validation>
            <v-card-text>
                <v-row>
                    <v-col cols="12" sm="6" md="6">
                        <v-text-field v-model="modifiableUser.username" :rules="[rules.required]" label="User Account"
                                      required></v-text-field>
                    </v-col>
                    <v-col cols="12" sm="6" md="6">
                        <v-checkbox v-model="modifiableUser.isActive" label="Active"></v-checkbox>
                    </v-col>
                    <v-col cols="12" sm="6" md="6">
                        <v-text-field v-model="modifiableUser.first_name" :rules="[rules.required]" label="First Name"
                                      maxlength="20"
                                      required></v-text-field>
                    </v-col>
                    <v-col cols="12" sm="6" md="6">
                        <v-text-field v-model="modifiableUser.last_name" :rules="[rules.required]" label="Last Name"
                                      maxlength="20"
                                      required></v-text-field>
                    </v-col>
                    <v-col cols="12">
                        <v-text-field v-model="modifiableUser.email" :rules="emailRules" label="E-mail" required></v-text-field>
                    </v-col>
                    <v-col cols="12" sm="6" md="6">
                        <v-select
                            v-if="user.type.name === 'admin'"
                            v-model="modifiableUser.type"
                            :items="options.userTypes"
                            label="User Type"
                            item-title="name"
                            return-object
                        />
                    </v-col>
                    <v-spacer></v-spacer>
                </v-row>
            </v-card-text>
            <v-card-actions>
                <v-btn x-large block variant="flat" color="success" @click="validate">Change</v-btn>
            </v-card-actions>
        </v-form>
    </v-card>
</template>
<script lang="ts">
import {mapActions, mapState} from "pinia";
import vtoast from "@/components/stack/vtoast.vue";
import {authStore} from "@/store/auth";
import {optionsStore} from "@/store/options";
import {toRaw} from "vue";

export default {
    name: "App",
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
        ...mapState(authStore, ["user","modifiableUser", 'isAuthenticated']),
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
