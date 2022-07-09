<template>
    <div class="modal fade detail-modal-block" :id="'project-details-'+project.id" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Подробный просмотр</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <h2 class="project-title">{{ project.project.title }}</h2>
                        <div class="preview">
                            <VueSlickCarousel
                                ref="preview"
                                :asNavFor="$refs.miniPreview"
                                :focusOnSelect="true"
                                :fade="true"
                                :arrow="false">
                                <div class="preview-slide" v-for="(image , index) in project.project.jsonImages" :key="index">
                                    <img :src="image" :alt="project.project.title">
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
                                <div class="mini-preview" v-for="(image , index) in project.project.jsonImages" :key="index">
                                    <img :src="image" :alt="project.project.title">
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
                        <div class="card info-card">
                            <table class="table">
                                <tbody>
                                    <tr v-for="(value, label , index) in project.jsonValues" :key="index">
                                        <td>{{ label }}</td>
                                        <td>{{ value }}</td>
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
                        </div>
                    </div>
                </div>
            </div>
        </div>
</template>

<script>
import VueSlickCarousel from 'vue-slick-carousel'
import 'vue-slick-carousel/dist/vue-slick-carousel.css'
import 'vue-slick-carousel/dist/vue-slick-carousel-theme.css'

export default {
    name: "PurchasedProjectDetails",
    props: [
        'project'
    ],
    mounted() {
        this.$nextTick(this.$forceUpdate)
    },
    components: {
        VueSlickCarousel 
    }
}
</script>r