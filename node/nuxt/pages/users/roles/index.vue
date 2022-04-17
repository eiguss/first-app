<script>
import { mapGetters } from 'vuex';
import TableItemManagementMixin from "@/mixins/TableItemManagementMixin.vue";
export default {
    mixins: [TableItemManagementMixin],
    async asyncData({ store }) {
        await store.dispatch('roles-management/getRoles');
    },
    data() {
        return {
            labelsRoute: {
                title: 'roles.management.title',
                addItemButton: 'roles.management.add',
                modalCreateTitle:  'roles.management.add',
                modalEditTitle: 'roles.management.edit',
                modalDeleteText: 'roles.management.deleteText',
            }
        };
    },
    computed: {
        ...mapGetters('roles-management', {
            items: 'roles',
            headers: 'headers',
            itemFields: 'fields',
            defaultNewItem: 'defaultNew',
            actions: 'actions',
        }),
    },
    methods: {
        itemToDelete (){
            return this.items[this.editIndex] ? this.items[this.editIndex]['name'] : '';
        },
        editItem () {
            console.log('Edit item ' + this.editedItem['name']);
        },
        addItem () {
            console.log('Add item ' + this.editedItem['name']);
        },
        deleteItem () {
            console.log('Delete item ' + this.items[this.editIndex]['name']);
        },
        search () {
            console.log(this.searchInput);
        },
    }
};
</script>