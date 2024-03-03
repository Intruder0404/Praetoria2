<template>
    <v-card
        width="400"
        class="mx-auto"
    >
        <v-card-title>
            Login
        </v-card-title>
        <v-form fast-fail @submit.prevent="submit">
            <v-card-text>
                <v-text-field
                    v-model="email"
                    label="E-mail"
                    type="email"
                    class="mt-1 block w-full"
                    required
                    autofocus
                    autocomplete="username"
                ></v-text-field>

                <v-text-field
                    v-model="password"
                    label="Password"
                    type="password"
                    class="mt-1 block w-full"
                    required
                    autocomplete="current-password"
                ></v-text-field>
                <a href="#" class="text-body-2 font-weight-regular">Forgot Password?</a>

                <v-btn type="submit" color="primary" block class="mt-2">Sign in</v-btn>

                <div class="mt-2">
                    <p class="text-body-2">Don't have an account? <a href="/registration">Sign Up</a></p>
                </div>
            </v-card-text>
        </v-form>
    </v-card>
</template>
<script lang="ts">
import AuthenticationCard from '@/components/auth/AuthenticationCard.vue';
import {mapActions, mapState} from "pinia";
import {authStore} from "@/store/auth";

export default {
    components: {
        AuthenticationCard
    },
    data() {
        return {
            email: '',
            password: '',
            status: ''
        };
    },
    mounted() {
    },
    computed: {
        ...mapState(authStore, ["getUser", 'isAuthenticated']),
    },
    methods: {
        ...mapActions(authStore, ["LogIn"]),
        async submit() {
            try {
                await this.LogIn({email: this.email, password: this.password});
                this.$router.push("/");
            } catch (error) {
                this.$router.push("/");
                this.$root.vtoast.show({message: error})
            }
        },
    },
}
</script>
