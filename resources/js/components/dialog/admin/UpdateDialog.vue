<template>
    <v-dialog v-model="active">
        <family-form @close="close" v-if="name==='families'" :family="editedItem"></family-form>
        <religion-form @close="close" v-if="name==='religions'" :religion="editedItem"></religion-form>
        <guild-form @close="close" v-if="name==='guilds'" :guild="editedItem"></guild-form>
        <user-form @close="close" v-if="name==='users'" :user="editedItem"></user-form>
        <character-form @close="close" v-if="name==='characters'" :character="editedItem"></character-form>
        <kingdom-form @close="close" v-if="name==='kingdoms'" :kingdom="editedItem"></kingdom-form>
    </v-dialog>
</template>
<script lang="ts">
import {
    CharacterForm,
    FamilyForm,
    ReligionForm,
    GuildForm,
    UserForm,
    KingdomForm
} from "@/components";
export default {
    name: "UpdateDialog",
    components: {
        FamilyForm,
        ReligionForm,
        GuildForm,
        UserForm,
        CharacterForm,
        KingdomForm
    },
    data() {
        return {
            active: false,
            name: null,
            fieldIgnore: [
                'type',
                'rank'
            ]
        }
    },
    props: ['isActive', 'editedItem'],
    methods: {
        close() {
            this.$emit('closeCreate');
        }
    },
    watch: {
        isActive: {
            handler(newVal, oldVal) {
                this.active = newVal;
            }
        }
    },
    mounted() {
        this.name = this.$route.params.name;
    }
}
</script>
