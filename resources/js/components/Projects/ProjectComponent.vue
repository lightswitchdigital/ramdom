<template>
        <div class="container project-view">
            <div v-if="this.isAuthenticated && (this.canEdit || this.saveFile)" class="modal fade" id="editorModal" tabindex="-1" aria-labelledby="editorModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-xl">
                    <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Редактирование шаблона</h5>
                        <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close">
                            <svg xmlns="http://www.w3.org/2000/svg" width="19" height="20" viewBox="0 0 19 20" fill="none">
                            <path d="M11.5499 9.95887L18.179 3.16637C18.4693 2.86822 18.6324 2.46385 18.6324 2.0422C18.6324 1.62056 18.4693 1.21619 18.179 0.918038C17.8887 0.61989 17.495 0.452393 17.0845 0.452393C16.6739 0.452393 16.2802 0.61989 15.9899 0.918038L9.37613 7.72637L2.76238 0.918038C2.47207 0.61989 2.07834 0.452393 1.66779 0.452393C1.25724 0.452393 0.863511 0.61989 0.57321 0.918038C0.282908 1.21619 0.119819 1.62056 0.119819 2.0422C0.119819 2.46385 0.282908 2.86822 0.57321 3.16637L7.20238 9.95887L0.57321 16.7514C0.428712 16.8986 0.314021 17.0737 0.235753 17.2666C0.157484 17.4596 0.117188 17.6665 0.117188 17.8755C0.117188 18.0846 0.157484 18.2915 0.235753 18.4845C0.314021 18.6774 0.428712 18.8525 0.57321 18.9997C0.716528 19.1481 0.887038 19.2659 1.0749 19.3463C1.26277 19.4267 1.46427 19.4681 1.66779 19.4681C1.87131 19.4681 2.07282 19.4267 2.26068 19.3463C2.44855 19.2659 2.61906 19.1481 2.76238 18.9997L9.37613 12.1914L15.9899 18.9997C16.1332 19.1481 16.3037 19.2659 16.4916 19.3463C16.6794 19.4267 16.8809 19.4681 17.0845 19.4681C17.288 19.4681 17.4895 19.4267 17.6773 19.3463C17.8652 19.2659 18.0357 19.1481 18.179 18.9997C18.3235 18.8525 18.4382 18.6774 18.5165 18.4845C18.5948 18.2915 18.6351 18.0846 18.6351 17.8755C18.6351 17.6665 18.5948 17.4596 18.5165 17.2666C18.4382 17.0737 18.3235 16.8986 18.179 16.7514L11.5499 9.95887Z" fill="white"/>
                            </svg>
                        </button>
                    </div>
                    <div class="modal-body">
                        <!-- <input type="text" class="search" placeholder="Название атрибута"> -->
                        <div class="row">
                            <div class="col">
                                <ul>
                                    <li v-for="(group, index) in this.groups" :key="index">
                                        <a href="#"  @click.prevent="changeGroup(group)" :class="[changedGroup == group ? 'active' : '']">
                                            <span>{{group}}</span>
                                            <i class="fas fa-chevron-right"></i>
                                        </a>
                                    </li>
                                </ul>
                            </div>
                            <div class="col">
                                <ul>
                                    <li v-for="(cell) in this.changedCells" :key="cell.id" >
                                        <a href="#" @click.prevent="changeCell(cell.id)" :class="[changedCell.id == cell.id ? 'active' : '']">
                                            <span>{{cell.label}}</span>
                                            <i class="fas fa-chevron-right"></i>
                                        </a>
                                    </li>
                                </ul>
                            </div>
                            <div class="col">
                                <form v-if="this.changedCell.label" @submit.prevent="saveValue(changedCell.id, modalValue)">
                                    <h5>{{this.changedCell.label}}: {{this.getValue(this.changedCell.id)}}</h5>
                                    <p>Изменить:
                                        <input v-if="this.changedCell.type == 'number'"
                                               type="number" class="form-control"
                                               :placeholder="getValue(this.changedCell.id)"
                                               @input="saveValue(changedCell.id, $event.target.value)"
                                        >

                                        <select class="custom-select" v-else-if="this.changedCell.type == 'select'" @input="saveValue(changedCell.id, $event.target.value)">
                                            <option v-for="(option, index) in this.changedCell.variants" :key="index">
                                                {{option}}
                                            </option>
                                        </select>
                                    </p>
                                </form>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <h4>Цена: {{this.changedPrice || this.project.price}}</h4>
                        <button type="button" class="btn yellow-outline-btn" :disabled='!this.hasEdits' @click.prevent="cancelEdit()">Сбросить</button>
                        <button type="button" class="btn yellow-btn" :disabled='!this.hasEdits' @click.prevent="sendJson()">Сохранить изменения</button>
                    </div>
                    </div>
                </div>
            </div>
        <h2 class="project-title">{{ project.title }}</h2>
        <div class="row">
            <div class="col-md-6">
                <div class="preview">
                    <VueSlickCarousel
                        ref="preview"
                        :asNavFor="$refs.miniPreview"
                        :focusOnSelect="true"
                        :fade="true"
                        :arrow="false">
                        <div class="preview-slide" v-for="(image , index) in project.jsonImages" :key="index">
                            <img :src="image" :alt="project.title">
                        </div>
                    </VueSlickCarousel>
                </div>
                <div class="mini-slider">
                    <VueSlickCarousel
                        ref="miniPreview"
                        :slidesToShow="1"
                        :variableWidth="true"
                        :focusOnSelect="true"
                        :arrow="true"
                        :asNavFor="$refs.preview"
                        :centerMode="true">
                        <div class="mini-preview" v-for="(image , index) in project.jsonImages" :key="index">
                            <img :src="image" :alt="project.title">
                        </div>
                        <template #nextArrow>
                            <div class="btn-next">
                                <i class="fas fa-chevron-right"></i>
                            </div>
                        </template>
                        <template #prevArrow>
                            <div class="btn-prev">
                                <i class="fas fa-chevron-left"></i>
                            </div>
                        </template>
                    </VueSlickCarousel>
                </div>
                <div class="card desc-card">
                    {{ project.description }}
                </div>
            </div>
            <div class="col-md-6">
                <div class="card info-card">
                    <div
                    v-if="isAuthenticated"
                    class="like-block"
                    :disabled="btnDisabled"
                    :class="[{active : project.isInFavorites} , favoritesClass]"
                    @click.prevent="toggleFavorites">
                        <span v-if="!project.isInFavorites">Добавить в избранное</span>
                        <span v-else>В избранном</span>
                        <span class="like"><i class="fas fa-heart"></i></span>
                    </div>

                    <form @submit.prevent='onSubmit' @change.prevent="saveProject">
                        <!-- <input type="hidden" name="_token" :value="this.csrfToken"> -->
                        <table class="table">
                            <tbody>
                                <tr v-for="(value, label , index) in project.jsonValues" :key="index">
                                    <td>{{ label }}</td>
                                    <td>{{ value }}</td>
                                </tr>
                                <tr v-for="(attribute , index) in this.purchaseAttributes" :key="index">
                                    <td>
                                        <label :for="'purchase_attribute_'+attribute.id" class="col-form-label">{{ attribute.name }}</label>
                                    </td>
                                    <td>
                                        <select v-if="attribute.variants.length > 0"
                                                :id="'purchase_attribute_'+attribute.id"
                                                class="custom-select"
                                                :name="'purchase_attributes['+attribute.id+']'"
                                                v-model="savedAttributes[attribute.id]">
                                            <option v-for="(variant , index) in attribute.variants" :value="variant" :key="index">
                                                {{ variant }}
                                            </option>
                                        </select>
                                        <input v-else-if="attribute.type === 'integer'"
                                        :id="'purchase_attribute_'+attribute.id"
                                        type="number" class="form-control"
                                        :name="'purchase_attributes['+attribute.id+']'"
                                        v-model="savedAttributes[attribute.id]">

                                        <input v-else
                                        :id="'purchase_attribute_'+attribute.id"
                                        type="text"
                                        class="form-control"
                                        :name="'purchase_attributes['+attribute.id+']'"
                                        v-model="savedAttributes[attribute.id]">
                                    </td>
                                </tr>
                            </tbody>

                        </table>

                        <div class="price-block">
                            <table class="table">
                                <tbody>
                                <tr>
                                    <td><strong>Стоимость проекта</strong></td>
                                    <td><div class="price">{{ project.price }}</div></td>
                                </tr>
                                <tr>
                                    <td><strong>Стоимость строительства</strong></td>
                                    <td><div class="price">{{ project.price }}</div></td>
                                </tr>
                                <tr>
                                    <td><strong>Стоимость измененого проекта</strong></td>
                                    <td><div class="price">{{ changedPrice }}</div></td>
                                </tr>
                                </tbody>
                            </table>
                        </div>
                        <div v-if="!canEdit && !saveFile" class="alert alert-info" >
                            Этот проект не сохранится так как превышен лимит одновременных проектов
                        </div>
                        <div class="alert alert-danger" v-if="notAllChange">
                            Вы не выбрали все параметры
                        </div>
                        <div class="btn-block">
                            <button type="submit" class="btn yellow-btn" :disabled="buyDisabled">Купить проект</button>
                            <button v-if="this.isAuthenticated && (this.canEdit || this.saveFile)" type="button"  data-toggle="modal" data-target="#editorModal" class="btn yellow-outline-btn">Редактирование</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <Recommend :recommendations='recommendations'/>
    </div>
</template>

<script>
import Recommend from './RecommendationsComponent'
import VueSlickCarousel from 'vue-slick-carousel'
import 'vue-slick-carousel/dist/vue-slick-carousel.css'
import 'vue-slick-carousel/dist/vue-slick-carousel-theme.css'

export default {
    name: "ProjectComponent",
    data:() => ({
        toggleFavoritesUrl: '',
        favoritesClass: '',
        btnDisabled: false,
        linkForBuy: '',
        savedAttributes: {},
        buyDisabled: false,
        notAllChange: false,
        cells: {},
        changedCell: {},
        changedCells: {},
        groups: [],
        changedGroup: '',
        chengedPrice: '',
        values_data: {},
        hasEdits: false
    }),
    props: [
        'project',
        'createdAt',
        'buyLink',
        'recommendations',
        'purchaseAttributes',
        'isAuthenticated',
        'canEdit',
        'saveLink',
        'saveFile',
        'jsonUrl',
        'calculateRoute',
        'saveEditorDataLink'
    ],
    created() {
        this.csrfToken = document.querySelector('meta[name="csrf-token"]').content
    },
    mounted() {
        this.$nextTick(this.$forceUpdate);
        if(this.saveFile){
            this.savedAttributes = this.saveFile.values_data
        }
        axios.get(this.calculateRoute, this.values_data).then(response => {
            if(response.status === 200){
                this.changedPrice = response.data
            }
        }).catch(error => {
            console.log(error);
        })
        axios.get(this.jsonUrl).then(response => {
            if(response.status === 200) {
                this.cells = response.data.cells
                this.getGroups()

                const defaults = {}
                for (const name in response.data.cells) {
                    // Конвертирую в изначальный тип. Не знаю почему, но работает
                    defaults[name] = (response.data.cells[name].def.constructor)(response.data.cells[name].def)
                }

                this.values_data = defaults

                setTimeout(this.sendJson, 5000)
            }
        }).catch(error => {
            console.log(error);
        })

        axios.get(this.project.file_url).then(response => {
            if(response.status === 200){
                this.values_data = response.data
            }
        }).catch(error => {
            console.log(error);
        })
    },
    components: {
        VueSlickCarousel ,
        Recommend
    },
    methods: {
        toggleFavorites() {
            this.btnDisabled = true
            if(!this.project.isInFavorites){
                this.toggleFavoritesUrl = this.project.addToFavoritesLink
            }else{
                this.toggleFavoritesUrl = this.project.removeFromFavoritesLink
            }
            this.project.isInFavorites = !this.project.isInFavorites
            axios.post(this.toggleFavoritesUrl , {'_token' : this.csrfToken}).then(response => {
                if(response.status === 204){
                    this.$nextTick(this.$forceUpdate);
                    this.favoritesClass = 'animated'
                    setTimeout(() => {this.favoritesClass = ''}, 200)
                    this.btnDisabled = false
                }
            }).catch(error => {
                this.btnDisabled = false
                console.log(error);
            })
        },
        onSubmit() {
            if(this.isAuthenticated){
                    this.buyDisabled = true
                    this.notAllChange = false
                    if(confirm("Купить проект на сумму " + this.project.price + " рублей?")){
                        axios.post(this.buyLink , {'_token' : this.csrfToken, 'purchase_attributes' : this.savedAttributes} ).then(response => {
                            if(response.status === 204){
                                this.buyDisabled = false;
                                alert('Вы успешно купили проект')
                            }
                        }).catch(error => {
                            this.buyDisabled = false
                            console.log(error);
                        })
                    }else{
                        this.buyDisabled = false
                    }
            }else{
                window.location.href = '/register'
            }
        },
        saveProject() {
            if(this.isAuthenticated && (this.canEdit || this.saveFile)){
                this.buyDisabled = true;
                axios.post(this.saveLink , {'_token' : this.csrfToken, 'purchase_attributes' : this.savedAttributes} ).then(response => {
                    if(response.status === 200){
                        this.buyDisabled = false;
                        this.changedPrice = response.data.order_price
                    }
                }).catch(error => {
                    this.buyDisabled = false;
                    console.log(error);
                })
            }
        },
        sendJson() {
            if(confirm("Сохранить изменения?")){
                if(this.isAuthenticated && (this.canEdit || this.saveFile)) {

                    axios.post(this.saveEditorDataLink, {"building_width": this.values_data.building_width}).then(response => {
                        this.changedPrice = response.data.order_price
                        console.log("Прилетевшие данные:", response.data)
                    }).catch(error => {
                        console.log(error);
                    })
                }
            }
        },
        cancelEdit(){
            if(confirm("Сбросить изменения?")){
                axios.get(this.project.file_url).then(response => {
                if(response.status === 200){
                    this.values_data = response.data
                }
                }).catch(error => {
                    console.log(error);
                })
            }
        },
        changeCell(id) {
            for(let cell in this.cells){
                if(this.cells[cell].id == id){
                    this.changedCell = this.cells[cell]
                }
            }
        },
        getGroups(){
            for (let cell in this.cells){
                if(this.cells[cell].group && !this.groups.includes(this.cells[cell].group)){
                    this.groups.push(this.cells[cell].group)
                }
            }
        },
        changeGroup(group) {
            this.changedCells = []
            this.changedGroup = group
            for (let cell in this.cells){
                if(this.cells[cell].group == group){
                    this.changedCells.push(this.cells[cell])
                }
            }

        },
        getValue(id){
            for(let key in this.values_data){
                if(this.cells[key].id == id){
                    return this.values_data[key]
                }
            }
        },
        saveValue(id, value){
            for(let key in this.values_data){
                if(this.cells[key].id == id){
                    this.values_data[key] = parseInt(value)
                    this.hasEdits || (this.hasEdits = true)
                }
            }
        }
    }
}

</script>
