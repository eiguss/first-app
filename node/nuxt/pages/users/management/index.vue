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
                    <v-btn color="primary" dark class="mb-2" @click="addUser">
                        {{$t('users.management.addUser')}}
                    </v-btn>
                    <v-dialog v-model="dialogDelete" max-width="500px">
                        <v-card>
                            <v-card-title>{{ $t('users.management.deleteText', { userMail: userToDelete()}) }}</v-card-title>
                            <v-card-actions>
                                <v-spacer></v-spacer>
                                <v-btn color="red darken-1" text @click="deleteUserConfirm">{{$t('global.delete')}}</v-btn>
                                <v-btn color="darken-1" text @click="closeDelete">{{$t('global.cancel')}}</v-btn>
                                <v-spacer></v-spacer>
                            </v-card-actions>
                        </v-card>
                    </v-dialog>
                </v-toolbar>
            </template>
            <template v-slot:item.actions="{ item }">
                <v-icon small class="mr-2" @click="editUser(item)">mdi-pencil</v-icon>
                <v-icon small @click="deleteUser(item)">mdi-delete</v-icon>
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
            dialogDelete: false,
            deleteIndex: -1,
        };
    },
    computed: {
        ...mapGetters('users-management', {
            users: 'users',
            headers: 'headers',
        }),
    },
    methods: {
        deleteUser (user) {
            this.deleteIndex = this.users.indexOf(user);
            this.dialogDelete = true;
        },
        deleteUserConfirm () {
            console.log('Delete user '+this.users[this.deleteIndex]['email']);
            this.closeDelete();
        },
        closeDelete () {
            this.dialogDelete = false;
            this.editedIndex = -1;
        },
        addUser () {
            console.log('Add user');
        },
        editUser (user) {
            console.log('Edit user '+ user.id);
        },
        userToDelete (){
            return this.deleteIndex!=-1 ? this.users[this.deleteIndex]['email'] : '';
        }
    }
};
</script>