<template>
    <form @submit.prevent="onSubmit" class="agree-form">
        <!-- <div class="row">
        <div class="col-4">
            <div class="list-group" id="list-tab" role="tablist">
            <a class="list-group-item list-group-item-action active" id="list-home-list" data-bs-toggle="list" href="#list-home" role="tab" aria-controls="home">Home</a>
            <a class="list-group-item list-group-item-action" id="list-profile-list" data-bs-toggle="list" href="#list-profile" role="tab" aria-controls="profile">Profile</a>
            <a class="list-group-item list-group-item-action" id="list-messages-list" data-bs-toggle="list" href="#list-messages" role="tab" aria-controls="messages">Messages</a>
            <a class="list-group-item list-group-item-action" id="list-settings-list" data-bs-toggle="list" href="#list-settings" role="tab" aria-controls="settings">Settings</a>
            </div>
        </div>
        <div class="col-8">
            <div class="tab-content" id="nav-tabContent">
            <div class="tab-pane fade show active" id="list-home" role="tabpanel" aria-labelledby="list-home-list">...</div>
            <div class="tab-pane fade" id="list-profile" role="tabpanel" aria-labelledby="list-profile-list">...</div>
            <div class="tab-pane fade" id="list-messages" role="tabpanel" aria-labelledby="list-messages-list">...</div>
            <div class="tab-pane fade" id="list-settings" role="tabpanel" aria-labelledby="list-settings-list">...</div>
            </div>
        </div>
        </div> -->
        <div class="wrapper-form">
        <div class="row">
            <div class="col-md">
                <h2 class="title">Основные данные</h2>
                <input type="text" placeholder="Имя"
                v-model="orderName"
                >
                <input type="text" placeholder="E-mail"
                v-model="orderEmail"
                >
                <input type="text" placeholder="Телефон"
                v-model="orderPhone"
                >
                <input type="text" placeholder="Город"
                v-model="orderCity"
                >
                <input type="text" placeholder="Адрес"
                v-model="orderAddress"
                >
                <input type="text" placeholder="Индекс"
                v-model="orderPostalCode"
                >
            </div>
            <div class="col-md">
                <!-- <div class="switch-block">
                    <input type="checkbox" id="isEntityBtn" v-model="isEntity" @change="isEntityDate = !isEntityDate">
                    <label for="isEntityBtn">Юр. лицо<span class="switch"></span></label>
                </div> -->
                <div v-if="userType == 'entety'">
                    <h2 class="title">Данные компании</h2>
                    <input type="text" placeholder="Название компании"
                    v-model="orderCompanyName"
                    >
                    <input type="text" placeholder="ИНН"
                    v-model="orderCompanyInn"
                    >
                    <input type="text" placeholder="КПП"
                    v-model="orderCompanyKpp"
                    >
                    <input type="text" placeholder="Платежный счет"
                    v-model="orderCompanyPaymentAccount"
                    >
                    <input type="text" placeholder="Корреспондентский счет"
                    v-model="orderCompanyCorrespondentAccount"
                    >
                </div>
                <div v-else-if="userType == 'customer'">
                    <h2 class="title">Паспортные данные</h2>
                    <input type="text" placeholder="Серия паспорта"
                    v-model="orderPassportSerial"
                    >
                    <input type="text" placeholder="Номер паспорта"
                    v-model="orderPassportNumber"
                    >
                    <input type="text" placeholder="Где оформлен"
                    v-model="orderPassportIssue"
                    >
                    <input type="text" placeholder="Дата оформления"
                    v-model="orderPassportIssueDate"
                    >
                </div>
            </div>
        </div>
        <button type="submit" class="btn yellow-btn">Отправить</button>
        </div>
    </form>
</template>

<script>
export default {
    props: [
        'orderLink'
    ],
    data:() => ({
        formData: {},
        error: '',
        userType: 'entity',
        isEntityDate: true
    }), 
    created() {
        this.csrfToken = document.querySelector('meta[name="csrf-token"]').content
    },
    methods: {
        onSubmit() {
            this.formData = [
                {order_name: this.orderName},
                {order_email: this.orderEmail},
                {order_phone: this.orderPhone},
                {order_city: this.orderCity},
                {order_address: this.orderAdress},
                {order_company_name: this.orderCompanyName},
                {order_company_inn: this.orderCompanyInn},
                {order_company_kpp: this.orderCompanyKpp},
                {order_company_payment_account: this.orderCompanyPaymentAccount},
                {order_company_correspondent_account: this.orderCompanyCorrespondentAccount},
                {order_passport_serial: this.orderPassportSerial},
                {order_passport_number: this.orderPassportNumber},
                {order_passport_issue: this.orderPassportIssue},
                {order_passport_issue_date: this.orderPassportIssueDate},
                {_token: this.csrfToken}
            ]

            axios.post(this.orderLink , this.formData).then(response => {
                if(response.status === 204){
                    console.log('Данные отправлены ' + this.formData);
                }
            }).catch(error => {
                this.error = error.response.data.message;
            })
        }
    }
}
</script>