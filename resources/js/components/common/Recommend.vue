<template>
    <div class="recommend-block">
        <h3 class="title">Похожие проекты</h3>
        <VueSlickCarousel 
        ref="recommend" 
        v-bind="settings">
        <ProjectCardComponent 
        v-for="project in projects"
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
import ProjectCardComponent from '../Projects/ProjectCardComponent'
import VueSlickCarousel from 'vue-slick-carousel'
import 'vue-slick-carousel/dist/vue-slick-carousel.css'
import 'vue-slick-carousel/dist/vue-slick-carousel-theme.css'

export default {
    data:() => ({
        projects: [
            {title: 'Project 1' , price: '1000000'},
            {title: 'Project 2' , price: '1200000'},
            {title: 'Project 3' , price: '1300000'},
            {title: 'Project 4' , price: '1100000'},
            {title: 'Project 5' , price: '1200000'},
            {title: 'Project 6' , price: '1300000'},
            {title: 'Project 7' , price: '1400000'},
            {title: 'Project 8' , price: '1000000'},
            {title: 'Project 9' , price: '1500000'},
            {title: 'Project 10' , price: '1300000'}
        ],
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
    components: { ProjectCardComponent , VueSlickCarousel }
}
</script>