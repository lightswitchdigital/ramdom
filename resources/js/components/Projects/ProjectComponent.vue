<template>
        <div class="container project-view">
            <div class="modal fade" id="editorModal" tabindex="-1" aria-labelledby="editorModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-xl">
                    <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Редактирование шаблона</h5>
                        <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close">
                            <svg xmlns="http://www.w3.org/2000/svg" width="19" height="20" viewBox="0 0 19 20" fill="none">
                            <path d="M11.5499 9.95887L18.179 3.16637C18.4693 2.86822 18.6324 2.46385 18.6324 2.0422C18.6324 1.62056 18.4693 1.21619 18.179 0.918038C17.8887 0.61989 17.495 0.452393 17.0845 0.452393C16.6739 0.452393 16.2802 0.61989 15.9899 0.918038L9.37613 7.72637L2.76238 0.918038C2.47207 0.61989 2.07834 0.452393 1.66779 0.452393C1.25724 0.452393 0.863511 0.61989 0.57321 0.918038C0.282908 1.21619 0.119819 1.62056 0.119819 2.0422C0.119819 2.46385 0.282908 2.86822 0.57321 3.16637L7.20238 9.95887L0.57321 16.7514C0.428712 16.8986 0.314021 17.0737 0.235753 17.2666C0.157484 17.4596 0.117188 17.6665 0.117188 17.8755C0.117188 18.0846 0.157484 18.2915 0.235753 18.4845C0.314021 18.6774 0.428712 18.8525 0.57321 18.9997C0.716528 19.1481 0.887038 19.2659 1.0749 19.3463C1.26277 19.4267 1.46427 19.4681 1.66779 19.4681C1.87131 19.4681 2.07282 19.4267 2.26068 19.3463C2.44855 19.2659 2.61906 19.1481 2.76238 18.9997L9.37613 12.1914L15.9899 18.9997C16.1332 19.1481 16.3037 19.2659 16.4916 19.3463C16.6794 19.4267 16.8809 19.4681 17.0845 19.4681C17.288 19.4681 17.4895 19.4267 17.6773 19.3463C17.8652 19.2659 18.0357 19.1481 18.179 18.9997C18.3235 18.8525 18.4382 18.6774 18.5165 18.4845C18.5948 18.2915 18.6351 18.0846 18.6351 17.8755C18.6351 17.6665 18.5948 17.4596 18.5165 17.2666C18.4382 17.0737 18.3235 16.8986 18.179 16.7514L11.5499 9.95887Z" fill="white"/>
                            </svg>
                        </button>
                    </div>
                    <div class="modal-body">
                        <input type="text" class="search" placeholder="Название атрибута">
                        <div class="row">
                            <div class="col">
                                <ul>
                                    <li v-for="(group, index) in this.groups" :key="index">
                                        <a href="#"  @click.prevent="changeGroup(group)">
                                            <span>{{group}}</span>
                                            <i class="fas fa-chevron-right"></i>
                                        </a>
                                    </li>
                                </ul>
                            </div>
                            <div class="col">
                                <h5>{{this.changedGroup}}:</h5>
                                <ul>
                                    <li v-for="(cell) in this.changedCells" :key="cell.id" >
                                        <a href="#" @click.prevent="changeCell(cell.id)">
                                            <span>{{cell.label}}</span>
                                            <i class="fas fa-chevron-right"></i>
                                        </a>
                                    </li>
                                </ul>
                            </div>
                            <div class="col">
                                    <h5>{{this.changedCell.label}}: </h5>
                                    <input v-if="this.changedCell.type == 'number'" type="number" :value="this.changedCell.def">

                                    <select v-else-if="this.changedCell.type == 'select'">
                                        <option v-for="(option, index) in this.changedCell.variants" :key="index">
                                            {{option}}
                                        </option>
                                    </select>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn yellow-outline-btn" data-dismiss="modal">Сбросить</button>
                        <button type="button" class="btn yellow-btn">Сохранить изменения</button>
                    </div>
                    </div>
                </div>
            </div>
        <h2 class="project-title">{{ project.title }}</h2>
        <div class="row">
            <div class="col-md-6">
                <div class="preview">
                    <VueSlickCarousel
                        ref="preview"
                        :asNavFor="$refs.miniPreview"
                        :focusOnSelect="true"
                        :fade="true"
                        :arrow="false">
                        <div class="preview-slide" v-for="(image , index) in project.jsonImages" :key="index">
                            <img :src="image" :alt="project.title">
                        </div>
                    </VueSlickCarousel>
                </div>
                <div class="mini-slider">
                    <VueSlickCarousel
                        ref="miniPreview"
                        :slidesToShow="1"
                        :variableWidth="true"
                        :focusOnSelect="true"
                        :arrow="true"
                        :asNavFor="$refs.preview"
                        :centerMode="true">
                        <div class="mini-preview" v-for="(image , index) in project.jsonImages" :key="index">
                            <img :src="image" :alt="project.title">
                        </div>
                        <template #nextArrow>
                            <div class="btn-next">
                                <i class="fas fa-chevron-right"></i>
                            </div>
                        </template>
                        <template #prevArrow>
                            <div class="btn-prev">
                                <i class="fas fa-chevron-left"></i>
                            </div>
                        </template>
                    </VueSlickCarousel>
                </div>
                <div class="card desc-card">
                    {{ project.description }}
                </div>
            </div>
            <div class="col-md-6">
                <div class="card info-card">
                    <div
                    v-if="isAuthenticated"
                    class="like-block"
                    :disabled="btnDisabled"
                    :class="[{active : project.isInFavorites} , favoritesClass]"
                    @click.prevent="toggleFavorites">
                        <span v-if="!project.isInFavorites">Добавить в избранное</span>
                        <span v-else>В избранном</span>
                        <span class="like"><i class="fas fa-heart"></i></span>
                    </div>

                    <form @submit.prevent='onSubmit' @change.prevent="saveProject">
                        <!-- <input type="hidden" name="_token" :value="this.csrfToken"> -->
                        <table class="table">
                            <tbody>
                                <tr v-for="(value, label , index) in project.jsonValues" :key="index">
                                    <td>{{ label }}</td>
                                    <td>{{ value }}</td>
                                </tr>
                                <tr v-for="(attribute , index) in this.purchaseAttributes" :key="index">
                                    <td>
                                        <label :for="'purchase_attribute_'+attribute.id" class="col-form-label">{{ attribute.name }}</label>
                                    </td>
                                    <td>
                                        <select v-if="attribute.variants.length > 0"
                                                :id="'purchase_attribute_'+attribute.id"
                                                class="custom-select"
                                                :name="'purchase_attributes['+attribute.id+']'"
                                                v-model="savedAttributes[attribute.id]">
                                            <option v-for="(variant , index) in attribute.variants" :value="variant" :key="index">
                                                {{ variant }}
                                            </option>
                                        </select>
                                        <input v-else-if="attribute.type === 'integer'"
                                        :id="'purchase_attribute_'+attribute.id"
                                        type="number" class="form-control"
                                        :name="'purchase_attributes['+attribute.id+']'"
                                        v-model="savedAttributes[attribute.id]">

                                        <input v-else
                                        :id="'purchase_attribute_'+attribute.id"
                                        type="text"
                                        class="form-control"
                                        :name="'purchase_attributes['+attribute.id+']'"
                                        v-model="savedAttributes[attribute.id]">
                                    </td>
                                </tr>
                            </tbody>

                        </table>

                        <div class="price-block">
                            <table class="table">
                                <tbody>
                                <tr>
                                    <td><strong>Стоимость проекта</strong></td>
                                    <td><div class="price">{{ project.price }}</div></td>
                                </tr>
                                <tr>
                                    <td><strong>Стоимость строительства</strong></td>
                                    <td><div class="price">{{ project.price }}</div></td>
                                </tr>
                                </tbody>
                            </table>
                        </div>
                        <div v-if="!canEdit && !saveFile" class="alert alert-info" >
                            Этот проект не сохранится так как превышен лимит одновременных проектов
                        </div>
                        <div class="alert alert-danger" v-if="notAllChange">
                            Вы не выбрали все параметры
                        </div>
                        <div class="btn-block">
                            <button type="submit" class="btn yellow-btn" :disabled="buyDisabled">Купить проект</button>
                            <button type="button"  data-toggle="modal" data-target="#editorModal" class="btn yellow-outline-btn">Тест</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <Recommend :recommendations='recommendations'/>
    </div>
</template>

<script>
import Recommend from './RecommendationsComponent'
import VueSlickCarousel from 'vue-slick-carousel'
import 'vue-slick-carousel/dist/vue-slick-carousel.css'
import 'vue-slick-carousel/dist/vue-slick-carousel-theme.css'

export default {
    name: "ProjectComponent",
    data:() => ({
        toggleFavoritesUrl: '',
        favoritesClass: '',
        btnDisabled: false,
        linkForBuy: '',
        savedAttributes: {},
        buyDisabled: false,
        notAllChange: false,
        cells: {
            "building_type_by_floors": {
            "id": "A6",
            "type": "select",
            "label": "Выбор типа строения по этажности",
            "def": "1 полноценный этаж",
            "variants": [
                "1 полноценный этаж",
                "2 полноценных этажа",
                "1 этаж + 2-ой мансардный",
                "1 мансардный этаж",
                "1 эт + 2-ой мансарда с перекрытием"
            ]
            },
            "building_material": {
            "id": "A8",
            "type": "select",
            "label": "Выбор материала дома",
            "def": "Кирпичный дом",
            "variants": [
                "Дом не строить",
                "Каркасный дом. Брус",
                "Каркасный дом. Двутавр дерево",
                "Газобетон дом",
                "Пенобетон дом",
                "Кирпичный дом",
                "Брусовой дом",
                "Сип панели дом",
                "Клееный брус дом",
                "Профилированный брус дом",
                "Дикое бревно",
                "Оцилиндрованное бревно",
                "1-ый эт кирпич 2-ой эт пенобетон",
                "1-ый эт кирпич 2-ой эт брус",
                "1-ый эт кирпич 2-ой эт клееный брус",
                "1-ый эт кирпич 2-ой эт профилированный брус",
                "1-ый эт кирпич 2-ой эт дикое бревно брус",
                "1-ый эт кирпич 2-ой эт дикое оцилиндр брус",
                "1-ый эт кирпич 2-ой эт дикое сип панели",
                "1-ый эт кирпич 2-ой эт каркасник",
                "1-ый эт кирпич 2-ой эт газобетон",
                "1-ый эт газобетон 2-ой эт брус",
                "1-ый эт газобетон 2-ой эт профилированный брус",
                "1-ый эт газобетон 2-ой эт дикое бревно",
                "1-ый эт газобетон 2-ой эт оцилиндр бревно",
                "1-ый эт газобетон 2-ой эт сип панели",
                "1-ый эт газобетон 2-ой эт каркасник",
                "1-ый эт газобетон 2-ой эт пенобетон",
                "1-ый эт газобетон 2-ой эт газобетон",
                "1-ый эт пенобетон 2-ой эт брус",
                "1-ый эт пенобетон 2-ой эт профилированный брус",
                "1-ый эт пенобетон 2-ой эт оцилиндр бревно",
                "1-ый эт пенобетон 2-ой эт сип панели",
                "1-ый эт пенобетон 2-ой эт каркасник",
                "1-ый эт брус 2-ой эт каркасник"
            ]
            },

            "building_width": {
            "id": "C11",
            "type": "number",
            "label": "Ширина дома",
            "def": 10,
            "group": "basics"
            },
            "building_length": {
            "id": "C12",
            "type": "number",
            "label": "Длина дома",
            "def": 10,
            "group": "basics"
            },
            "first_floor_height": {
            "id": "C13",
            "type": "number",
            "label": "Высота 1-го этажа",
            "def": 3,
            "group": "basics"
            },
            "height_from_overlap_to_apex": {
            "id": "C14",
            "type": "number",
            "label": "Высота от перекрытий 0 эт до конька",
            "def": 8,
            "group": "basics"
            },
            "attic_wall": {
            "id": "C15",
            "type": "number",
            "label": "Аттиковая стена, мансардный этаж",
            "def": 1.20,
            "group": "basics"
            },
            "second_floor_height": {
            "id": "C16",
            "type": "number",
            "label": "Высота 2-го этажа",
            "def": 2.20,
            "group": "basics"
            },
            "left_wall_first_floor_height": {
            "id": "C21",
            "type": "number",
            "label": "Высота левой боковой стены 1-го этажа",
            "def": 3,
            "group": "basics"
            },
            "right_wall_first_floor_height": {
            "id": "C22",
            "type": "number",
            "label": "Высота правой боковой стены 1-го этажа",
            "def": 4,
            "group": "basics"
            },
            "left_wall_second_floor_height": {
            "id": "C23",
            "type": "number",
            "label": "Высота левой боковой стены 2-го этажа",
            "def": 0,
            "group": "basics"
            },
            "right_wall_second_floor_height": {
            "id": "C24",
            "type": "number",
            "label": "Высота правой боковой стены 2-го этажа",
            "def": 1.5,
            "group": "basics"
            },
            "from_left_wall_to_apex": {
            "id": "C29",
            "type": "number",
            "label": "Расстояние от левой стены дома до конька",
            "def": 4,
            "group": "basics"
            },
            "from_right_wall_to_apex": {
            "id": "C30",
            "type": "number",
            "label": "Высота 2-го этажа",
            "def": 5,
            "group": "basics"
            },

            "overlap_zero_floor": {
            "id": "A33",
            "type": "select",
            "label": "Перекрытие 0-го этажа, В/Ш",
            "variants": [
                "Нет перекрытия",
                "Sip панель 2500*625*124мм",
                "Sip панель 2500*625*174мм",
                "Sip панель 2500*625*224мм",
                "Брус естественной влажности, 200*100мм",
                "Брус естественной влажности, 150*100мм",
                "Брус естественной влажности, 100*100мм",
                "Брус естественной влажности, 150*150мм",
                "Доска естественной влажности, 200*50мм",
                "Доска естественной влажности, 150*50мм",
                "Доска сухая, 200*50мм",
                "Доска сухая, 150*50мм",
                "Доска сухая калиброванная, 190*45мм",
                "Доска сухая калиброванная, 145*45мм",
                "Монолит, бетон, 300мм, 2 слоя",
                "Монолит, бетон, 300мм, 1 слоя",
                "Монолит, бетон, 250мм, 2 слоя",
                "Монолит, бетон, 250мм, 1 слоя",
                "Монолит, бетон, 200мм, 2 слоя",
                "Монолит, бетон, 200мм, 1 слоя",
                "Монолит, бетон, 150мм, 2 слоя",
                "Монолит, бетон, 150мм, 1 слоя",
                "Плита перекрытия ЖБИ",
                "Двутавровая деревянная балка, 400*65мм",
                "Двутавровая деревянная балка, 400*90мм",
                "Двутавровая деревянная балка, 350*65мм",
                "Двутавровая деревянная балка, 350*90мм",
                "Двутавровая деревянная балка, 300*65мм",
                "Двутавровая деревянная балка, 300*90мм",
                "Двутавровая деревянная балка, 240*65мм",
                "Двутавровая деревянная балка, 240*90мм",
                "Двутавровая деревянная балка, 200*65мм",
                "Двутавровая деревянная балка, 200*90мм",
                "Двутавровая деревянная балка, 150*65мм",
                "Двутавровая деревянная балка, 150*90мм",
                "ГПС 100x50-1,2",
                "ГПС 100x50-1,5",
                "ГПС 120x50-1,5",
                "ГПС 120x50-2,0",
                "ГПС 150x50-1,2",
                "ГПС 150x50-1,5",
                "ГПС 150x50-2,0",
                "ГПС 170x50-1,2",
                "ГПС 170x50-1,5",
                "ГПС 170x50-2,0",
                "ГПС 200x50-1,2",
                "ГПС 200x50-1,5",
                "ГПС 200x50-2,0",
                "ГПС 250x50-1,2",
                "ГПС 250x50-1,5",
                "ГПС 250x50-2,0",
                "ГПС 280x50-1,2",
                "ГПС 280x50-1,5",
                "ГПС 280x50-2,0"
            ],
            "group": "overlap_zero_floor"
            },
            "zero_floor_balk_step": {
            "id": "C33",
            "type": "number",
            "label": "Шаг бруса",
            "def": 0.6,
            "group": "overlap_zero_floor"
            },
            "zero_floor_armature": {
            "id": "D33",
            "type": "select",
            "label": "Арматура",
            "def": "Арматура М8 ",
            "variants": [
                "Арматура М8 ",
                "Арматура М10",
                "Арматура М12",
                "Арматура М14",
                "Арматура М16",
                "Арматура М18",
                "Арматура М20"
            ],
            "group": "overlap_zero_floor"
            },
            "zero_floor_armature_step": {
            "id": "E33",
            "type": "number",
            "label": "Шаг арматуры",
            "def": 0.15,
            "group": "overlap_zero_floor"
            },
            "first_floor_balk_step": {
            "id": "C43",
            "type": "number",
            "label": "Шаг бруса",
            "def": 0.6,
            "group": "overlap_zero_floor"
            },
            "first_floor_armature": {
            "id": "D43",
            "type": "select",
            "label": "Арматура",
            "def": "Арматура М10",
            "variants": [
                "Арматура М8 ",
                "Арматура М10",
                "Арматура М12",
                "Арматура М14",
                "Арматура М16",
                "Арматура М18",
                "Арматура М20"
            ],
            "group": "overlap_zero_floor"
            },
            "first_floor_armature_step": {
            "id": "E43",
            "type": "number",
            "label": "Шаг арматуры",
            "def": 0.2,
            "group": "overlap_zero_floor"
            },

            "second_floor_balk_step": {
            "id": "C43",
            "type": "number",
            "label": "Шаг бруса",
            "def": 0.6,
            "group": "overlap_zero_floor"
            },
            "second_floor_armature": {
            "id": "D43",
            "type": "select",
            "label": "Арматура",
            "def": "Арматура М12",
            "variants": [
                "Арматура М8 ",
                "Арматура М10",
                "Арматура М12",
                "Арматура М14",
                "Арматура M16",
                "Арматура M18",
                "Арматура M20"
            ],
            "group": "overlap_zero_floor"
            },
            "second_floor_armature_step": {
            "id": "E43",
            "type": "number",
            "label": "Шаг арматуры",
            "def": 0.25,
            "group": "overlap_zero_floor"
            },

            "overlaps_transport_first": {
            "id": "C60",
            "type": "number",
            "label": "Транспорт для перекрытий",
            "def": 1,
            "group": "overlap_zero_floor"
            },
            "overlaps_transport_second": {
            "id": "C61",
            "type": "number",
            "label": "Транспорт для перекрытий",
            "def": 1,
            "group": "overlap_zero_floor"
            },
            "overlaps_transport_third": {
            "id": "C62",
            "type": "number",
            "label": "Транспорт для перекрытий",
            "def": 0,
            "group": "overlap_zero_floor"
            },


            "windows_width_first_floor": {
            "id": "C68",
            "type": "number",
            "label": "Ширина окон 1 эт",
            "def": 1,
            "group": "windows_doors",
            "subgroup": "windows"
            },
            "windows_height_first_floor": {
            "id": "D68",
            "type": "number",
            "label": "Высота окон 1 эт",
            "def": 1.2,
            "group": "windows_doors",
            "subgroup": "windows"
            },
            "windows_count_first_floor": {
            "id": "E68",
            "type": "number",
            "label": "Кол-во",
            "def": 1.2,
            "group": "windows_doors",
            "subgroup": "windows"
            },

            "door_welcome_width": {
            "id": "C85",
            "type": "number",
            "label": "Ширина входной двери",
            "def": 0.8,
            "group": "windows_doors",
            "subgroup": "doors"
            },
            "door_welcome_height": {
            "id": "D85",
            "type": "number",
            "label": "Высота входной двери",
            "def": 2.1,
            "group": "windows_doors",
            "subgroup": "doors"
            },
            "door_welcome_count": {
            "id": "E85",
            "type": "number",
            "label": "Кол-во",
            "def": 0,
            "group": "windows_doors",
            "subgroup": "doors"
            },

            "door_in_width": {
            "id": "C91",
            "type": "number",
            "label": "Ширина внут дверей",
            "def": 0.8,
            "group": "windows_doors",
            "subgroup": "doors"
            },
            "door_in_height": {
            "id": "D91",
            "type": "number",
            "label": "Высота внут дверей",
            "def": 2.1,
            "group": "windows_doors",
            "subgroup": "doors"
            },
            "door_in_count": {
            "id": "E91",
            "type": "number",
            "label": "Кол-во",
            "def": 0,
            "group": "windows_doors",
            "subgroup": "doors"
            },

            "windows_width_second_floor": {
            "id": "C77",
            "type": "number",
            "label": "Ширина окон 2 эт",
            "def": 0.6,
            "group": "windows_doors",
            "subgroup": "windows"
            },
            "windows_height_second_floor": {
            "id": "D77",
            "type": "number",
            "label": "Высота окон 2 эт",
            "def": 0.6,
            "group": "windows_doors",
            "subgroup": "windows"
            },
            "windows_count_second_floor": {
            "id": "E77",
            "type": "number",
            "label": "Кол-во",
            "def": 0,
            "group": "windows_doors",
            "subgroup": "windows"
            },

            "stairs_count": {
            "id": "B1128",
            "type": "integer",
            "def": 10,
            "group": "stairs",
            "subgroup": "params"
            },
            "stair_height": {
            "id": "B1129",
            "type": "integer",
            "def": 2000,
            "group": "stairs",
            "subgroup": "params"
            },
            "stair_length": {
            "id": "B1130",
            "type": "integer",
            "def": 3000,
            "group": "stairs",
            "subgroup": "params"
            },
            "stair_width": {
            "id": "B1131",
            "type": "integer",
            "def": 800,
            "group": "stairs",
            "subgroup": "params"
            },
            "stairs_place_length": {
            "id": "B1132",
            "type": "integer",
            "def": 500,
            "group": "stairs",
            "subgroup": "params"
            },
            "stairs_place_stroke": {
            "id": "B1133",
            "type": "integer",
            "def": 100,
            "group": "stairs",
            "subgroup": "params"
            },
            "stairs_extra_stroke": {
            "id": "B1134",
            "type": "integer",
            "def": 50,
            "group": "stairs",
            "subgroup": "params"
            },

            "result": {
            "id" : "A2",
            "def" : 0
            }
        },
        changedCell: {},
        changedCells: {},
        groups: [],
        changedGroup: ''
    }),
    props: [
        'project',
        'createdAt',
        'buyLink',
        'recommendations',
        'purchaseAttributes',
        'isAuthenticated',
        'canEdit',
        'saveLink',
        'saveFile',
        'jsonUrl',
        'calculateRoute'
    ],
    created() {
        this.csrfToken = document.querySelector('meta[name="csrf-token"]').content
    },
    mounted() {
        this.$nextTick(this.$forceUpdate);
        if(this.saveFile){
            this.savedAttributes = this.saveFile.values_data
        }

        this.getGroups()

    },
    components: {
        VueSlickCarousel ,
        Recommend
    },
    methods: {
        toggleFavorites() {
            this.btnDisabled = true
            if(!this.project.isInFavorites){
                this.toggleFavoritesUrl = this.project.addToFavoritesLink
            }else{
                this.toggleFavoritesUrl = this.project.removeFromFavoritesLink
            }
            this.project.isInFavorites = !this.project.isInFavorites
            axios.post(this.toggleFavoritesUrl , {'_token' : this.csrfToken}).then(response => {
                if(response.status === 204){
                    this.$nextTick(this.$forceUpdate);
                    this.favoritesClass = 'animated'
                    setTimeout(() => {this.favoritesClass = ''}, 200)
                    this.btnDisabled = false
                }
            }).catch(error => {
                this.btnDisabled = false
                console.log(error);
            })
        },
        onSubmit() {
            if(this.isAuthenticated){
                    this.buyDisabled = true
                    this.notAllChange = false
                    axios.post(this.buyLink , {'_token' : this.csrfToken, 'purchase_attributes' : this.savedAttributes} ).then(response => {
                        if(response.status === 204){
                            this.buyDisabled = false;
                            alert('Вы успешно купили проект')
                        }
                    }).catch(error => {
                        this.buyDisabled = false
                        console.log(error);
                    })
            }else{
                window.location.href = '/register'
            }
        },
        saveProject() {
            if(this.isAuthenticated && (this.canEdit || this.saveFile)){
                this.buyDisabled = true;
                axios.post(this.saveLink , {'_token' : this.csrfToken, 'purchase_attributes' : this.savedAttributes} ).then(response => {
                    if(response.status === 200){
                        this.buyDisabled = false;
                        console.log('save is ok');
                    }
                }).catch(error => {
                    this.buyDisabled = false;
                    console.log(error);
                })
            }
        },
        changeCell(id) {

            for(let cell in this.cells){
                if(this.cells[cell].id == id){
                    this.changedCell = this.cells[cell]
                }
            }
        },
        getGroups(){
            for (let cell in this.cells){
                if(this.cells[cell].group && !this.groups.includes(this.cells[cell].group)){
                    this.groups.push(this.cells[cell].group)
                }
            }
        },
        changeGroup(group) {
            this.changedCells = []
            this.changedGroup = group
            for (let cell in this.cells){
                if(this.cells[cell].group == group){
                    this.changedCells.push(this.cells[cell])
                }
            }
        }
    }
}

</script>
