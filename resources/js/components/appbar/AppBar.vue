<template>
    <v-app-bar
        class="ma-2"
        flat
        density="comfortable"
        rounded
        app
    >
        <v-menu
            :open-on-hover="true"
            :close-on-content-click="true"
            transition="slide-y-transition"
        >
            <template #activator="{ props }">
                <v-btn
                    v-bind="props"
                    style="background-color: #381879;height:50px"
                    class="ml-0"
                    rounded="0"
                >
                    Praetoria
                </v-btn>
            </template>
            <v-list>
                <v-list-item>
                    Visitez Bicolline.org
                </v-list-item>
                <v-list-item>
                    Visitez le coin des marchants
                </v-list-item>
            </v-list>
        </v-menu>
        <v-divider vertical></v-divider>
        <v-btn
            to="/"
            class="ml-4 mr-4"
            color="secondary"
            :rounded="true"
        >
                <v-avatar>
                    <v-img src="/public/logo/praetoria-1-transparent.png">
                    </v-img>
                </v-avatar>
        </v-btn>
        <v-menu :close-on-content-click="true">
            <template #activator="{ props }">
                <v-btn
                    v-bind="props"
                >
                    Informations de Guilde
                    <v-icon>mdi-chevron-down</v-icon>
                </v-btn>
            </template>
            <v-list class="text-center">
                <v-list-item to="/guild">
                    La Legion
                </v-list-item>
                <v-list-item to="/families">
                    Les Familles
                </v-list-item>
                <v-list-item to="/politics">
                    La Politique
                </v-list-item>
                <v-list-item to="/religions">
                    Les Religion
                </v-list-item>
                <v-list-item to="/merchants">
                    Les Marchants
                </v-list-item>
                <v-list-item to="/bicolline">
                    Bicolline
                </v-list-item>
            </v-list>
        </v-menu>
        <v-spacer></v-spacer>
        <LanguageButton/>
        <ThemeButton/>
        <v-menu :close-on-content-click="false">
            <template #activator="{ props }">
                <v-btn
                    v-bind="props"
                >
                    <v-icon>mdi-account</v-icon>
                    {{ getUser ? getUser.username : 'Account' }}
                    <v-icon>mdi-chevron-down</v-icon>
                </v-btn>
            </template>
            <v-list>
                <v-list-item v-if="isAuthenticated" to="/dashboard">
                    <v-icon icon="mdi-cog">

                    </v-icon>
                    Account Settings
                </v-list-item>
                <login-dialog :activator="'list-item'" v-if="!isAuthenticated"/>
                <register-dialog :activator="'list-item'"/>
                <v-list-item @click="submit" v-if="isAuthenticated">
                    Logout
                </v-list-item>
            </v-list>
        </v-menu>
    </v-app-bar>
</template>

<script lang="ts">
import {mapActions, mapState} from "pinia";
import {authStore} from "@/store/auth";
import {LoginDialog, ThemeButton, LanguageButton} from "@/components";
import RegisterDialog from "@/components/dialog/auth/RegisterDialog.vue";

export default {
    components: {
        RegisterDialog,
        LanguageButton,
        ThemeButton,
        LoginDialog
    },
    methods: {
        ...mapActions(authStore, ["logOut"]),
        async submit() {
            try {
                await this.logOut();
                this.$router.push('/');
            } catch (error) {
                this.$root.vtoast.show({message: error});
            }
        },
    },
    computed: {
        ...mapState(authStore, ["getUser", 'isAuthenticated', 'isAuthLoading']),
    }
}
</script>

<style scoped>

</style>
