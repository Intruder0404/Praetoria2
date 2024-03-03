<template>
    <v-dialog v-model="active"
              width="auto">
        <template #activator="{ props }">
            <v-btn v-if="activator==='button'" style="width: 100%" v-bind="props">
                Register
            </v-btn>
            <v-list-item v-else-if="activator==='list-item'" style="width: 100%" v-bind="props">
                Register
            </v-list-item>
            <v-btn v-else style="width: 100%" v-bind="props">
                Register
            </v-btn>
        </template>
        <Registration
            :style="{backgroundRepeat:'no-repeat',backgroundSize:'100% 100%',backgroundImage:'url(/textures/parchement2.png)'}"
        />
    </v-dialog>
</template>
<script lang="ts">
import Registration from "@/pages/auth/Registration.vue";
import {mapState} from "pinia";
import {authStore} from "@/store/auth";
import {defineComponent} from "vue";

export default defineComponent({
    name: "RegisterDialog",
    components: {Registration},
    props: {
        isActive: {
            type: Boolean
        },
        activator: {
            type: String
        }
    },
    data() {
        return {
            active: false
        }
    },
    methods: {
        close() {
            this.$emit('closeCreate');
        }
    },
    computed: {
        ...mapState(authStore, ['loading', 'isAuthenticated']),
        auth() {
            return this.isAuthenticated;
        }
    },
    watch: {
        isActive: {
            handler(newVal, oldVal) {
                this.active = newVal;
            }
        },
        isAuthenticated: {
            handler(newVal, oldVal) {
                this.active = false;
            }
        }
    }
})
</script>
