<template>
    <v-app-bar
        color="white"
        elevation="3"
    >
        <v-app-bar-nav-icon @click.stop="toggleSidebarVisibility()"></v-app-bar-nav-icon>
        <v-app-bar-title>{{ $t("header.title") }}</v-app-bar-title>
        <v-spacer></v-spacer>
        <v-tooltip left>
            <template v-slot:activator="{ on, attrs }">
                <v-btn
                    icon 
                    @click.stop="logout()"
                    v-bind="attrs"
                    v-on="on"    
                >
                    <v-icon>mdi-logout</v-icon>
                </v-btn>
            </template>
            <span>{{ $t("header.logout") }}</span>
        </v-tooltip>
    </v-app-bar>
</template>

<script>
import { mapMutations, mapActions } from 'vuex';
export default {
    methods: {
        ...mapMutations('sidebar',{
            toggleSidebarVisibility: 'TOGGLE_VISIBILITY'
        }),
        ...mapActions('logged-user', {
            userLogout: 'logout',
        }),
        async logout(){
            await this.userLogout();
        }
    },
}
</script>