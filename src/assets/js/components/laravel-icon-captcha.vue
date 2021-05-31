<template>
    <div>
        <label for="captcha">{{ captcha.question }}</label>
        <div class="lci-content-box">
            <div class="lci-icon-wrapper-box">
                <div class="lci-icon-box" v-for="option in captcha.options" :key="option.id">
                    <img :id="option.id" class="lci-icon-image" @click="selectIcon(option.id)"
                         :src="'/assets/vendor/laravel-icon-captcha/svg/' + option.icon" :alt="option.icon">
                    <input id="captcha" type="radio" name="captcha" :value="option.id" hidden>
                </div>
            </div>
            <div id="reload-box"
                 class="lci-reload-wrapper-box" @mouseout="rotateOnMouseOver('reload-icon')"
                 @click="generateCaptcha()"
                 @mouseover="rotateOnMouseOver('reload-icon')">
                <img id="reload-icon" class="lci-reload-image" :src="'/assets/vendor/laravel-icon-captcha/svg/reload.svg'"
                     alt="reload">
            </div>
        </div>
    </div>
</template>

<script>
export default {
    name: 'laravel-icon-captcha',
    created() {
        this.generateCaptcha();
    },
    data() {
        return {
            captcha: [],
        };
    },
    methods: {
        selectIcon(optionId) {
            const icon = document.getElementById(optionId);
            const previous_selected = document.getElementsByClassName("lci-icon-image--selected");

            for (let i = 0; i < previous_selected.length; i++) {
                previous_selected[i].classList.toggle('lci-icon-image--selected');
                icon.parentElement.getElementsByTagName("input")[0].checked = false;
            }

            icon.parentElement.getElementsByTagName("input")[0].checked = true;
            icon.classList.toggle('lci-icon-image--selected')
        },
        generateCaptcha() {
            this.captcha = [];

            axios.get('/generate/captcha').then((response) => {
                this.captcha = response.data.data;
            });
        },
        rotateOnMouseOver(id) {
            const icon = document.getElementById(id)
            icon.classList.toggle('lci-rotate-image')
        }
    }
}
</script>
