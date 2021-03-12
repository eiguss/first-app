<template>
  <div>
         <v-card
            class="mx-auto my-12"
            max-width="374"
        >
            <v-card-title class="blue darken-2 white--text">
                Welcome {{name}}!
            </v-card-title>
            <v-card-text>
                <div class="mt-6">
                    I'm glag to have you here user named "{{name}}" with email "{{email}}"
                </div>
            </v-card-text>
             <v-card-actions>
                <v-btn
                    @click="logout"
                >
                    login
                </v-btn>
            </v-card-actions>
        </v-card>
  </div>
</template>

<script>
    import { mapActions, mapGetters } from 'vuex';
    export default {
        computed: Object.assign(
            mapGetters('user', {
                email: 'email',
                name: 'name',
            }),
        ),
        methods: Object.assign(
            mapActions('user', {
                userLogout: 'logout',
            }),{
                async logout(){
                    await this.userLogout();
                    this.$router.push('/login');
                }
            }
        )
    }
</script>