<template>
    <div class="container project-view editorModal">
        <div v-if="!isMobile()">
            <div class="row">
                <div class="col">
                    <ul>
                        <li v-for="(group, index) in this.groups" :key="index">
                            <a :class="[changedGroup == group ? 'active' : '']" href="#"
                               @click.prevent="changeGroup(group)">
                                <span>{{ group.charAt(0).toUpperCase() + group.slice(1).toLowerCase() }}</span>
                                <i class="fas fa-chevron-right"></i>
                            </a>
                        </li>
                    </ul>
                </div>
                <div class="col">
                    <ul>
                        <li v-for="(cell, index) in this.changedCells" :key="index">
                            <a :class="[changedCell.id == cell.id ? 'active' : '']" href="#"
                               @click.prevent="changeCell(cell.id)">
                                <span>{{ cell.label + (cell.subgroup ? ' (' + cell.subgroup + ')' : '') }}</span>
                                <i class="fas fa-chevron-right"></i>
                            </a>
                        </li>
                    </ul>
                </div>
                <div class="col last-col-with-img">
                    <form v-if="this.changedCell.label" @submit.prevent="sendJson">
                        <strong>{{ this.changedCell.label + (this.changedCell.subgroup ? ' (' + this.changedCell.subgroup + ')' : '') }}
                        </strong>
                        <p>
                            Изменить:
                            <input v-if="this.changedCell.type == 'number'"
                                   :placeholder="changedCell.def" :value="this.savedAttributes[changedCell.id]"
                                   class="form-control"
                                   type="number"
                                   @input.prevent="saveValue(changedCell.id, $event.target.value)"
                                   @blur.prevent="sendJson()"
                            />
                            <select v-else-if="this.changedCell.type == 'select'" :value="getValue(changedCell.id)"
                                    class="custom-select"
                                    @input.prevent="saveValue(changedCell.id, $event.target.value)">
                                <option v-for="(option, index) in this.changedCell.variants"
                                        :key="index"
                                        :selected="option == getValue(changedCell.id)"
                                        :value="option">
                                    {{ option }}
                                </option>
                            </select>
                        </p>
                    </form>
                    <div v-if="this.changedCell" class="img-block">
                        <img :src="'/images/Schema' + image + '.png'" alt="">
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <h4 v-if="this.changedPrice">Цена: {{ changedPrice }}</h4>
                <a :href="this.smetaDownloadLink" class="btn yellow-outline-btn" download>Скачать смету</a>
                <button v-if="!this.isDeveloper" class="btn yellow-btn" type="button" @click.prevent="findBuilders()">
                    Найти застройщика
                </button>
            </div>
        </div>
        <div v-else class="modal-dialog modal-sm">
            <div class="modal-content">
                <div class="modal-body">
                    <h5 class="mobile-editor-title">
                        Редактирование доступно только на компьютере
                    </h5>
                </div>
            </div>
        </div>
    </div>
</template>
<script>
export default {
    name: 'smeta',
    data: () => ({
        savedAttributes: {},
        notAllChange: false,
        cells: {},
        changedCell: {},
        changedCells: {},
        groups: [],
        changedGroup: '',
        changedPrice: '',
        values_data: {},
        forSave: {},
        image: 2,
        hasEdits: false
    }),
    props: [
        'saveFile',
        'jsonUrl',
        'calculateRoute',
        'saveEditorDataLink',
        'smetaDownloadLink',
        'isDeveloper'
    ],
    created() {
        this.csrfToken = document.querySelector('meta[name="csrf-token"]').content
    },
    methods: {
        sendJson() {
            if (this.saveFile) {
                axios.post(this.saveEditorDataLink, this.savedAttributes).then(response => {
                    this.changedPrice = response.data.price
                    this.hasEdits = false
                }).catch(error => {
                    alert('Ошибка на сервере. Мы уже занимаемся этим вопросом')
                    console.log(error);
                })
            }
        },
        cancelEdit() {
            if (confirm("Сбросить изменения?")) {
                axios.get(this.project.file_url).then(response => {
                    if (response.status === 200) {
                        this.values_data = response.data
                    }
                }).catch(error => {
                    console.log(error);
                })
            }
        },
        changeCell(id) {
            for (let cell in this.cells) {
                if (this.cells[cell] && this.cells[cell].id == id) {
                    this.changedCell = this.cells[cell]
                }
            }
        },
        getGroups() {
            for (let cell in this.cells) {
                if (this.cells[cell].group && !this.groups.includes(this.cells[cell].group)) {
                    this.groups.push(this.cells[cell].group)
                }
            }
        },
        changeGroup(group) {
            this.changedCells = []
            this.changedGroup = group
            for (let cell in this.cells) {
                if (this.cells[cell] && this.cells[cell].group == group) {
                    this.changedCells.push(this.cells[cell])
                }
            }

        },
        getValue(id) {
            for (let key in this.savedAttributes) if (key === id) return this.savedAttributes[key]
        },
        saveValue(id, value) {
            if (this.changedCell.type == 'number') {
                let numVal = +value
                this.savedAttributes[id] = numVal
                this.hasEdits || (this.hasEdits = true)
            } else if (this.changedCell.type == 'select') {
                this.savedAttributes[id] = value
                this.hasEdits || (this.hasEdits = true)
                this.sendJson()
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
            }
        },
        isMobile() {
            return /Android|webOS|iPhone|iPad|iPod|BlackBerry|IEMobile|Opera Mini/i.test(navigator.userAgent);
        },
        dawnloadSmeta() {
            this.sendJson()
        },
        findBuilders() {
            window.location.href = 'smeta/developers';
        }
    },
    mounted() {
        this.$nextTick(this.$forceUpdate);
        if (this.saveFile) {
            this.changedPrice = this.saveFile.price
            this.values_data = this.saveFile.data
            if (typeof this.values_data == 'object' && Object.keys(this.values_data).length) {
                this.savedAttributes = this.values_data
                let value = this.savedAttributes['A6']
                if (value) {
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
            }
        } else {
            axios.post('https://www.rbc.work/profile/smeta').then(response => {
                if (response.status === 200) {
                    this.changedPrice = response.data.price
                }
            }).catch(error => {
                console.log(error);
            })
        }
        axios.get(this.jsonUrl).then(response => {
            if (response.status === 200) {
                this.cells = response.data.cells
                this.getGroups()
            }
        }).catch(error => {
            console.log(error);
        })
    }
}
</script>
