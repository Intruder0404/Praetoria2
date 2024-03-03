<template>
    <v-card class="px-4">
        <v-card-title>
            Account Modification
        </v-card-title>
        <v-form ref="userForm" v-model="valid" lazy-validation>
            <v-card-text>
                <v-row>

                    <div class="v-col-12">
                        <v-checkbox v-model="user.isActive" label="Active"></v-checkbox>
                    </div>
                    <div class="v-col-6">
                        <v-text-field v-model="user.username" :rules="[rules.required]" label="User Account"
                                      required></v-text-field>
                    </div>
                    <div class="v-col-6">
                        <v-select
                            v-if="user.type.name === 'admin'"
                            v-model="user.type"
                            :items="options.userTypes"
                            label="User Type"
                            item-title="name"
                            return-object
                        />
                    </div>
                    <div class="v-col-6">
                        <v-text-field v-model="user.first_name" :rules="[rules.required]" label="First Name"
                                      maxlength="20"
                                      required></v-text-field>
                    </div>
                    <div class="v-col-6">
                        <v-text-field v-model="user.last_name" :rules="[rules.required]" label="Last Name"
                                      maxlength="20"
                                      required></v-text-field>
                    </div>
                    <div class="v-col-6">
                        <v-text-field v-model="user.email" :rules="[rules.required,rules.email]" label="E-mail" required></v-text-field>
                    </div>
                    <v-spacer></v-spacer>
                </v-row>
            </v-card-text>
            <v-card-actions>
                <v-btn class="v-col-6" variant="flat" color="success" @click="updateUser">Change</v-btn>
                <v-btn class="v-col-6" variant="flat" color="error" @click="cancel">Close</v-btn>
            </v-card-actions>
        </v-form>
    </v-card>
</template>
<script lang="ts">
import {mapActions, mapState} from "pinia";
import vtoast from "@/components/stack/vtoast.vue";
import {optionsStore} from "@/store/options";
import {validationStore} from "@/store/validation";
import {userStore} from "@/store/user";

export default {
    name: "FamilyForm",
    components: {
        vtoast,
    },
    props:{
        user:{
            type:Object
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
        ...mapActions(userStore, {update:'update'}),
        updateUser() {
            this.update(this.user)
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
