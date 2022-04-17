<script>
import { mapGetters } from 'vuex';
import TableItemManagementMixin from "@/mixins/TableItemManagementMixin.vue";
export default {
    mixins: [TableItemManagementMixin],
    async asyncData({ store }) {
        await store.dispatch('rights-management/getRights');
    },
    data() {
        return {
            labelsRoute: {
                title: 'rights.management.title',
                addItemButton: 'rights.management.add',
                modalCreateTitle:  'rights.management.add',
                modalEditTitle: 'rights.management.edit',
                modalDeleteText: 'rights.management.deleteText',
            }
        };
    },
    computed: {
        ...mapGetters('rights-management', {
            items: 'rights',
            headers: 'headers',
            itemFields: 'fields',
            defaultNewItem: 'defaultNew',
            actions: 'actions',
        }),
    },
    methods: {
        itemToDelete (){
            return this.editIndex>-1 ? this.items[this.editIndex]['name'] : '';
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