<template>
    <v-navigation-drawer
        permanent
    >
       <v-list>
            <v-list-item
                v-if="user!==undefined"
                :prepend-avatar="'/rank/'+user.characters.find(c=>c.isActive).rank.name+'.png'"
                :title="user.username"
            >
            </v-list-item>
        </v-list>
        <v-divider></v-divider>

        <v-list density="compact" nav>
            <v-list-item prepend-icon="mdi-account" title="User Account"
                         to="/account"></v-list-item>
            <v-list-item prepend-icon="mdi-account-child-outline" title="Personnages(under construction)" value="personnage"
                         to="/character"></v-list-item>
            <v-list-item v-if="user.characters.find(c => c.isActive).family.pater_familia.id === user.id" prepend-icon="mdi-human-male-female-child" title="Family(under construction)" value="family"
                         to="/family"></v-list-item>
            <v-list-item prepend-icon="mdi-home-group" title="Reservation(under construction)" value="reservation"
                         to="/reservation"></v-list-item>
            <v-list-group open-on-hover v-if="user.type.id === 2" prepend-icon="mdi-account-group"
                          title="Administration" value="admin">
                <template #activator="{ props }">
                    <v-list-item
                        v-bind="props"
                        title="Admin"
                    ></v-list-item>
                </template>
                <v-list-item prepend-icon="mdi-account-multiple-outline" title="Users"
                             :to="{ name: 'admin', params:{ name: 'users' }}"/>
                <v-list-item prepend-icon="mdi-account-supervisor-circle" title="User Types"
                             :to="{ name: 'admin', params:{ name: 'userTypes' }}"/>
                <v-list-item prepend-icon="mdi-human-male" title="Characters"
                             :to="{ name: 'admin', params:{ name: 'characters' }}"/>
                <v-list-item prepend-icon="mdi-weather-sunny" title="Religions"
                             :to="{ name: 'admin', params:{ name: 'religions' }}"/>
                <v-list-item prepend-icon="mdi-human-male-female-child" title="Families"
                             :to="{ name: 'admin', params:{ name: 'families' }}"/>
                <v-list-item prepend-icon="mdi-home-group" title="Guilds"
                             :to="{ name: 'admin', params:{ name: 'guilds' }}"/>
                <v-list-item prepend-icon="mdi-chess-king" title="Kingdoms"
                             :to="{ name: 'admin', params:{ name: 'kingdoms' }}"/>
                <v-list-item prepend-icon="mdi-chevron-triple-up" title="Ranks"
                             :to="{ name: 'admin', params:{ name: 'ranks' }}"/>
                <v-list-item prepend-icon="mdi-human-male" title="Attributes"
                             :to="{ name: 'admin', params:{ name: 'attributes' }}"/>
                <v-list-item prepend-icon="mdi-human-male" title="Data Types"
                             :to="{ name: 'admin', params:{ name: 'data_type' }}"/>
                <v-list-item prepend-icon="mdi-human-male" title="Products"
                             :to="{ name: 'admin', params:{ name: 'products' }}"/>
                <v-list-item prepend-icon="mdi-human-male" title="Reservation"
                             :to="{ name: 'admin', params:{ name: 'reservations' }}"/>
                <v-list-item prepend-icon="mdi-human-male" title="News"
                             :to="{ name: 'admin', params:{ name: 'news' }}"/>
            </v-list-group>
            <v-list-item v-if="isAuthenticated" prepend-icon="mdi-logout" title="Logout" @click="submit"></v-list-item>
        </v-list>
    </v-navigation-drawer>
</template>
<script lang="ts">
import {mapActions, mapState} from "pinia";
import {authStore} from "@/store/auth";

export default {
    data() {
        return {
            drawer: true,
            itemsPerPage: 5,
        };
    },
    computed: {
        ...mapState(authStore, {user: "user", isAuthenticated: 'isAuthenticated', getAccess: 'getAccess'}),
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
