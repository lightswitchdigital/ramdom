<template>
    <div class="login-block">
        <form v-if="!isVerified" class="mx-auto" @submit.prevent='onSubmit'>
            <h1 class="title">Вход в личный кабинет</h1>
            <div v-if="message" class="alert alert-danger" role="alert">
                {{ message }}
            </div>
            <div class="form-group">
                <input type="text" id="login"
                       v-model.trim="email"
                       :class="{'is-invalid': ($v.email.$dirty && !$v.email.required) || ($v.email.$dirty && !$v.email.email) || errors.email}"
                       class="form-control"
                       placeholder="E-mail *">
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
                <a href="/password/reset" class="forgot-link">Забыли пароль?</a>
            </div>
            <div class="btn-block">
                <button class="btn yellow-btn" :class='{active: isDisabled}' type="submit" :disabled='isDisabled'>
                    <span class="text-succes">Вы успешно вошли</span>
                    <span class="not-disabled">Войти</span>
                </button>
            </div>
            <a href="/register" class="register-link">Регистрация</a>
        </form>
        <form v-else class="mx-auto" @submit.prevent='onVerify'>
            <h1 class="title">Введите код подтверждения</h1>
            <div v-if="message" class="alert alert-danger" role="alert">
                {{ message }}
            </div>
            <div class="form-group">
                <input id="verify" v-model.trim="verify"
                       :class="{'is-invalid': ($v.verify.$dirty && !$v.verify.required) || errors.token}"
                       class="form-control"
                       placeholder="Код из письма *"
                       type="text">
                <small v-if="$v.verify.$dirty && !$v.verify.required" class="error-text">
                    введите код</small>
                <small v-for="(item , index) in errors.token" :key="index" :v-if="errors.token"
                       class="error-text">{{ item }}</small>
            </div>
            <div class="btn-block">
                <button :class='{active: isDisabled}' :disabled='isDisabled' class="btn yellow-btn" type="submit">
                    <span class="text-succes">Вы успешно вошли</span>
                    <span class="not-disabled">Подтвердить</span>
                </button>
            </div>
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
        verify: '',
        errors: '',
        message: '',
        isDisabled: false,
        isVerified: false,
        nextRoute: ''
    }),
    created() {
        this.csrfToken = document.querySelector('meta[name="csrf-token"]').content
    },
    validations: {
        email: {required, email},
        password: {required, minLength: minLength(8)},
        verify: {required},
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

            axios.post('/login', formData).then(response => {
                if (response.data.success) {
                    this.message = ''
                    this.errors = ''
                    this.isVerified = true
                    this.nextRoute = response.data.nextRoute
                } else {
                    this.message = response.data.message
                }
            }).catch(error => {
                this.message = error.message
                this.errors = error.response.data.errors || ''
            })
        },
        async onVerify() {
            if (this.$v.$invalid) {
                this.$v.$touch()
            }
            const formData = {
                token: this.verify,
                _token: this.csrfToken
            }

            axios.post(this.nextRoute, formData).then(response => {
                if (response.data.success) {
                    this.errors = ''
                    this.message = ''
                    this.isDisabled = true
                    setTimeout(() => {
                        window.location.href = '/profile'
                    }, 1000)
                } else {
                    this.message = response.data.message
                }
            }).catch(error => {
                this.message = error.message
                this.errors = error.response.data.errors || ''
            })
        },
    }

}
</script>
