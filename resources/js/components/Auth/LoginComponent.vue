<template>
    <div class="login-block">
        <form class="mx-auto" @submit.prevent='onSubmit'>
            <h1 class="title">Вход в личный кабинет</h1>
            <div v-if="message != ''" class="alert alert-danger" role="alert">
                {{message}}
            </div>
            <div class="form-group">
                <input type="text" id="login"
                    v-model.trim="email"
                    class="form-control"
                    placeholder="E-mail *"
                    :class="{'is-invalid': ($v.email.$dirty && !$v.email.required) || ($v.email.$dirty && !$v.email.email) || errors.email}">
                <small class="error-text" v-if="$v.email.$dirty && !$v.email.required">
                    введите email</small>
                <small class="error-text" v-else-if="$v.email.$dirty && !$v.email.email">
                    email не коректен</small>
                <small class="error-text" :v-if="errors.email" v-for="(item , index) in errors.email" :key="index">{{ item }}</small>
            </div>
            <div class="form-group">
                <input type="password" id="password"
                        v-model.trim="password"
                        class="form-control"
                        placeholder="Пароль *"
                        :class="{'is-invalid': ($v.password.$dirty && !$v.password.required) || ($v.password.$dirty && !$v.password.minLength) || errors.password}">
                <small class="error-text" v-if="$v.password.$dirty && !$v.password.required">
                    введите пароль</small>
                <small class="error-text" v-else-if="$v.password.$dirty && !$v.password.minLength">
                    пароль не должен быть короче {{$v.password.$params.minLength.min}} символов</small>
                <small class="error-text" :v-if="errors.password" v-for="(item , index) in errors.password" :key="index">{{ item }}</small>
            </div>
            <div class="forgot-block">
                <span></span>
                <a href="#" class="forgot-link">Забыли пароль?</a>
            </div>
            
            <button class="btn yellow-btn" type="submit" :disabled='isDisabled'>Войти</button>
            <p v-if="isDisabled">Вы успешно вошли</p>
            <a href="#" class="register-link">Регистрация</a>
        </form>
    </div>
</template>

<script>
import {required , email , minLength} from 'vuelidate/lib/validators'

export default {
    name: 'login',
    data: () => ({
        email: '',
        password: '',
        errors: '',
        message: '',
        isDisabled: false // Сообщение об ошибке
    }),
    created() {
        this.csrfToken = document.querySelector('meta[name="csrf-token"]').content
    },
    validations: {
        email: {required , email},
        password: {required , minLength: minLength(8)}
    },
    methods: {
        async onSubmit() {
            if(this.$v.$invalid){
                this.$v.$touch()

            }
            const formData = {
                email: this.email,
                password: this.password,
                _token: this.csrfToken
            }

            axios.post('/login' , formData).then(response => {
                if(response.status === 204){
                   this.isDisabled = true 
                    setTimeout(() => {
                        window.location.href = '/'
                    } , 2000)
                }
            }).catch(error => {
                this.message = error.response.data.message
                this.errors = error.response.data.errors
            })
        }
    }

}
</script>
