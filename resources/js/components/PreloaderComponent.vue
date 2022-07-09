<template>
    <div class="preloader">
        <div id="boxes">
            <div class="box"></div>
            <div class="box"></div>
            <div class="box"></div>
            <div class="box"></div>
        </div>
    </div>
</template>

<script>
import anime from "animejs";

export default {
    name: "PreloaderComponent",
    mounted() {
        const playPause = anime({
            targets: '.box',
            translateY: [
                {value: 100, duration: 400},
                {value:0, duration: 400}
            ],
            rotate: {
                value: '1turn',
            },
            borderRadius: [
                {value: 50, duration: 400},
                {value: 0, duration: 400}
            ],
            direction: 'normal',
            easing: 'easeInOutQuad',
            delay: anime.stagger(100),
            autoplay: true,
            loop: true,
            elasticity: 200

        });
        playPause.play();
    }
}
</script>

<style scoped>
    .preloader {
        display: block;
        margin: 100px auto;
        width: 110px;
        height: auto;
    }
    .box {
        position: relative;
        width: 15px;
        height: 15px;
        margin: 4px;
        display: inline-block;
        background-color: #FFD977;
    }
</style>
