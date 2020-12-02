<template>
    <div class="recommend-block">
        <h3 class="title">Вам может понравиться</h3>
        <VueSlickCarousel
        ref="recommend"
        v-bind="settings">
        <ProjectCardComponent
        v-for="project in this.recommendations"
        :key="project.id"
        :project="project"
        :projectLink="'#'"
        :projectValues="[]"/>
            <template #prevArrow>
                <div class="btn-prev">
                    <i class="fas fa-chevron-left"></i>
                </div>
            </template>
            <template #nextArrow>
                <div class="btn-next">
                    <i class="fas fa-chevron-right"></i>
                </div>
            </template>
        </VueSlickCarousel>
    </div>
</template>

<script>
import ProjectCardComponent from './ProjectCardComponent'
import VueSlickCarousel from 'vue-slick-carousel'
import 'vue-slick-carousel/dist/vue-slick-carousel.css'
import 'vue-slick-carousel/dist/vue-slick-carousel-theme.css'

export default {
    data:() => ({
        settings: {
            "infinite" : true,
            "slidesToShow": 4,
            "slidesToScroll": 1,
            "responsive": [
                {
                "breakpoint": 1024,
                "settings": {
                    "slidesToShow": 3,
                    "infinite": true
                }
                },
                {
                "breakpoint": 600,
                "settings": {
                    "slidesToShow": 2
                }
                },
                {
                "breakpoint": 480,
                "settings": {
                    "slidesToShow": 1
                }
                }
            ]
        }
    }),
    props: [
        'recommendations'
    ],
    components: { ProjectCardComponent , VueSlickCarousel }
}
</script>
