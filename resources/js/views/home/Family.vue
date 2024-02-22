<template>
  <v-container  class="bg pa-0 ma-0" :fluid="true">
    <InfoCard>
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
            :style="{height:'300px',width:'300px',backgroundSize:'300px 300px',backgroundImage:'url('+'logo/'+family.attribute_values.find(av=>av.attribute.name === 'Logo').value.value+')'}"
            link
          >
            <template>
              <div>
                {{ family.attribute_values.find(av => av.attribute.name === 'Description').value.value }}
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
