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
                        <div class="preview-slide" v-for="image in images">
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
                        <div class="mini-preview" v-for="image in images">
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
                    <div v-if="isAuthenticated" class="like-block" :class="{active : project.isInFavorites}" @click.prevent="liked">
                        <span v-if="!project.isInFavorites">Добавить в избранное</span>
                        <span v-else>В избранном</span>
                        <span class="like"><i class="fas fa-heart"></i></span>
                    </div>

                    <table class="table">
                        <tbody>
                        <tr v-for="(value, label) in values">
                            <td>{{ label }}</td>
                            <td>{{ value }}</td>
                        </tr>
                        </tbody>
                    </table>
                    <div class="price-block">
                        <table class="table">
                            <tbody>
                                <tr>
                                    <td><strong>Стоимость строительства</strong></td>
                                    <td><div class="price">{{project.price}}</div></td>
                                </tr>
                                <tr>
                                    <td><strong>Стоимость проекта</strong></td>
                                    <td><div class="price">{{project.price}}</div></td>
                                </tr>
                            </tbody>
                        </table>  
                    </div>
                    <div class="btn-block">
                        <a href="#" class="yellow-outline-btn">Купить проект</a>
                        <a href="#" class="yellow-btn">Купить строительство</a>
                    </div>
<!--                    <h3>Заказать проект</h3>-->
<!--                    <form :action="this.createOrderLink" method="post">-->
<!--                        <div class="form-group" v-for="attribute in this.orderAttributes">-->
<!--                            <label :for="'order_attribute_'+attribute.id" class="col-form-label">{{ attribute.name }}</label>-->

<!--                            <select v-if="attribute.variants.length > 0" :id="'order_attribute_'+attribute.id" class="form-control" :name="'order_attributes['+attribute.id+']'">-->
<!--                                <option v-if="attribute.required" value=""></option>-->

<!--                                <option v-for="variant in attribute.variants" :value="variant">-->
<!--                                    {{ variant }}-->
<!--                                </option>-->
<!--                            </select>-->

<!--                            <input v-else-if="attribute.type === 'number'" :id="'order_attribute_'+attribute.id" type="number" class="form-control" :name="'order_attributes['+attribute.id+']'">-->

<!--                            <input v-else :id="'order_attribute_'+attribute.id" type="text" class="form-control" :name="'order_attributes['+attribute.id+']'">-->
<!--                        </div>-->
<!--                    </form>-->
                </div>
            </div>
        </div>
        <Recommend />
    </div>
</template>

<script>
import 'vue-slick-carousel/dist/vue-slick-carousel.css'
import 'vue-slick-carousel/dist/vue-slick-carousel-theme.css'

export default {
    name: "ProjectComponent",
    data:() => ({
        // values: {
        //     'Общая площадь': '140 кв.м',
        //     'Площадь застройки': '200 м2',
        //     'Кубатура': '1170 м2',
        //     'Высота': '7.06 м',
        //     'Угол наклона кровли': '30',
        //     'Площадь крыши': '267 м2',
        //     'Рекомендованные минимальные размеры участка': 'ширина 23.71 м длина 22.01 м',
        //     'Материал': 'кирпич',
        //     'Фундамент': 'ленточный',
        //     'Внешняя отделка': 'кирпич облицовочный',
        //     'Пол 1 этажа': 'монолит, бетон, 150 мм 1 слой',
        //     'Покрытие': 'плита ЖБИ',
        //     'Материал кровли': 'металлочерепица',
        //     'Утеплитель кровли': 'доска сухая 150 мм',
        //     'Материал стропил': 'пенопласт',
        // },
        favoritesUrl: '',
    }),
    props: [
        'project',
        'images',
        'createdAt',
        'values',
        'createOrderLink',
        'orderAttributes',
        'favoritesAddLink',
        'favoritesRemoveLink',
        'isAuthenticated'
    ],
    created() {
        this.csrfToken = document.querySelector('meta[name="csrf-token"]').content
        console.log(this.orderAttributes)
    }, 
    mounted() {
        this.$nextTick(this.$forceUpdate);
    },
    components: {
         'VueSlickCarousel': () => import('vue-slick-carousel') , 
         'Recommend': () => import('../common/RecommendComponent') 
    },
    methods: {
        liked() {
            if(this.isInFavorites){
                this.favoritesUrl = this.favoritesAddLink
            }else{
                this.favoritesUrl = this.favoritesRemoveLink
            }
            axios.post(`/${this.favoritesUrl}` , this.csrfToken).then(response => {
                if(response.status === 204){
                    console.log('is ok');
                }
            }).catch(error => {
                console.log(error);
            })
        }
    }
}

</script>
