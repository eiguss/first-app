<template>
    <div>
        <v-data-table
            :headers="headers"
            :items="items"
            :item-class= "rowClasses"
            sort-by="calories"
            class="elevation-1 table-item-management-mixin"
            :search="searchInput"
        >
            <template v-slot:top>
                <v-toolbar flat>
                    <v-toolbar-title>{{ $t(labelsRoute.title) }}</v-toolbar-title>
                    <v-spacer></v-spacer>
                    <v-text-field
                        v-if="searchActive"
                        v-model="searchInput"
                        append-icon="mdi-magnify"
                        label="Search"
                        single-line
                        hide-details
                        clearable
                        class="mr-8 search-input"
                    ></v-text-field>
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
                                    {{ editedIndex>-1 ?  $t(labelsRoute.modalEditTitle) :  $t(labelsRoute.modalCreateTitle) }}
                                </span>
                            </v-card-title>
                            <v-card-text>
                                <v-container>
                                    <v-row>
                                        <v-col cols="12" sm="6" md="4"
                                            v-for="itemEditableField in itemEditableFields"
                                            :key="itemEditableField.value"
                                        >
                                            <v-select
                                                v-if="itemEditableField.type==='dropdown'"
                                                v-model="editedItem[itemEditableField.key]"
                                                :items="data[itemEditableField.dataKey].items"
                                                :item-text="data[itemEditableField.dataKey].textKey"
                                                :item-value="data[itemEditableField.dataKey].valueKey"
                                                :label="itemEditableField.text"
                                                hide-selected
                                            ></v-select>
                                            <v-text-field
                                                v-else
                                                v-model="editedItem[itemEditableField.value]" 
                                                :label="itemEditableField.text">
                                            </v-text-field>
                                        </v-col>
                                    </v-row>
                                </v-container>
                            </v-card-text>
                            <v-card-actions>
                                <v-spacer></v-spacer>
                                <v-btn color="blue darken-1" text @click="save">
                                    {{ editedIndex>-1 ? $t('global.edit') : $t('global.create')}}
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
                >{{ action.icon }}</v-icon>
            </template>
            <template v-slot:item.active="{ item }">
                <v-simple-checkbox 
                    :value="item.active"
                    @click="actionEvent(item,'disable_enable')"
                ></v-simple-checkbox>
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
            editedIndex: -1,
            editedItem: {},
            searchActive: true,
            searchInput: '',
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
        itemEditableFields(){return []},
        defaultNewItem(){return []},
        actions(){return []},
        data(){return []},
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
            this.editedIndex = -1;
            this.editedItem = Object.assign({}, this.defaultNewItem);
        },
        actionDisableEnableItem (item) {
            this.editedIndex = this.items.indexOf(item);
            this.editedItem = Object.assign({}, item);
            this.disableEnableItem();
        },
        actionEditItem (item) {
            this.editedIndex = this.items.indexOf(item);
            this.editedItem = Object.assign({}, item);
            this.dialog = true;
        },
        actionDeleteItem (item) {
            this.editedIndex = this.items.indexOf(item);
            this.dialogDelete = true;
        },
        save () {
            if (this.editedIndex > -1) {
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
                this.editedIndex = -1
            })
        },
        remove(){
            this.deleteItem();
            this.closeDelete();
        },
        closeDelete () {
            this.dialogDelete = false;
            this.editedIndex = -1;
        },
        /* Rewritte item methods on mix */
        itemToDelete () {
            // This needs to return the item identifier for delete text.
            // Example: return this.items[this.editedIndex] ? this.items[this.editedIndex]['name'] : '';
            return '';
        },
        editItem () {
            // TODO action to edit an item. Edited item on this.editedItem, edited item index this.editedIndex
        },
        addItem () {
            // TODO action to add an item. New item on this.editedItem
        },
        deleteItem () {
            // TODO action to delete an item. Index of the deleted item: this.editedIndex
        },
        disableEnableItem () {
            // TODO action to disable/enable an item. Index of the item: this.editedIndex
        },
        rowClasses (item) {
            // TODO customize it if you want to have row with an specific class
            // Example: if (item.active===false) { return 'disabled' }
        }
    }
};
</script>