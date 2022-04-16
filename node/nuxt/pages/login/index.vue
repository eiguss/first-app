<template>
    <div class="login-page">
        {{loggedUserEmail}}
        <v-card
            class="mx-auto my-12"
            max-width="500"
        >
            <v-card-title>
                {{ $t('login.title') }}
            </v-card-title>
            <v-card-subtitle>
                {{ $t('login.subtitle') }}
            </v-card-subtitle>
            <v-divider></v-divider>
            <v-card-text @keyup.enter="login">
                <template v-if="loggedUserEmail===''">
                    <v-alert
                        v-if="showError"
                        dense
                        text
                        type="error"
                        class="mt-6"
                    >
                        {{ $t("login.invalid") }}
                    </v-alert>
                    <v-text-field 
                        v-model="email"
                        :label="$t('login.email')"
                    />
                    <v-text-field
                        v-model="password"
                        :append-icon="showPassword ? 'mdi-eye' : 'mdi-eye-off'"
                        :type="showPassword ? 'text' : 'password'"
                        :label="$t('login.password')"
                        @click:append="showPassword = !showPassword"
                    />
                </template>
                <template v-else>
                    <v-alert
                        dense
                        text
                        type="success"
                        class="mt-6"
                    >
                        {{ $t("login.welcome") }}
                    </v-alert>
                </template>
            </v-card-text>
            <v-card-actions v-if="loggedUserEmail===''">
                <v-btn
                    :disabled="password==''||email==''"
                    @click="login"
                    class="complementary"
                >
                    {{ $t("login.login") }}
                </v-btn>
            </v-card-actions>
        </v-card>
    </div>
</template>

<script>
import { mapActions, mapGetters } from 'vuex';
export default {
    layout() {
        return 'none';
    },
    async asyncData (context) {
        var isLogged = await context.store.dispatch('logged-user/isLoggedUser');
        if(isLogged){
            context.redirect('/');
        }
    },
    data() {
        return {
            showPassword: false,
            showError: false,
            email: '',
            password: '',
        };
    },
    computed: {
        ...mapGetters('global', {
            redirectPath: 'redirectPath',
        }),
        ...mapGetters('logged-user', {
            loggedUserEmail: 'email',
        }),
    },
    methods:{
        ...mapActions('logged-user', {
            userLogin: 'login',
        }),
        async login(){
            var userLogedIn = await this.userLogin({
                email: this.email,
                password: this.password
            });

            if(userLogedIn){
                this.$router.push(this.redirectPath);
            }else{
                this.showError=true;
                this.email='';
                this.password='';
            }
        }
    }
};
</script>