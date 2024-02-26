<template>
    <v-container :fluid="true" class="bg d-flex flex-wrap align-center justify-center pa-0 ma-0 pt-10">
        <InfoCard class="mt-10 v-col-10">
            <template #title>
                <div class="text-sm-h2 text-h2 text-md-h2 text-lg-h1 text-wrap">
                    Devenez un fucking badass
                </div>
            </template>
            <template #body>
                <div class="text-sm-h5 text-h5 text-xs-h5 text-md-h4 text-lg-h5">
                    trouvez-vous que le monde sont des petite pisseuses?<br/>
                    trouvez-vous dans une situation ou tout les gens autour de vous on l'air des mauviette?
                </div>
                <div class="text-xs-h8 text-h3 text-md-h3 text-lg-h4">
                    Ben devenez une recrue pour la Legion Praetoria.
                </div>
            </template>
            <template #actions>
                <v-btn :block="$vuetify.display.xs" class="pa-0 ma-0" size="large" to="/registration"
                       style="background: rgba(76, 175, 80, 0.3)">Devenir une recrue aujourd'hui
                </v-btn>
                <br/>
                <v-btn :block="$vuetify.display.xs" class="pa-0 ma-0" size="large"
                       style="background: rgba(236,73,73,0.3)">En savoir plus
                </v-btn>
            </template>
        </InfoCard>
        <info-card class="mt-10 v-col-10">
            <template #title>
                <div class="text-sm-h4 text-h4 text-md-h4 text-lg-h4d text-wrap">
                    Nouvelle
                </div>
            </template>
            <template #body>
                <v-card-text class="d-flex flex-wrap justify-space-between">
                    <v-card
                        class=""
                        v-for="(family,idx) in options.families"
                        :key="idx"
                        color="primary"
                        :title="family.name"
                        :style="{height:'250px',width:'250px',backgroundSize:'250px 250px',backgroundImage:'url('+'logo/'+family.logo+')'}"
                        link
                    >
                        <template>
                            <div>
                                {{
                                    family.description
                                }}
                            </div>
                        </template>
                    </v-card>
                </v-card-text>
            </template>
        </info-card>
    </v-container>
</template>
<style scoped>
:deep(.v-overlay__scrim) {
    opacity: 0;

}

:deep(.v-overlay__content) {
    width: 90%;
}

.bg {
    background-image: url("https://placehold.co/600x400");
    background-size: cover;
}
</style>
<script lang="ts">
import InfoCard from "@/components/card/home/InfoCard.vue";
import {mapState} from "pinia";
import {optionsStore} from "@/store/options";

export default {
    components: {InfoCard},
    mounted() {
    },
    computed: {
        slides: () => {
            return Object.keys(import.meta.glob('@/assets/carousel/*'))
        },
        ...mapState(optionsStore, ['options'])
    },
    data() {
        return {
            overlay: true,
            colors: [
                'indigo',
                'warning',
                'pink darken-2',
                'red lighten-1',
                'deep-purple accent-4',
            ],
        }
    },
}
</script>
