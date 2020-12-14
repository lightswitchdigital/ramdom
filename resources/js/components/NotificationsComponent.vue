<template>
    <div>
        <a id="navbarDropdownMessage"
            class="nav-link dropdown-toggle messages-btn"
            :class="{active: messages.length !== 0}"
            href="#" role="button"
            data-toggle="dropdown"
            aria-haspopup="true"
            aria-expanded="false">
            <i class="fas fa-bell"></i>
        </a>
        <div class="dropdown-menu dropdown-menu-right messages-block"
            aria-labelledby="navbarDropdownMessage">
            <a href="#" class="dropdown-item message-block"
            v-for="(message , index) in messages" :key="index">
                <h5 class="title">{{ message.title }}</h5>
                {{ message.content }}
                <span class="date text-muted">{{ message.date }}</span>
            </a>
            <div class="dropdown-item" v-if="messages.length === 0">Пока сообщений нет</div>
            <scroll-loader
            :loader-method="getMessages"
            :loader-disable="disable">
                <div>Loading...</div>
            </scroll-loader>
        </div>
    </div>

</template>

<script>
import Vue from 'vue'
import ScrollLoader from 'vue-scroll-loader'

Vue.use(ScrollLoader)

export default {
    data: () => ({
        messages: [],
        loadMore: true,
        batch: 0,
        pageSize: 10,
        disable: false
    }),
    methods: {
        getMessages() {
            axios.get(`/notifications?batch=${++this.batch}`).then(res => {
                this.messages = [...this.messages, ...res.data]
                console.log(this.messages)
                res.data.length < this.pageSize && (this.loadMore = false)
                this.disable = res.data.length < this.pageSize
            })
            .catch(error => {
                console.log(error);
                this.disable = false
            })
        }
    },
    mounted() {
        this.getMessages()
    }
}
</script>
