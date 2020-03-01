<template>

    <b-form-select
        :name="inputName"
        :id="inputId"
        class="form-select"
        v-model="selected"
        :state="inputState"
        :options="selectOptions"
        required="false"
        :required="!!required"
    >
        <template v-slot:first>

            <b-form-select-option :value="null">{{ placeholder }}</b-form-select-option>

        </template>

    </b-form-select>

</template>

<script>
    export default {
        name: "SelectComponent",
        props: {
            inputName: {
                type: String,
                required: true,
            },
            inputId: {
                type: String,
                required: true,
            },
            inputState: {
                required: true,
            },
            preSelected: {
                type: String,
            },
            options: {
                type: Array,
                required: true
            },
            optionsText: {
                type: String,
                required: false,
            },
            optionsIdentifier: {
                type: String,
                required: false,
            },
            placeholder: {
                type: String,
                default: 'Select an option'
            },
            required: {
                type: Boolean,
                default: false,
            }
        },
        data() {
            return {
                selected: this.preSelected ? this.preSelected : null,
            }
        },
        computed: {
            selectOptions() {
                if (typeof this.options[0] == 'object') {
                    return this.options.map(function (object) {
                        return {value: object[this.optionsIdentifier], text: object[this.optionsText]};
                    }.bind(this));
                }
                return this.options;
            }
        }
    }
</script>
