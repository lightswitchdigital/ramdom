<template>
    <div>
        <h1 class="price-list__title" @click.prevent="isOpen = !isOpen">{{ groupName }}
            <img v-if="isOpen" class="price-list-open-btn" src="/images/arrow-up.png"/>
            <img v-else class="price-list-open-btn" src="/images/arrow-down.png"/>
        </h1>
        <div v-if="isOpen" class="price-list__isopen-wrapper">
            <form v-for="(el, index) in group" :key="index" class="price-list__wrapper">
                <p class="price-list__name">{{ el[0].name }}</p>
                <div class="price-list__flex">
                    <div v-for="(cell, index) in el" :key="index" class="input-block">
                        <p class="price-list__col-name">{{ cell.col }}</p>
                        <input :placeholder="cell.def"
                               :value="values[cell.id]"
                               class="price-list__input"
                               type="number"
                               @input="saveValue(cell.id, $event.target.value)"/>
                    </div>
                </div>
            </form>
        </div>
    </div>
</template>
<script>
export default {
    name: 'pricelist-group',
    data: () => ({
        savedAttributes: {},
        isOpen: false
    }),
    props: [
        'group',
        'groupName',
        'values'
    ],
    mounted() {
        this.savedAttributes = this.values
    },
    methods: {
        groupSend() {
            this.$emit('group', {
                savedAttributes: this.savedAttributes
            })
        },
        saveValue(id, value) {
            this.savedAttributes[id] = +value
            this.groupSend()
        },
        getValue(arr, id) {
            for (let key in this.values) {
                if (arr[key] && arr[key].id == id) {
                    return this.values[key]
                }
            }
        }
    }
}
</script>
