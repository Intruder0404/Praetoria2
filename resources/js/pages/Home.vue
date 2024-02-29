<template>
    <HomeCarousel :style="{'min-height': '140vh'}"/>
    <v-spacer></v-spacer>
    <Guild :style="{'min-height':'50vh'}"/>
    <v-spacer></v-spacer>
    <Family :style="{'min-height':'50vh'}"/>
    <v-spacer></v-spacer>
    <Politics :style="{'min-height':'50vh'}"/>
    <v-spacer></v-spacer>
    <Religion :style="{'min-height':'50vh'}"/>
    <v-spacer></v-spacer>
    <Merchants :style="{'min-height':'50vh'}"/>
    <v-spacer></v-spacer>
    <Bicolline :style="{'min-height':'50vh'}"/>
</template>

<script lang="ts">
import HomeCarousel from "@/components/carousel/home/HomeCarousel.vue";
import Guild from "@/views/home/Guild.vue";
import Family from "@/views/home/Family.vue";
import Politics from "@/views/home/Politics.vue";
import Religion from "@/views/home/Religion.vue";
import Bicolline from "@/views/home/Bicolline.vue";
import Merchants from "@/views/home/Merchants.vue";

export default {
    components: {Merchants, Religion, Politics, Family, Guild, HomeCarousel, Bicolline},
    data() {
        return {
            overlay: true
        }
    },
}
</script>
