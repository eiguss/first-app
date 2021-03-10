<template>
    <div>
        <v-card
            class="mx-auto my-12"
            max-width="374"
        >
            <v-card-title class="blue darken-2 white--text">
                Login
            </v-card-title>
            <v-card-text>

                <v-text-field 
                    v-model="user"
                    label="User"
                    class="mt-6"
                ></v-text-field>
                <v-text-field
                    v-model="password"
                    :append-icon="showPassword ? 'mdi-eye' : 'mdi-eye-off'"
                    :type="showPassword ? 'text' : 'password'"
                    @click:append="showPassword = !showPassword"
                    label="Password"
                ></v-text-field>
            </v-card-text>
             <v-card-actions>
                <v-btn
                    color="primary"
                    @click="login"
                    :disabled="password==''||user==''"
                >
                    login
                </v-btn>
            </v-card-actions>
        </v-card>
    </div>
</template>

<script>
    export default {
        layout() {
            return 'none';
        },
        data() {
            return {
                showPassword: false,
                user: "",
                password: "",
            };
        },
        methods: {
            login(){
                console.log("TODO login");
            },
        }
    }
</script>