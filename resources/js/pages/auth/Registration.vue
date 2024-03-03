<template>
    <v-card
        width="400"
        class="mx-auto"
    >
        <v-card-title>
            Registration
        </v-card-title>
        <v-form fast-fail @submit.prevent="submit">
            <v-card-text>
                <v-text-field
                    v-model="first_name"
                    label="First name"
                    :rules="[rules.required]"
                ></v-text-field>
                <v-text-field
                    v-model="last_name"
                    label="Last name"
                    :rules="[rules.required]"
                ></v-text-field>
                <v-text-field
                    v-model="username"
                    label="Username"
                    :rules="[rules.required]"
                ></v-text-field>
                <v-text-field
                    v-model="email"
                    label="E-mail"
                    :rules="[rules.required, rules.email]"
                ></v-text-field>
                <v-text-field
                    v-model="password"
                    label="Password"
                    type="password"
                    :rules="[
                        rules.required,
                        rules.min8,
                        rules.lowerCase1,
                        rules.upperCase1,
                        rules.digitCase1,
                        rules.specialCharacter1,
                        ]"
                ></v-text-field>
                <v-text-field
                    v-model="confirmPassword"
                    label="Confirm Password"
                    type="password"
                    required
                ></v-text-field>
            </v-card-text>
            <v-card-actions class="d-flex justify-center">
                <v-btn
                    type="submit"
                    color="primary"
                    class="v-col-10 mb-2"
                    variant="flat"
                    size="xx-large"
                >
                    <template #prepend>
                        <v-avatar>
                            <v-img src="/public/logo/praetoria-1-transparent.png">
                            </v-img>
                        </v-avatar>
                    </template>
                    Register
                </v-btn>
            </v-card-actions>
        </v-form>
    </v-card>
</template>
<script lang="ts">
import {mapActions, mapState} from "pinia";
import {authStore} from "@/store/auth";
import {validationStore} from "@/store/validation";

export default {
    name: "App",
    data() {
        return {
            first_name: '',
            last_name: '',
            username: '',
            email: '',
            password: '',
            confirmPassword: ''
        };
    },
    computed: {
        ...mapState(validationStore, ['rules'])
    },
    methods: {
        ...mapActions(authStore, ["register"]),
        async submit() {
            if (this.password === this.confirmPassword) {
                await this.register({
                    first_name: this.first_name,
                    last_name: this.last_name,
                    username: this.username,
                    email: this.email,
                    password: this.password
                });
                this.$refs.form.reset();
            } else {
                this.errorMessage = "password did not match"
            }
        }
    }
};
</script>
