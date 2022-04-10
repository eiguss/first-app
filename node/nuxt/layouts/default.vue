<template>
    <v-app>
        <app-header></app-header>
        <sidebar></sidebar>
        <v-main>
            <v-container fluid>
                <Nuxt />
            </v-container>
        </v-main>
    </v-app>
</template>

<script>
import sidebar from '../components/sidebar.vue';
import appHeader from '../components/header.vue';
export default {
    components: {
        sidebar,
        appHeader,
    },
    middleware: ['auth'],
}
</script>