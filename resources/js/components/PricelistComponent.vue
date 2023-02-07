<template>
    <div class="container">
        <div v-for="(group, name) in this.groups" :key="name" class="price-list__group">
            <pricelist-group :group="group" :group-name="name" :values="values"
                             @group="saveAttributes"></pricelist-group>
        </div>
        <div class="price-list__btn-group">
            <button class="yellow-btn" @click.prevent="saveProject">Сохранить</button>
        </div>
    </div>
</template>
<script>
import PricelistGroup from "./PricelistGroupComponent";

export default {
    name: 'pricelist',
    components: {PricelistGroup},
    data: () => ({
        savedAttributes: {},
        cells: {},
        values: {},
        groups: [],
        names: []
    }),
    props: [
        'saveFile',
        'saveUrl'
    ],
    created() {
        this.csrfToken = document.querySelector('meta[name="csrf-token"]').content
    },
    mounted() {
        fetch('/internal/pricelist.json',
            {
                headers: {
                    'Content-Type': 'application/json',
                    'Accept': 'application/json'
                }
            }).then(function (response) {
            return response.json();
        })
            .then((data) => {
                this.cells = data.cells
                this.getNames()
                this.getGroups()
                if (this.saveFile) {
                    this.values = this.saveFile.data
                }
            });
    },
    methods: {
        saveProject() {
            axios.post(this.saveUrl, this.savedAttributes).then(alert("Изменения сохранены")).catch(error => console.log(error))
        },
        getGroups() {
            this.groups = this.names.reduce((groups, el) => {
                let item = el[0]
                return {
                    ...groups,
                    [item.group]: [...(groups[item.group] || []), el]
                }
            }, {});
        },
        getNames() {
            for (let cell in this.cells) {
                let index = this.cells[cell].line - 3;
                (this.names[index] || (this.names[index] = [])).push(this.cells[cell])
            }
        },
        saveAttributes(data) {
            const {savedAttributes} = data
            for (let key in savedAttributes) {
                this.savedAttributes[key] = savedAttributes[key]
            }
        }
    }
}
</script>
