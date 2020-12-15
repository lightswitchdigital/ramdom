<template>
    <div>
        <a id="navbarDropdownMessage"
            href="#"
            class="nav-link dropdown-toggle messages-btn"
            role="button"
            :class="{active: messages.some(message => !message.seen)}"
            data-toggle="dropdown"
            aria-haspopup="true"
            aria-expanded="false">
            <i class="fas fa-bell"></i>
        </a>
        <div class="dropdown-menu dropdown-menu-right messages-block"
            aria-labelledby="navbarDropdownMessage"
            @click.prevent="e => e.stopPropagation()"
            @mousewheel.prevent="e => stopScrolling(e)">
            <div class="dropdown-title">
                Уведомления
            </div>
            <div
            class="dropdown-item message-block"
            :class='{seen: message.seen}'
            v-for="(message , index) in messages" :key="index"
            @click.prevent="postSeen(message.id)">
                <div class="icon">
                    <img src="https://icons.iconarchive.com/icons/webalys/kameleon.pics/512/Man-16-icon.png" alt="">
                </div>
                <div class="content">
                    <h6 class="title">{{ message.title }}</h6>
                    {{ message.content }}    
                </div>
                <span class="date text-muted"></span>
                <!-- <button class="seen-btn" 
                        :disabled="message.seen"
                >
                    <i class="fas fa-eye"></i>
                </button> -->
            </div>
            <div class="dropdown-item" v-if="messages.length === 0">Пока сообщений нет</div>
            <scroll-loader
            :loader-method="getMessages"
            :loader-disable="disable">
                <div class="spinner-border text-dark" role="status">
                    <span class="sr-only">Loading...</span>
                </div>
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
    created() {
        this.csrfToken = document.querySelector('meta[name="csrf-token"]').content
    },
    methods: {
        getMessages() {
            axios.get(`/notifications/get?batch=${++this.batch}`).then(res => {
                this.messages = [...this.messages, ...res.data]
                res.data.length < this.pageSize && (this.loadMore = false)
                this.disable = res.data.length < this.pageSize
                console.log(this.messages);
            })
            .catch(error => {
                console.log(error)
            })
        },
        postSeen(id) {
            axios.post(`/notifications/${id}/see` , {'_token' : this.csrfToken}).then(response => {
                if(response.status === 200){
                    console.log('seen is ok');
                    this.messages[id - 1] = response.data
                    this.$nextTick(this.$forceUpdate)
                }
            }).catch(error => {
                console.log(error);
            })
        },
        stopScrolling(e) {
            e.currentTarget.scrollTop += ((e.wheelDelta || e.detail) < 0 ? 1 : -1 ) * 15
        }
    },
    mounted() {
        this.getMessages()
    }
}
</script>
