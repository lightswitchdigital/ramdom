<template>
    <div class="editor-wrapper">
        <h2 class="editor-floor__title">{{ title }}</h2>
        <div class="editor-bg"></div>
        <div class="container">
            <div class="row editor-floor">
                <div class="col-md img-wrapper">
                    <div class="img-block">
                        <img :src="'/images/Schema' + image + '.png'" alt="">
                    </div>
                    <div class="price-block">
                        {{ changedPrice }}&nbsp;<span>руб.</span>
                    </div>
                </div>
                <div class="col-md inputs-wrapper">
                    <form @change.prevent="saveProject">
                        <div v-for="(cell, index) in cells" :key="index" class="input-block">
                            <p>
                                {{ cell.label }}
                                <span v-if="cell.id == 'C15'">, F</span>
                                <span v-if="cell.id == 'C14'">, M</span>
                            </p>
                            <select v-if="cell.type == 'select'" :value="savedAttributes[cell.id] || cell.def"
                                    class="custom-select"
                                    @input="saveStringValue(cell.id, $event.target.value)">
                                <option v-for="(variant, index) in cell.variants" :key="cell.id+index" :value="variant">
                                    {{ variant }}
                                </option>
                            </select>
                            <input v-else-if="cell.type == 'number'" :placeholder="cell.def" :value="savedAttributes[cell.id]"
                                   step="1"
                                   type="number"
                                   @input="saveValue(cell.id, $event.target.value)"/>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</template>
<script>
export default {
    name: 'editor',
    data: () => ({
        savedAttributes: {},
        changedPrice: 907057,
        cells: {},
        image: 2
    }),
    props: [
        'title'
    ],
    created() {
        this.csrfToken = document.querySelector('meta[name="csrf-token"]').content
    },
    mounted() {
        fetch('/internal/mappingsEditor.json',
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
            });
        axios.get("https://www.rbc.work/profile/smeta/constructor").then(response => {
            if (response.status === 200) {
                this.changedPrice = Math.floor(response.data)
            }
        }).catch(error => {
            console.log(error);
        })
    },
    methods: {
        toString(o) {
            Object.keys(o).forEach(k => {
                if (typeof o[k] === 'object') {
                    return toString(o[k]);
                }
                o[k] = '' + o[k];
            });

            return o;
        },
        saveProject() {
            axios.get("https://www.rbc.work/profile/smeta/constructor", {params: this.toString(this.savedAttributes)}).then(response => {
                if (response.status === 200) {
                    this.changedPrice = Math.floor(response.data)
                }
            }).catch(error => {
                console.log(error);
            })
        },
        saveValue(id, value) {
            this.savedAttributes[id] = value
            this.saveProject()
        },
        saveStringValue(id, value) {
            this.savedAttributes[id] = value
            this.saveProject()
            if (id === 'A6') {
                switch (value.trim()) {
                    case '2 полноценных этажа':
                        this.image = 1
                        break
                    case '1 полноценный этаж':
                        this.image = 2
                        break
                    case '1 этаж + 2-ой мансардный':
                        this.image = 3
                        break
                    case '1 эт + 2-ой мансарда с перекрытием':
                        this.image = 4
                        break
                    case '1 мансардный этаж':
                        this.image = 5
                        break
                    default:
                        this.image = 1
                        break
                }
            }
        },
    }
}
</script>
