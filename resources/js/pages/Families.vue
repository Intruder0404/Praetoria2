<template>
    <v-container class="w-100 h-100 mt-15 bg d-flex flex-wrap">
            <v-card
                class="v-col-6"
                v-for="(family,idx) in options.families"
                :key="idx"
                color="primary"
                :title="family.name"
                :style="{backgroundPosition:'center',backgroundRepeat:'no-repeat',backgroundSize:'contain',backgroundImage:'url('+family.logo+')'}"
                link
            >
                <template>
                    <div>
                        {{ family.description }}
                    </div>
                </template>
            </v-card>
        <!--div class="gc-10 mt-7 d-flex flex-wrap justify-center">
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
                    <v-img :src="family.logo">

                    </v-img>
                </v-card-text>
                <template>
                    <div>
                        {{ family.description }}
                    </div>
                </template>
            </v-card>
        </div>-->
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

export default {
    name: "Families",
    computed: {
        ...mapState(optionsStore, ['options'])
    }
}
</script>

<style scoped>

</style>
