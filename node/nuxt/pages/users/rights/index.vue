<script>
import { mapGetters, mapActions } from 'vuex';
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
        ...mapActions('rights-management', {
            addRight: 'addRight',
            editRight: 'editRight',
        }),
        editItem () {
            this.editRight( { right: this.editedItem, index: this.editedIndex} );
        },
        addItem () {
            this.addRight(this.editedItem);
        },
    }
};
</script>