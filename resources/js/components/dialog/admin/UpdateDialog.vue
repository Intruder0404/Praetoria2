<template>
    <v-dialog v-model="active">
        <family-form @close="close" v-if="name==='families'" :family="editedItem"></family-form>
        <religion-form @close="close" v-if="name==='religions'" :religion="editedItem"></religion-form>
    </v-dialog>
</template>
<script lang="ts">

import {mapState} from "pinia";
import {optionsStore} from "@/store/options";
import FamilyForm from "@/components/forms/FamilyForm";
import ReligionForm from "@/components/forms/ReligionForm.vue";

export default {
    name: "UpdateDialog",
    components: {
        FamilyForm,
        ReligionForm
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
    computed: {
        ...mapState(optionsStore, ['options'])
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
