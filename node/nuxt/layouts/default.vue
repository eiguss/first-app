<template>
    <v-app>
        <app-header></app-header>
        <sidebar></sidebar>
        <v-main>
            <v-container>
                <Nuxt />
            </v-container>
        </v-main>
    </v-app>
</template>

<script>
import { mapGetters } from 'vuex';
import sidebar from '../components/sidebar.vue';
import appHeader from '../components/header.vue';
export default {
    components: {
        sidebar,
        appHeader,
    },
    middleware: ['auth'],
    computed: {
        ...mapGetters('logged-user', {
            userEmail: 'email',
        }),
    },
}
</script>