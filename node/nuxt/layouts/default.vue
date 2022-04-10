<template>
    <v-app>
        <app-header></app-header>
        <sidebar></sidebar>
        <v-main>
            <v-container class="mt-16">
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