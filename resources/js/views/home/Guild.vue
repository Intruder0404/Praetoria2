<template>
  <v-container class="bg pa-0 ma-0 d-flex justify-center align-center" :fluid="true">
    <info-card :direction="'right'" class="v-col-10">
      <template #title>
        <div class="text-xs-h4 text-md-h2 text-lg-h1">
          Legion Praetoria
        </div>
      </template>
      <template #body>
        <div class="text-xs-h7 text-md-h4 text-lg-h5">
          {{ options.guilds[0].description }}
        </div>
      </template>
      <template #actions>
        <v-btn variant="flat" color="primary" :block="$vuetify.display.xs" size="large" :to="'/registration'">Ouvrez un compte</v-btn>
        <v-btn variant="flat" color="primary" :block="$vuetify.display.xs" size="large" :to="'/guild'">En savoir plus</v-btn>
      </template>
    </info-card>
  </v-container>
</template>
<style scoped>
.bg{
  background-image:url("https://placehold.co/600x400");
  background-size: cover;
}
</style>
<script lang="ts">

import {mapState} from "pinia";
import {optionsStore} from "@/store/options";
import InfoCard from "@/components/card/home/InfoCard.vue";

export default {
  components: {InfoCard},
  data() {
    return {}
  },
  computed: {
    ...mapState(optionsStore, ['options'])
  },
  methods:{
  }
}
</script>
<style scoped>
</style>
