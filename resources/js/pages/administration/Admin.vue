<template>
    <v-container>
        <v-card>
            <admin-data-table></admin-data-table>
        </v-card>
    </v-container>
</template>
<style scoped>
:deep(.v-data-table-footer) {
    background-color: #682bd7;
}
</style>
<script lang="ts">
import {defineComponent} from "vue";
import AdminDataTable from "@/components/tables/AdminDataTable.vue";

export default defineComponent({
    name: "admin",
    components: {
        AdminDataTable
    },
    data: () => {
        return {
            name: null
        }
    },
    mounted() {
        this.name = this.$route.params.name;
    },
    methods: {

    },
    computed: {

    }
});
</script>
