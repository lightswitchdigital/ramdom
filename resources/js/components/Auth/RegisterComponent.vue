<template>
    <div class="container register-block">
        <div v-if="message != ''" class="alert alert-danger" role="alert">
            {{message}}
        </div>
        <div class="card form-card">
            <div class="row">
                <div class="col-md">
                    <form @submit.prevent='onSubmit'>
                        <div class="form-title">
                            Заполните анкету, чтобы <br> <span class="with-border">зарегистритроваться</span> 
                        </div>
                        <div class="form-group">
                            <input type="text" id="name"
                                v-model.trim="name"
                                class="form-control"
                                placeholder="Имя *"
                                :class="{'is-invalid': $v.name.$dirty && !$v.name.required}">
                            <small class="error-text" v-if="$v.name.$dirty && !$v.name.required">
                                Введите имя</small>
                        </div>
                        <div class="form-group">
                            <input type="text" id="last_name"
                                v-model.trim="last_name"
                                class="form-control"
                                placeholder="Фамилия *"
                                :class="{'is-invalid': $v.last_name.$dirty && !$v.last_name.required}">
                            <small class="error-text" v-if="$v.last_name.$dirty && !$v.last_name.required">
                                Введите фамилию</small>
                        </div>
                        <div class="form-group">
                            <input type="text" id="midle_name"
                                v-model.trim="midle_name"
                                class="form-control"
                                placeholder="Отчество">
                        </div>
                        <div class="form-group">
                            <input type="text" id="phone"
                                v-model.trim="phone"
                                class="form-control"
                                placeholder="Телефон"
                                :class="{'is-invalid': ($v.phone.$dirty && !$v.phone.required) || errors.phone}">
                            <small class="error-text" v-if="$v.phone.$dirty && !$v.phone.required">
                                Введите телефон</small>
                            <small class="error-text" :v-if="errors.phone" v-for="(item , index) in errors.phone" :key="index">{{ item }}</small>
                        </div>
                        <div class="form-group">
                            <input type="text" id="login"
                                v-model.trim="email"
                                class="form-control"
                                placeholder="E-mail *"
                                :class="{'is-invalid' : ($v.email.$dirty && !$v.email.required) || ($v.email.$dirty && !$v.email.email) || errors.email}">
                            <small class="error-text" v-if="$v.email.$dirty && !$v.email.required">
                                Введите email</small>
                            <small class="error-text" v-else-if="$v.email.$dirty && !$v.email.email">
                                Email не коректен</small>
                            <small class="error-text" :v-if="errors.email" v-for="(item , index) in errors.email" :key="index">{{ item }}</small>
                        </div>
                        <div class="form-group">
                            <input type="password" id="password"
                                    v-model.trim="password"
                                    class="form-control"
                                    placeholder="Пароль *"
                                    :class="{'is-invalid': ($v.password.$dirty && !$v.password.required) || ($v.password.$dirty && !$v.password.minLength)}">
                            <small class="error-text" v-if="$v.password.$dirty && !$v.password.required">
                                Введите пароль</small>
                            <small class="error-text" v-else-if="$v.password.$dirty && !$v.password.minLength">
                                Пароль не должен быть короче {{$v.password.$params.minLength.min}} символов</small>
                        </div>
                        <div class="form-group">
                            <input type="password" id="confPassword"
                                    v-model.trim="password_confirmation"
                                    class="form-control"
                                    placeholder="Подтвердить пароль *"
                                    :class="{'is-invalid': ($v.password_confirmation.$dirty && !$v.password_confirmation.required) || ($v.password_confirmation.$dirty && !$v.password_confirmation.minLength) || errors.password}">
                            <small class="error-text" v-if="$v.password_confirmation.$dirty && !$v.password_confirmation.required">
                                Введите пароль</small>
                            <small class="error-text" v-else-if="$v.password_confirmation.$dirty && !$v.password_confirmation.minLength">
                                Пароль не должен быть короче {{$v.password_confirmation.$params.minLength.min}} символов</small>
                            <small class="error-text" :v-if="errors.password" v-for="(item , index) in errors.password" :key="index">{{ item }}</small>
                        </div>
                        <p class="radio-title">Укажите тип пользователя *</p>
                        <div class="form-group radio-group">
                            <input type="radio" id="individual"
                                    v-model="type"
                                    class="form-control"
                                    name="type"
                                    value="individual">
                            <label for="individual">Физическое лицо</label>
                            <input type="radio" id="entity"
                                    v-model="type"
                                    class="form-control"
                                    name="type"
                                    value="entity">
                            <label for="entity">Юридическое лицо</label>
                            <small class="error-text" v-if="$v.type.$dirty && !$v.type.required">
                                Выберите тип лица</small>
                        </div>

                        <button class="btn btn-submit yellow-btn" :class="{active: isDisabled}" :disabled='isDisabled' type="submit">
                            <span class="text-succes">Вы зарегистрировались</span>
                            <span class="not-disabled">Зарегистритроваться</span>
                        </button>
                    </form>
                </div>
                <div class="col-md form-img-col">
                    <img src="https://www.architectureanddesign.com.au/getattachment/Projects/Houses/Designing-high-tech-cross-laminated-timber-house/The-Seed-House_FP_Ben-Guthrie_H02-1.jpg.aspx" alt="">
                </div>
            </div>
        </div>
        
    </div>
</template>
<script>
import {required , email , minLength} from 'vuelidate/lib/validators'

export default {
    name: 'register',
    data: () => ({
        name: '',
        last_name: '',
        midle_name: '',
        email: '',
        phone: '',
        role: 'customer',
        type: undefined,
        password: '',
        password_confirmation: '',
        message: '',  // Сообщение об ошибке
        errors: '',
        isDisabled: false,
        animated: false
    }),
    created() {
        this.csrfToken = document.querySelector('meta[name="csrf-token"]').content
    },
    validations: {
        name: {required},
        last_name: {required},
        phone: {required},
        email: {required , email},
        password: {required , minLength: minLength(8)},
        password_confirmation: {required , minLength: minLength(8)},
        type: {required}
    },
    methods: {
        async onSubmit() {
            if(this.$v.$invalid){
                this.$v.$touch()
                return
            }
            const formData = {
                name: this.name,
                last_name: this.last_name,
                midle_name: this.midle_name,
                email: this.email,
                password: this.password,
                password_confirmation: this.password_confirmation,
                phone: this.phone,
                role: this.role,
                type: this.type,
                _token: this.csrfToken
            }

            axios.post('/register' , formData).then(response => {
                if(response.status === 204){
                    this.isDisabled = true 
                    setTimeout(() => {
                        window.location.href = '/'
                    } , 1000)
                    
                }
            }).catch(error => {
                this.message = error.response.data.message
                this.errors = error.response.data.errors
            })
        }
    }
}

</script>
