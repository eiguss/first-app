<template>
    <div>
        <v-data-table
            :headers="headers"
            :items="items"
            :item-class= "rowClasses"
            sort-by="calories"
            class="elevation-1 table-item-management-mixin"
        >
            <template v-slot:top>
                <v-toolbar flat>
                    <v-toolbar-title>{{ $t(labelsRoute.title) }}</v-toolbar-title>
                    <v-spacer></v-spacer>
                    <v-dialog
                        v-model="dialog"
                        max-width="500px"
                    >
                        <template v-slot:activator="{ on, attrs }">
                                <v-btn color="primary" dark class="mb-2" @click="actionAddItem" v-bind="attrs" v-on="on">
                                    {{  $t(labelsRoute.addItemButton) }}
                                </v-btn>
                        </template>
                        <v-card>
                            <v-card-title>
                                <span class="text-h5">
                                    {{ editIndex>-1 ?  $t(labelsRoute.modalEditTitle) :  $t(labelsRoute.modalCreateTitle) }}
                                </span>
                            </v-card-title>
                            <v-card-text>
                                <v-container>
                                    <v-row>
                                        <v-col cols="12" sm="6" md="4"
                                            v-for="itemField in itemFields"
                                            :key="itemField.value"
                                        >
                                            <v-text-field
                                                v-model="editedItem[itemField.value]" 
                                                :label="itemField.text">
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
                            <v-card-title>{{ $t(labelsRoute.modalDeleteText, { item: itemToDelete()}) }}</v-card-title>
                            <v-card-actions>
                                <v-spacer></v-spacer>
                                <v-btn color="red darken-1" text @click="remove">{{$t('global.delete')}}</v-btn>
                                <v-btn color="darken-1" text @click="closeDelete">{{$t('global.cancel')}}</v-btn>
                                <v-spacer></v-spacer>
                            </v-card-actions>
                        </v-card>
                    </v-dialog>
                </v-toolbar>
            </template>
            <template v-slot:item.actions="{ item }">
                <v-icon small class="mr-2"
                    v-for="action in actions"
                    :key="action.name"
                    @click="actionEvent(item, action.name)"
                >{{ ( action.name=='disable_enable' && !item.active ) ? action.iconEnable : action.icon }}</v-icon>
            </template>
        </v-data-table>
    </div>
</template>

<script>
export default {
    data() {
        return {
            dialog: false,
            dialogDelete: false,
            editIndex: -1,
            editedItem: {},
            /* Rewritte labelsRoute on mix */
            labelsRoute: {
                title: '',
                addItemButton: '',
                modalCreateTitle: '',
                modalEditTitle: '',
                modalDeleteText: '',
            }
        };
    },
    computed: {
        /* Rewritte Computed on mix */
        items(){return []},
        headers(){return []},
        itemFields(){return []},
        defaultNewItem(){return []},
        actions(){return []},
    },
    methods: {
        actionEvent(item, action) {
            switch (action) {
                case 'edit':
                    this.actionEditItem(item)
                    break;
                case 'delete':
                    this.actionDeleteItem(item)
                    break;
                case 'disable_enable':
                    this.actionDisableEnableItem(item)
                    break;
            }
        },
        actionAddItem () {
            this.editIndex = -1;
            this.editedItem = Object.assign({}, this.defaultNewItem);
        },
        actionDisableEnableItem (item) {
            this.editIndex = this.items.indexOf(item);
            this.editedItem = Object.assign({}, item);
            this.disableEnableItem();
        },
        actionEditItem (item) {
            this.editIndex = this.items.indexOf(item);
            this.editedItem = Object.assign({}, item);
            this.dialog = true;
        },
        actionDeleteItem (item) {
            this.editIndex = this.items.indexOf(item);
            this.dialogDelete = true;
        },
        save () {
            if (this.editIndex > -1) {
                this.editItem();
            } else {
                this.addItem();
            }
            this.close()
        },
        close () {
            this.dialog = false;
            this.$nextTick(() => {
                this.editedItem = Object.assign({}, this.defaultNewItem)
                this.editIndex = -1
            })
        },
        remove(){
            this.deleteItem();
            this.closeDelete();
        },
        closeDelete () {
            this.dialogDelete = false;
            this.editIndex = -1;
        },
        /* Rewritte item methods on mix */
        itemToDelete (){
            // This needs to return the item identifier for delete text.
            // Example: return this.items[this.editIndex] ? this.items[this.editIndex]['name'] : '';
            return '';
        },
        editItem () {
            // TODO action to edit an item. Edited item on this.editedItem, edited item index this.editIndex
        },
        addItem () {
            // TODO action to add an item. New item on this.editedItem
        },
        deleteItem () {
            // TODO action to delete an item. Index of the deleted item: this.editIndex
        },
        disableEnableItem () {
            // TODO action to disable/enable an item. Index of the item: this.editIndex
        },
        rowClasses (item) {
            // TODO customize it if you want to have row with an specific class
            // Example: if (item.active===false) { return 'disabled' }
        }
    }
};
</script>