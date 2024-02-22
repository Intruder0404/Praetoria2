<template>
    <v-snackbar
        :color="color"
        :timeout="timer"
        v-model="showSnackbar"
        :location="location"
    >
        <v-icon left>{{ icon }}</v-icon>
        {{ message }}
    </v-snackbar>
</template>

<script lang="ts">
export default {
    name: "vtoast",
    data() {
        return {
            showSnackbar: false,
            message: '',
            color: 'success',
            icon: 'mdi-check',
            timer: 3000,
            location:'bottom-right'
        }
    },
    methods: {
        show(data: { message, color, timer, icon, location }) {
            this.message = data.message??'';
            this.color = data.color??this.color;
            this.timer = data.timer??this.timer;
            this.icon = data.icon??this.icon;
            this.location = data.location??this.location;
            this.showSnackbar = true;
        }
    }
}
</script>
