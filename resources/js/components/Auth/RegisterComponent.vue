<template>
    <div class="container">
        <form class="mx-auto" @submit.prevent='onSubmit'>
            <div class="form-group">
                <label for="name">Имя</label>
                <input type="text" id="name"
                    v-model.trim="name"
                    class="form-control"
                    :class="{invalid: $v.name.$dirty && !$v.name.required}">
                <small class="error-text" v-if="$v.name.$dirty && !$v.name.required">
                    введите имя</small>
            </div>
            <div class="form-group">
                <label for="login">Эл. почта</label>
                <input type="text" id="login"
                    v-model.trim="email"
                    class="form-control"
                    :class="{invalid: ($v.email.$dirty && !$v.email.required) || ($v.email.$dirty && !$v.email.email)}">
                <small class="error-text" v-if="$v.email.$dirty && !$v.email.required">
                    введите email</small>
                <small class="error-text" v-else-if="$v.email.$dirty && !$v.email.email">
                    email не коректен</small>
            </div>
            <div class="form-group">
                <label for="password">Пароль</label>
                <input type="password" id="password"
                        v-model.trim="password"
                        class="form-control"
                        :class="{invalid: ($v.password.$dirty && !$v.password.required) || ($v.password.$dirty && !$v.password.minLength)}">
                <small class="error-text" v-if="$v.password.$dirty && !$v.password.required">
                    введите пароль</small>
                <small class="error-text" v-else-if="$v.password.$dirty && !$v.password.minLength">
                    пароль не должен быть короче {{$v.password.$params.minLength.min}} символов</small>    
            </div>
            <div class="form-group">
                <label for="confPassword">Подтвердить пароль</label>
                <input type="password" id="confPassword"
                        v-model.trim="password_confirmation"
                        class="form-control"
                        :class="{invalid: ($v.password_confirmation.$dirty && !$v.password_confirmation.required) || ($v.password_confirmation.$dirty && !$v.password_confirmation.minLength)}">
                <small class="error-text" v-if="$v.password_confirmation.$dirty && !$v.password_confirmation.required">
                    введите пароль</small>
                <small class="error-text" v-else-if="$v.password_confirmation.$dirty && !$v.password_confirmation.minLength">
                    пароль не должен быть короче {{$v.password_confirmation.$params.minLength.min}} символов</small>    
            </div>
            
            <button class="btn btn-primary" type="submit">Войти</button>
        </form>
    <div>
    </div>
</template>

<style>
    form{
        max-width: 400px;
    }
    .invalid{
        border-color: red;
        outline-color: tomato;
    }
    .error-text{
        color: red;
    }
</style>

<script>
import {required , email , minLength} from 'vuelidate/lib/validators'

export default {
    name: 'register',
    data: () => ({
        name: '',
        email: '',
        password: '',
        password_confirmation: ''
    }),
    created() {
        this.csrfToken = document.querySelector('meta[name="csrf-token"]').content
    },
    validations: {
        name: {required},
        email: {required , email},
        password: {required , minLength: minLength(8)},
        password_confirmation: {required , minLength: minLength(8)}
    },
    methods: {
        async onSubmit() {
            if(this.$v.$invalid){
                this.$v.$touch()
                return
            }
            const formData = {
                name: this.name,
                email: this.email,
                password: this.password,
                password_confirmation: this.password_confirmation,
                _token: this.csrfToken
            }

            axios.post('/register' , formData).then(response => {
                if(response.status == 200){
                    alert('вы успешно зарегестрировались')
                    this.$router.push('/')
                }
            })
            .catch(error => {
                console.log(error);
            })
        }
    }

}
</script>
