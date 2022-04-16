<template>
    <div>
        <v-data-table
            :headers="headers"
            :items="users"
            sort-by="calories"
            class="elevation-1"
        >
            <template v-slot:top>
                <v-toolbar
                    flat
                >
                    <v-toolbar-title>{{$t('users.management.title')}}</v-toolbar-title>
                    <v-divider
                        class="mx-4"
                        inset
                        vertical
                    ></v-divider>
                    <v-spacer></v-spacer>
                    <v-btn
                        color="primary"
                        dark
                        class="mb-2"
                        @click="addUser"
                    >
                        New Item
                    </v-btn>
                    <v-dialog v-model="dialogDelete" max-width="500px">
                        <v-card>
                            <v-card-title class="text-h5">Are you sure you want to delete this item?</v-card-title>
                            <v-card-actions>
                                <v-spacer></v-spacer>
                                <v-btn color="blue darken-1" text @click="closeDelete">Cancel</v-btn>
                                <v-btn color="blue darken-1" text @click="deleteUserConfirm">OK</v-btn>
                                <v-spacer></v-spacer>
                            </v-card-actions>
                        </v-card>
                    </v-dialog>
                </v-toolbar>
            </template>
            <template v-slot:item.actions="{ item }">
                <v-icon
                    small
                    class="mr-2"
                    @click="editUser(item)"
                >
                    mdi-pencil
                </v-icon>
                <v-icon
                    small
                    @click="deleteUser(item)"
                >
                    mdi-delete
                </v-icon>
            </template>
            <template v-slot:no-data>
                No users
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
            this.deleteIndex = user.id;
            this.dialogDelete = true;
        },
        deleteUserConfirm () {
            console.log('Delete user '+this.deleteIndex);
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
    }
};
</script>