<template>
    <v-container>
        <family-form
            v-if="user.characters.find(c => c.isActive).family.pater_familia.id === user.id"
            :family="user.characters.find(c => c.isActive).family"
        />
        <family-view
            v-else
            :family="user.characters.find(c => c.isActive).family"
        />
    </v-container>
</template>
<script lang="ts">
import {mapState} from "pinia";
import vtoast from "@/components/stack/vtoast.vue";
import {authStore} from "@/store/auth";
import FamilyForm from "@/components/forms/admin/FamilyForm.vue";
import FamilyView from "@/views/admin/FamilyView.vue";

export default {
    name: "family",
    components: {
        vtoast,
        FamilyForm,
        FamilyView
    },
    data() {
        return {
            valid: true,
            itemsPerPage: 5,
            loading: false,
        };
    },
    computed: {
        ...mapState(authStore, ["user"]),
    },
    methods: {
    }
};
</script>
