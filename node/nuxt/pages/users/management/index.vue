<template>
    <div>
        <v-data-table
            :headers="headers"
            :items="users"
            sort-by="calories"
            class="elevation-1"
        >
            <template v-slot:top>
                <v-toolbar flat>
                    <v-toolbar-title>{{$t('users.management.title')}}</v-toolbar-title>
                    <v-spacer></v-spacer>
                    <v-dialog
                        v-model="dialog"
                        max-width="500px"
                    >
                        <template v-slot:activator="{ on, attrs }">
                                <v-btn color="primary" dark class="mb-2" @click="actionAddUser" v-bind="attrs" v-on="on">
                                    {{$t('users.management.addUser')}}
                                </v-btn>
                        </template>
                        <v-card>
                            <v-card-title>
                                <span class="text-h5">
                                    {{ editIndex>-1 ? $t('users.management.editUser') : $t('users.management.addUser')}}
                                </span>
                            </v-card-title>
                            <v-card-text>
                                <v-container>
                                    <v-row>
                                        <v-col cols="12" sm="6" md="4"
                                            v-for="userField in userFields"
                                        >
                                            <v-text-field
                                                v-model="editedUser[userField.value]" 
                                                :label="userField.text">
                                            </v-text-field>
                                        </v-col>
                                    </v-row>
                                </v-container>
                            </v-card-text>
                            <v-card-actions>
                                <v-spacer></v-spacer>
                                <v-btn color="blue darken-1" text @click="save">
                                    {{ editIndex>-1 ? $t('global.edit') : $t('global.create')}}
                                </v-btn>
                                <v-btn color="darken-1" text @click="close">{{$t('global.cancel')}}</v-btn>
                            </v-card-actions>
                        </v-card>
                    </v-dialog>
                    <v-dialog v-model="dialogDelete" max-width="500px">
                        <v-card>
                            <v-card-title>{{ $t('users.management.deleteText', { userMail: userToDelete()}) }}</v-card-title>
                            <v-card-actions>
                                <v-spacer></v-spacer>
                                <v-btn color="red darken-1" text @click="deleteUser">{{$t('global.delete')}}</v-btn>
                                <v-btn color="darken-1" text @click="closeDelete">{{$t('global.cancel')}}</v-btn>
                                <v-spacer></v-spacer>
                            </v-card-actions>
                        </v-card>
                    </v-dialog>
                </v-toolbar>
            </template>
            <template v-slot:item.actions="{ item }">
                <v-icon small class="mr-2" @click="actionEditUser(item)">mdi-pencil</v-icon>
                <v-icon small @click="actionDeleteUser(item)">mdi-delete</v-icon>
            </template>
        </v-data-table>
    </div>
</template>

<script>
import { mapGetters } from 'vuex';
export default {
    async asyncData({ store }) {
        await store.dispatch('users-management/getUsers');
    },
    data() {
        return {
            dialog: false,
            dialogDelete: false,
            deleteIndex: -1,
            editIndex: -1,
            editedUser: {},
            defaultNewUser: {
                name: '',
                email: '',
                role: '',
                language_name: '',
            },
        };
    },
    computed: {
        ...mapGetters('users-management', {
            users: 'users',
            headers: 'headers',
            userFields: 'userFields'
        }),
    },
    methods: {
        actionAddUser () {
            this.editIndex = -1;
            this.editedUser = Object.assign({}, this.defaultNewUser);
        },
        actionEditUser (user) {
            this.editIndex = this.users.indexOf(user);
            this.editedUser = Object.assign({}, user);
            this.dialog = true;
        },
        actionDeleteUser (user) {
            this.editIndex = -1;
            this.deleteIndex = this.users.indexOf(user);
            this.dialogDelete = true;
        },
        editUser () {
            console.log('Edit user '+this.users[this.editIndex]['email']);
        },
        addUser () {
            console.log('Add user '+this.editedUser['email']);
        },
        deleteUser () {
            console.log('Delete user '+this.users[this.deleteIndex]['email']);
            this.closeDelete();
        },
        userToDelete (){
            return this.deleteIndex!=-1 ? this.users[this.deleteIndex]['email'] : '';
        },
        save () {
            if (this.editIndex > -1) {
                this.editUser();
            } else {
                this.addUser();
            }
            this.close()
        },
        close () {
            this.dialog = false
            this.$nextTick(() => {
            this.editedUser = Object.assign({}, this.defaultNewUser)
            this.editIndex = -1
            })
        },
        closeDelete () {
            this.dialogDelete = false;
            this.editIndex = -1;
        },
    }
};
</script>