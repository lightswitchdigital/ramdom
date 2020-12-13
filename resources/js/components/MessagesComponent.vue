<template>
    <div class="dropdown-menu dropdown-menu-right messages-block" 
         aria-labelledby="navbarDropdownMessage">
        <a href="#" class="dropdown-item message-block"
        v-for="(message , index) in messages" :key="index">
            <h5 class="title">{{ message.title }}</h5>
            {{ message.message }}
            <span class="date text-muted">{{ message.date }}</span>
        </a>
    </div>
</template>

<script>
export default {
    data: () => ({
        messages: [
            {title: 'Сообщение 1' , message: 'Вы вошли в аккаунт' , date: '2020:20:08'}, 
            {title: 'Сообщение 2' , message: 'Вы вошли в аккаунт' , date: '2020:23:08'}, 
            {title: 'Сообщение 2' , message: 'Вы вошли в аккаунт' , date: '2020:23:08'}, 
            {title: 'Сообщение 2' , message: 'Вы вошли в аккаунт' , date: '2020:23:08'}
        ],
    })
}
</script>