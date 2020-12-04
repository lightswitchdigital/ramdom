<template>
    <div class="container project-view">
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
                    <div v-if="isAuthenticated" class="like-block" :class="[{active : project.isInFavorites} , favoritesClass]" @click.prevent="toggleFavorites">
                        <span v-if="!project.isInFavorites">Добавить в избранное</span>
                        <span v-else>В избранном</span>
                        <span class="like"><i class="fas fa-heart"></i></span>
                    </div>
                    <form :action="this.createOrderLink" method="post">
                        <table class="table">
                            <tbody>
                                <tr v-for="(value, label , index) in project.jsonValues" :key="index">
                                    <td>{{ label }}</td>
                                    <td>{{ value }}</td>
                                </tr>
                                <tr v-for="(attribute , index) in this.orderAttributes" :key="index">
                                    <td>
                                        <label :for="'order_attribute_'+attribute.id" class="col-form-label">{{ attribute.name }}</label>
                                    </td>
                                    <td>
                                        <select v-if="attribute.variants.length > 0" :id="'order_attribute_'+attribute.id" class="custom-select" :name="'order_attributes['+attribute.id+']'">
                                            <option v-for="(variant , index) in attribute.variants" :value="variant" :key="index">
                                                {{ variant }}
                                            </option>
                                        </select>

                                        <input v-else-if="attribute.type === 'number'" :id="'order_attribute_'+attribute.id" type="number" class="form-control" :name="'order_attributes['+attribute.id+']'">

                                        <input v-else :id="'order_attribute_'+attribute.id" type="text" class="form-control" :name="'order_attributes['+attribute.id+']'">
                                    </td>
                                </tr>  
                            </tbody>
                            
                        </table>
                    </form>
                    <!-- <table class="table">
                        <tbody>
                        
                        </tbody>
                    </table> -->
                    <div class="price-block">
                        <table class="table">
                            <tbody>
                                <tr>
                                    <td><strong>Стоимость строительства</strong></td>
                                    <td><div class="price">{{ project.price }}</div></td>
                                </tr>
                                <tr>
                                    <td><strong>Стоимость проекта</strong></td>
                                    <td><div class="price">{{ project.price }}</div></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    <div class="btn-block">
                        <a href="#" class="yellow-outline-btn">Купить проект</a>
                        <a href="#" class="yellow-btn">Купить строительство</a>
                    </div>
                </div>
            </div>
        </div>
        <!-- <form class="row agree-form mt-4" v-if="editMode">
            <div class="col-md">
                <div class="switch-block">
                    <input type="checkbox" name="entity" id="entity">
                    <label for="entity" class="switch"></label>
                    <label for="entity"><h5>Оформить как юр.лицо</h5></label>
                </div>
                
                <input type="text" name="fullName" placeholder="ФИО">
                <div>
                    <div class="passport-block">
                        <h4>Паспортные данные</h4>
                        <div class="row">
                            <div class="col">
                                <input type="text" name="passportSireas" placeholder="Серия">
                            </div>
                            <div class="col">
                                <input type="text" name="passportNumber" placeholder="Номер">
                            </div>
                        </div>
                    </div>
                    
                    <input type="text" name="" placeholder="Кем выдан">
                    <input type="text" name="" placeholder="Когда выдан">
                </div>
            </div>
            <div class="col-md">
                <h4>Контактная информация</h4>
                <input type="text" name="phone" v-model.trim="phone" placeholder="Телефон">
                <input type="text" name="email" v-model.trim="eamil" placeholder="E-mail">
                <input type="text" name="place" placeholder="Населённый пункт">
                <input type="text" name="street" placeholder="Улица">
                <div class="row">
                        <div class="col">
                            <input type="text" placeholder="Дом">
                        </div>
                        <div class="col">
                            <input type="text" placeholder="Квартира">
                        </div>
                </div>
                <input type="text" name="street" placeholder="Почтовый индекс">
                <button type="submit" class="btn yellow-btn">Оплатить проект</button>
            </div>
        </form> -->
        <Recommend :recommendations='recommendations'/>
    </div>
</template>

<script>
import VueSlickCarousel from 'vue-slick-carousel'
import Recommend from './RecommendationsComponent'
import 'vue-slick-carousel/dist/vue-slick-carousel.css'
import 'vue-slick-carousel/dist/vue-slick-carousel-theme.css'

export default {
    name: "ProjectComponent",
    data:() => ({
        toggleFavoritesUrl: '',
        favoritesClass: '',
    }),
    props: [
        'project',
        'createdAt',
        'createOrderLink',
        'recommendations',
        'orderAttributes',
        'isAuthenticated'
    ],
    created() {
        this.csrfToken = document.querySelector('meta[name="csrf-token"]').content
        console.log(this.project.isInFavorites)
    },
    mounted() {
        this.$nextTick(this.$forceUpdate);
    },
    components: {
        VueSlickCarousel ,
        Recommend
    },
    methods: {
        toggleFavorites() {
            if(!this.project.isInFavorites){
                this.toggleFavoritesUrl = this.project.addToFavoritesLink
            }else{
                this.toggleFavoritesUrl = this.project.removeFromFavoritesLink
            }
            this.project.isInFavorites = !this.project.isInFavorites
            axios.post(this.toggleFavoritesUrl , {'_token' : this.csrfToken}).then(response => {
                if(response.status === 204){
                    console.log(this.project.isInFavorites + ' favorites');
                    this.$nextTick(this.$forceUpdate);
                    this.favoritesClass = 'animated'
                    setTimeout(() => {this.favoritesClass = ''}, 200)
                }
            }).catch(error => {
                console.log(error);
            })
        }
    }
}

</script>
