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
                addItemButton: 'rights.management.addUser',
                modalCreateTitle:  'rights.management.editUser',
                modalEditTitle: 'rights.management.addUser',
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
        }),
    },
    methods: {
        itemToDelete (){
            return this.items[this.deleteIndex] ? this.items[this.deleteIndex]['name'] : '';
        },
        editItem () {
            console.log('Edit item ' + this.editedItem['name']);
        },
        addItem () {
            console.log('Add item ' + this.editedItem['name']);
        },
        deleteItem () {
            console.log('Delete item ' + this.items[this.deleteIndex]['name']);
        },
    }
};
</script>