<template>
        <div class="container project-view">
            <div class="modal fade" id="editorModal" tabindex="-1" aria-labelledby="editorModalLabel" aria-hidden="true">
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
                        <input type="text" class="search" placeholder="Название атрибута">
                        <div class="row">
                            <div class="col">
                                <ul>
                                    <li><a href="#"><span>Крыша</span><i class="fas fa-chevron-right"></i></a></li>
                                    <li><a href="#"><span>Стены</span><i class="fas fa-chevron-right"></i></a></li>
                                    <li><a href="#"><span>Потолок</span><i class="fas fa-chevron-right"></i></a></li>
                                </ul>
                            </div>
                            <div class="col">
                                <ul v-if="changeList == '1_list'">
                                    <li><a href="#"><span>Крыша</span><i class="fas fa-chevron-right"></i></a></li>
                                    <li><a href="#"><span>Стены</span><i class="fas fa-chevron-right"></i></a></li>
                                </ul>
                                <ul v-else-if="changeList == '2_list'">
                                    <li><a href="#"><span>Крыша</span><i class="fas fa-chevron-right"></i></a></li>
                                    <li><a href="#"><span>Стены</span><i class="fas fa-chevron-right"></i></a></li>
                                </ul>
                                <ul v-else-if="changeList == '3_list'">
                                    <li><a href="#"><span>Крыша</span><i class="fas fa-chevron-right"></i></a></li>
                                    <li><a href="#"><span>Стены</span><i class="fas fa-chevron-right"></i></a></li>
                                </ul>
                            </div>
                            <div class="col">
                                <input type="text" class="editor__input" placeholder="Название атрибута 1" v-if="inputId == 1">
                                <input type="text" class="editor__input" placeholder="Название атрибута 2" v-else-if="inputId == 2">
                                <input type="text" class="editor__input" placeholder="Название атрибута 3" v-else-if="inputId == 3">
                                <input type="text" class="editor__input" placeholder="Название атрибута 4" v-else-if="inputId == 4">
                                <input type="text" class="editor__input" placeholder="Название атрибута 5" v-else-if="inputId == 5">
                                <input type="text" class="editor__input" placeholder="Название атрибута 6" v-else-if="inputId == 6">
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn yellow-outline-btn" data-dismiss="modal">Сбросить</button>
                        <button type="button" class="btn yellow-btn">Сохранить изменения</button>
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
                            <button type="button"  data-toggle="modal" data-target="#editorModal" class="btn yellow-outline-btn">Тест</button>
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
        changeList: '1_list',
        inputId: 1
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
        'saveFile'
    ],
    created() {
        this.csrfToken = document.querySelector('meta[name="csrf-token"]').content
    },
    mounted() {
        this.$nextTick(this.$forceUpdate);
        if(this.saveFile){
            this.savedAttributes = this.saveFile.values_data
        }
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
                window.location.href = '/register'
            }
        },
        saveProject() {
            if(this.isAuthenticated && (this.canEdit || this.saveFile)){
                this.buyDisabled = true;
                axios.post(this.saveLink , {'_token' : this.csrfToken, 'purchase_attributes' : this.savedAttributes} ).then(response => {
                    if(response.status === 200){
                        this.buyDisabled = false;
                        console.log('save is ok');
                    }
                }).catch(error => {
                    this.buyDisabled = false;
                    console.log(error);
                })
            }
        },
    }
}

</script>
