<template>
  <v-container  class="bg pa-0 ma-0 d-flex justify-center align-center" :fluid="true">
    <InfoCard class="v-col-10">
      <template #title>
        <div class="text-h1">
          Familles
        </div>
      </template>
      <template #body>
        <v-card-text class="d-flex flex-wrap justify-space-around">
          <v-card
            class=""
            v-for="(family,idx) in options.families"
            :key="idx"
            color="primary"
            :title="family.name"
            :style="{height:'300px',width:'300px',backgroundSize:'300px 300px',backgroundImage:'url('+family.logo+')'}"
            link
          >
            <template>
              <div>
                {{ family.description }}
              </div>
            </template>
          </v-card>
        </v-card-text>
      </template>
    </InfoCard>
  </v-container>
</template>
<style scoped>
.bg {
  background-image: url("https://placehold.co/600x400");
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
  }
}
</script>
<style scoped>

</style>
