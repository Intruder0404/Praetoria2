<template>
    <v-data-table
        :headers="headers"
        class="elevation-1"
        :items="options[name]"
        :loading="optionLoading"
    >
        <template #top>
            <v-toolbar flat color="primary">
                <v-toolbar-title>Administration</v-toolbar-title>
                <CreateDialog @closeCreate="closeDialog('create')" :isActive="dialog"/>
                <ManageAttributesDialog @closeCreate="closeDialog('manage-attributes')"
                                        :isActive="dialogManageAttributes"/>
                <DeleteDialog @closeCreate="closeDialog('delete')" :isActive="dialogDelete"/>
                <UpdateDialog @closeCreate="closeDialog('edit')" :editedItem="editedItem"
                              :isActive="dialogUpdate"/>
            </v-toolbar>
        </template>
        <template #item.rank="{ value }">
            {{ value.name }}
        </template>
        <template #item.characters="{ value }">
            <v-autocomplete
                :items="value"
                item-title="name"
            ></v-autocomplete>
        </template>
        <template #item.type="{ value }">
            {{ value.name }}
        </template>
        <template #item.pater_familia="{ value }">
            {{ value ? value.username : '' }}
        </template>
        <template #item.logo="{ value }">
            <v-img width="100px" :src="'/'+value"/>
        </template>
        <template #item.religion="{ value }">
            {{ value.name }}
        </template>
        <template #item.family="{ value }">
            {{ value.name }}
        </template>
        <template #item.actions="{ item }">
            <v-icon
                size="small"
                class="me-2"
                @click="editItem(item)"
            >
                mdi-pencil
            </v-icon>
            <v-icon
                size="small"
                @click="deleteItem(item)"
            >
                mdi-delete
            </v-icon>
        </template>
    </v-data-table>
</template>
<style scoped>
:deep(.v-data-table-footer) {
    background-color: #682bd7;
}
</style>
<script lang="ts">
import {mapState} from "pinia";
import CreateDialog from "@/components/dialog/admin/CreateDialog.vue";
import ManageAttributesDialog from "@/components/dialog/admin/ManageAttributesDialog.vue";
import RemoveAttributeDialog from "@/components/dialog/admin/RemoveAttributeDialog.vue";
import DeleteDialog from "@/components/dialog/admin/DeleteDialog.vue";
import UpdateDialog from "@/components/dialog/admin/UpdateDialog.vue";
import {optionsStore} from "@/store/options";
import {defineComponent} from "vue";
import _ from "lodash";

export default defineComponent({
    name: "admin",
    components: {
        CreateDialog,
        ManageAttributesDialog,
        RemoveAttributeDialog,
        DeleteDialog,
        UpdateDialog
    },
    data: () => {
        return {
            dialogDelete: false,
            dialogUpdate: false,
            dialogAddAttribute: false,
            dialogRemoveAttribute: false,
            dialogManageAttributes: false,
            editedIndex: null,
            editedItem: {},
            dialog: false,
            name: null
        }
    },
    mounted() {
        this.name = this.$route.params.name;
    },
    methods: {
        closeDialog(dialog) {
            switch (dialog) {
                case 'create':
                    this.dialog = false;
                    break;
                case 'delete':
                    this.dialogDelete = false;
                    break;
                case 'edit':
                    this.dialogUpdate = false;
                    break;
                case 'manage-attributes':
                    this.dialogManageAttributes = false;
                    break;
                case 'add-attribute':
                    this.dialogAddAttribute = false;
                    break;
                case 'remove-attribute':
                    this.dialogRemoveAttribute = false;
                    break;
            }
        },
        editItem(item) {
            this.editedItem = _.cloneDeep(this.options[this.name].find((option)=>option.id===item.id));
            this.dialogUpdate = true;
        },

        deleteItem(item) {
            /*this.editedIndex = this.newOptions[this.name].indexOf(item);
            this.editedItem = Object.assign({}, item);
            this.dialogDelete = true;*/
        }
    },
    computed: {
        ...mapState(optionsStore, ["options", 'optionLoading']),
        newOptions() {
            return JSON.parse(JSON.stringify(this.options));
        },
        headers() {
            const headers = [];
            if (this.options[this.$route.params.name] !== undefined && this.options[this.$route.params.name].length > 0) {
                let data = this.options[this.$route.params.name][0];
                for (const property in data) {
                    if (property === 'attribute_values') {
                        data[property].forEach((gav) => {
                                headers.push(
                                    {
                                        title: gav.attribute.name,
                                        align: 'left',
                                        sortable: true,
                                        type: 'text',
                                        key: gav.attribute.name,
                                    }
                                )
                            }
                        );
                    } else if (property === 'user_type') {
                        headers.push(
                            {
                                title: property,
                                align: 'left',
                                sortable: true,
                                type: 'text',
                            }
                        )
                    } else {
                        headers.push(
                            {
                                title: property,
                                align: 'start',
                                sortable: false,
                                key: property,
                            }
                        );
                    }
                }
                headers.push(
                    {
                        title: 'Actions',
                        align: '',
                        sortable: false,
                        value: 'actions',
                    }
                );
            }
            return headers;
        }
    }
});
</script>
