<template>
  <v-app>
    <v-main>
      <v-container class="pt-15 bg">
        <v-row class="gc-10" justify="center">
          <v-card
            class="mt-4 v-col-sx-12 v-col-lg-5"
            v-for="(family,idx) in options.families"
            :key="idx"
            color="secondary"
            :hover="true"
          >
            <v-card-title
              class="text-xs-h8 text-md-h3 text-lg-h4"
            >
              {{ family.name }}
            </v-card-title>
            <v-card-text>
              <v-img :src="'logo/'+family.logo">

              </v-img>
            </v-card-text>
            <template>
              <div>
                  {{ family.description }}
              </div>
            </template>
          </v-card>
        </v-row>
      </v-container>
    </v-main>
  </v-app>
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

export default {
  name: "Families",
  computed: {
    ...mapState(optionsStore, ['options'])
  }
}
</script>

<style scoped>

</style>
