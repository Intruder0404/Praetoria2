<template>
    <v-navigation-drawer
        permanent
    >
        <v-list>
            <v-list-item
                :prepend-avatar="user.characters.find(c=>c.isActive)?'/rank/'+user.characters.find(c=>c.isActive).rank.name+'.png':''"
                :title="user.username"
            >
            </v-list-item>
        </v-list>
        <v-divider></v-divider>

        <v-list density="compact" nav>
            <v-list-item prepend-icon="mdi-account" title="User Account"
                         to="/account"></v-list-item>
            <v-list-item prepend-icon="mdi-account-child-outline" title="Personnages(under construction)"
                         value="personnage"
                         to="/character"></v-list-item>

            <v-list-item v-if="user.characters.find(c => c.isActive).family.pater_familia.id === user.id"
                         prepend-icon="mdi-human-male-female-child" title="Family(under construction)" value="family"
                         to="/family"></v-list-item>
            <v-list-item prepend-icon="mdi-home-group" title="Reservation(under construction)" value="reservation"
                         to="/reservation"></v-list-item>
            <v-list-group v-if="user.type.id === 2" prepend-icon="mdi-account-group"
                          title="Administration" value="Admin">
                <template #activator="{ props }">
                    <v-list-item
                        v-bind="props"
                        title="Admin"
                    ></v-list-item>
                </template>
                <v-list-item
                    v-for="(property,key) in options"
                    :title="key"
                    :value="key"
                    :key="key"
                    :to="{ name: 'admin', params:{ name: key }}"
                >
                </v-list-item>
            </v-list-group>
            <v-list-item v-if="isAuthenticated" prepend-icon="mdi-logout" title="Logout" @click="submit"></v-list-item>
        </v-list>
    </v-navigation-drawer>
</template>
<script lang="ts">
import {mapActions, mapState} from "pinia";
import {authStore} from "@/store/auth";
import {optionsStore} from "@/store";

export default {
    data() {
        return {
            drawer: true,
            itemsPerPage: 5,
        };
    },
    computed: {
        ...mapState(authStore, {user: "user", isAuthenticated: 'isAuthenticated', getAccess: 'getAccess'}),
        ...mapState(optionsStore, {options: "options"}),
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
    }
}
</script>
