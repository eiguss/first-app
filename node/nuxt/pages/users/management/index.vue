<script>
import { mapGetters, mapActions } from 'vuex';
import TableItemManagementMixin from "@/mixins/TableItemManagementMixin.vue";
export default {
    mixins: [TableItemManagementMixin],
    async asyncData({ store }) {
        await Promise.all([
            store.dispatch('users-management/getUsers'),
            store.dispatch('roles-management/getRoles'),
            store.dispatch('languages/getLanguages'),
        ]);
    },
    data() {
        return {
            labelsRoute: {
                title: 'users.management.title',
                addItemButton: 'users.management.add',
                modalCreateTitle:  'users.management.add',
                modalEditTitle: 'users.management.edit',
                modalDeleteText: 'users.management.deleteText',
            }
        };
    },
    computed: {
        ...mapGetters('users-management', {
            items: 'users',
            headers: 'headers',
            itemEditableFields: 'editableFields',
            defaultNewItem: 'defaultNew',
            actions: 'actions',
            data: 'data',
            getUserFromItem: 'getUserFromItem',
        }),
    },
    methods: {
        ...mapActions('users-management', {
            editUser: 'editUser',
            addUser: 'addUser',
        }),
        editItem () {
            this.editUser({ user: this.getUserFromItem(this.editedItem), index: this.editedIndex });
        },
        addItem () {
            this.addUser(this.getUserFromItem(this.editedItem));
        },
        disableEnableItem () {
            this.editedItem.active = !this.editedItem.active;
            this.editItem();
        },
        rowClasses (item) {
            if (item.active===false) { 
                return 'disabled';
            }
        },
    }
};
</script>