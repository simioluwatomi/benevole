<template>
    <div>
        <cropper
            :src="image"
            :stencil-props="{ aspectRatio: 1 }"
            ref="cropper"
            class="border border-dashed w-100"
            style="min-height: 300px; max-height: 600px"
        ></cropper>

        <p class="mt-3 text-center text-danger">{{ errorMessages[0] }}</p>

        <form @submit.prevent="upload">

            <div class="btn-options justify-content-around my-3">

                <ValidationProvider rules="required|ext:jpg,png,jpeg|size:1024" ref="provider">

                    <b-button variant="outline-primary" @click="$refs.file.click()">

                        <input type="file"
                               ref="file"
                               v-show="false"
                               accept="image/png,image/jpeg,image/jpg"
                               @change="loadImage($event)">

                        Select image

                    </b-button>

                </ValidationProvider>

                <b-button variant="secondary" @click="rotate" :disabled="invalid">Rotate</b-button>

                <b-button variant="primary" type="submit" :disabled="invalid">Upload</b-button>

            </div>

        </form>

    </div>

</template>

<script>
    import {Cropper} from "vue-advanced-cropper";
    import iziToast from "izitoast";
    import {ValidationProvider, ValidationObserver, extend} from 'vee-validate';
    import {required, ext, size} from 'vee-validate/dist/rules';

    extend('required', {
        ...required,
        message: 'This field is required'
    });

    extend('ext', {
        ...ext,
        message: 'The selected file must be an image'
    });

    extend('size', {
        ...size,
        message: "The selected image must be less than 1MB"
    });


    export default {
        name: "ImageUploadComponent",
        components: {
            Cropper,
            ValidationProvider,
            ValidationObserver
        },
        props: {
            'user': {
                type: Object,
                required: true
            },
        },
        data() {
            return {
                image: null,
                avatar: null,
                invalid: true,
                errorMessages: '',
            };
        },
        methods: {
            async loadImage(event) {
                const {errors, valid, failedRules} = await this.$refs.provider.validate(event);

                if (errors) {
                    this.errorMessages = errors;
                }

                if (valid) {
                    // Reference to the DOM input element
                    let input = event.target;
                    // Ensure that you have a file before attempting to read it
                    if (input.files && input.files[0]) {
                        // create a new FileReader to read this image and convert to base64 format
                        let reader = new FileReader();
                        // Define a callback function to run, when FileReader finishes its job
                        reader.onload = (event) => {
                            // Note: arrow function used here, so that "this.imageData" refers to the imageData of Vue component
                            // Read image as base64 and set to imageData
                            this.image = event.target.result;
                        };
                        this.avatar = input.files[0];
                        // Start the reader job - read file as a data url (base64 format)
                        reader.readAsDataURL(this.avatar);
                    }
                    this.invalid = false;
                }
            },
            rotate() {
                let image = document.createElement("img");
                image.crossOrigin = "anonymous";
                image.src = this.image;
                image.onload = () => {
                    let canvas = document.createElement("canvas");
                    let ctx = canvas.getContext("2d");

                    if (image.width > image.height) {
                        canvas.width = image.height;
                        canvas.height = image.width;
                        ctx.translate(image.height, image.width / image.height);
                    } else {
                        canvas.height = image.width;
                        canvas.width = image.height;
                        ctx.translate(image.height, image.width / image.height);
                    }
                    ctx.rotate(Math.PI / 2);
                    ctx.drawImage(image, 0, 0);
                    this.image = canvas.toDataURL();
                };
            },
            upload(blob) {
                const {canvas} = this.$refs.cropper.getResult();
                canvas.toBlob(result => {
                    let formData = new FormData();
                    formData.append('avatar', result, this.avatar.name);
                    axios.post(`${this.user.username}/avatar`, formData)
                        .then(function (response) {
                            this.notify();
                            // console.log(response);
                        }.bind(this))
                        .catch(function (error) {
                            console.log(error);
                        });
                }, 'image/jpeg')
            },
            notify() {
                this.$bvModal.hide('upload-profile-photo');
                iziToast.success({
                    message: 'Profile photo upload successful',
                    position: 'topRight',
                    closeOnClick: true,
                    timeout: 3000,
                    onClosed: () => {
                        location.reload();
                    }
                });
            }
        },
    };
</script>
