<template>
    <div>
        <v-card
            class="mx-auto my-12"
            max-width="374"
        >
            <v-card-title class="blue darken-2 white--text">
                Login
            </v-card-title>
            <v-card-text @keyup.enter="login">
                 <template v-if="!userLogged">
                    <v-alert
                        v-if="showError"
                        dense
                        text
                        type="error"
                        class="mt-6"
                    >
                        Invalid user/password
                    </v-alert>
                    <v-text-field 
                        v-model="email"
                        label="Email"
                    ></v-text-field>
                    <v-text-field
                        v-model="password"
                        :append-icon="showPassword ? 'mdi-eye' : 'mdi-eye-off'"
                        :type="showPassword ? 'text' : 'password'"
                        @click:append="showPassword = !showPassword"
                        label="Password"
                    ></v-text-field>
                </template>
                <template v-else>
                    <v-alert
                        dense
                        text
                        type="success"
                        class="mt-6"
                    >
                        Welcome! redirecting...
                    </v-alert>
                </template>
            </v-card-text>
             <v-card-actions v-if="!userLogged">
                <v-btn
                    color="primary"
                    @click="login"
                    :disabled="password==''||email==''"
                >
                    login
                </v-btn>
            </v-card-actions>
        </v-card>
    </div>
</template>

<script>
    import { mapActions } from 'vuex';
    export default {
        layout() {
            return 'none';
        },
        data() {
            return {
                showPassword: false,
                showError: false,
                userLogged: false,
                email: "",
                password: "",
            };
        },
        methods: Object.assign(
            mapActions('user', {
                userLogin: 'login',
            }),{
                async login(){
                    var userLogedIn = await this.userLogin({
                        email: this.email,
                        password: this.password
                    });

                    if(userLogedIn){
                        this.userLogged=true;
                        setTimeout(()=>{ this.$router.push('/'); }, 1000);
                    }else{
                        this.showError=true;
                        this.email='';
                        this.password='';
                    }
                }
            }
        )
    }
</script>