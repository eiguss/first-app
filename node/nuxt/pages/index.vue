<template>
    <div v-if="name!=''">
        <v-card
            class="mx-auto my-12"
            max-width="374"
        >
            <v-card-title class="blue darken-2 white--text">
                Welcome {{ name }}!
            </v-card-title>
            <v-card-text>
                <div class="mt-6">
                    {{ $t('login.welcome_text', { name: name, email: email }) }}
                </div>
            </v-card-text>
            <v-card-actions>
                <v-btn
                    @click="logout"
                >
                    logout
                </v-btn>
            </v-card-actions>
        </v-card>
    </div>
</template>

<script>
import { mapActions, mapGetters } from 'vuex';
export default {
    computed: Object.assign(
        mapGetters('logged-user', {
            email: 'email',
            name: 'name',
        }),
    ),
    methods: Object.assign(
        mapActions('logged-user', {
            userLogout: 'logout',
        }),{
            async logout(){
                await this.userLogout();
                this.$router.push('/login');
            }
        }
    )
};
</script>