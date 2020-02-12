<template>
    <b-alert show v-bind:class="[iconClass]" :variant="variant" :dismissible="dismissible">
        <h4 v-if="title" class="alert-heading">{{ title }}</h4>
        <i class="fe mr-2" v-bind:class="[iconType]" aria-hidden="true"></i>
        <p>
            {{ body }}
        </p>
    </b-alert>
</template>

<script>
    export default {
        name: "AlertComponent",
        props: {
            'variant': {
                type: String,
                required: true
            },
            'title': {
                type: String,
                required: false
            },
            'body': {
                type: String,
                required: true
            },
            'dismissible': {
                type: Boolean,
                required: true,
                default: false
            },
        },
        data() {
            return {
                iconClass: 'alert-icon',
            }
        },
        mounted() {
            this.$el.querySelector('.close').innerHTML = '';
        },
        computed: {
            iconType() {
                switch (this.variant) {
                    case 'success':
                        return 'fe-check-circle';
                    case 'info':
                        return 'info-circle';
                    case 'warning':
                        return 'exclamation-circle';
                    case 'help':
                        return 'question-circle';
                    case 'danger':
                        return 'exclamation-circle'
                }
                return 'info-circle'
            },
        }
    }
</script>
