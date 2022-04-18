<script>
import { mapGetters } from 'vuex';
import TableItemManagementMixin from "@/mixins/TableItemManagementMixin.vue";
export default {
    mixins: [TableItemManagementMixin],
    async asyncData({ store }) {
        await store.dispatch('users-management/getUsers');
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
            itemFields: 'fields',
            defaultNewItem: 'defaultNew',
            actions: 'actions',
        }),
    },
    methods: {
        itemToDelete (){
            return this.items[this.editIndex] ? this.items[this.editIndex]['email'] : '';
        },
        editItem () {
            console.log('Edit item ' + this.editedItem['email']);
        },
        addItem () {
            console.log('Add item ' + this.editedItem['email']);
        },
        disableEnableItem () {
            console.log('Disable/enable item ' + this.items[this.editIndex]['email']);
        },
        rowClasses (item) {
            if (item.active===false) { 
                return 'disabled';
            }
        },
    }
};
</script>