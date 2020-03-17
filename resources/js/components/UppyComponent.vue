<template>

    <div>

        <b-button variant="outline-primary mb-4" @click="$refs.fileInput.click()">

            <input type="file"
                   ref="fileInput"
                   v-show="false"
                   @change="handleInputChange($event)"
                   accept="application/pdf, application/vnd.openxmlformats-officedocument.wordprocessingml.document, application/msword"
            >

            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"
                 stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                 class="icon icon-md mr-2">
                <path
                    d="M21.44 11.05l-9.19 9.19a6 6 0 0 1-8.49-8.49l9.19-9.19a4 4 0 0 1 5.66 5.66l-9.2 9.19a2 2 0 0 1-2.83-2.83l8.49-8.48"></path>
            </svg>

            Attach

        </b-button>

        <div class="UppyProgressBar"></div>

        <div class="UppyInformer"></div>

        <p v-if="uploadedResume !== null" class="mt-3">

            {{ uploadedResume.name }}

            <b-link @click="removeFile(uploadedResume.id)">

                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"
                     stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                     class="icon ml-2">
                    <line x1="18" y1="6" x2="6" y2="18"></line>
                    <line x1="6" y1="6" x2="18" y2="18"></line>
                </svg>

            </b-link>

        </p>

    </div>

</template>

<script>
    import Uppy from "@uppy/core";
    import FileInput from "@uppy/file-input";
    import XHRUpload from "@uppy/xhr-upload";
    import ProgressBar from "@uppy/progress-bar";
    import Informer from "@uppy/informer";

    export default {
        name: "UppyComponent",
        components: {
            Uppy,
            FileInput,
            XHRUpload,
            ProgressBar,
            Informer
        },
        props: {
            'user': {
                type: Object,
                required: true
            },
            'resumeUrl': {
                required: true
            },
        },
        data() {
            return {
                uploadedResume: null,
                uppy: null,
            }
        },
        mounted() {
            this.initializeUppy();
            if (this.resumeUrl != null) {
                this.fetchResume();
            }
        },
        methods: {
            initializeUppy() {
                this.uppy = new Uppy({
                    debug: true,
                    allowMultipleUploads: true,
                    autoProceed: true,
                    restrictions: {
                        maxFileSize: 512000,
                        maxNumberOfFiles: 1,
                        allowedFileTypes: ['.pdf', '.doc', '.docx']
                    },
                });
                this.uppy.use(ProgressBar, {
                    target: '.UppyProgressBar',
                    hideAfterFinish: false
                });
                this.uppy.use(Informer, {
                    target: '.UppyInformer',
                    replaceTargetContent: true,
                });
                this.uppy.use(XHRUpload, {
                    endpoint: `${this.user.username}/resume`,
                    headers: {
                        'X-CSRF-TOKEN': document.head.querySelector('meta[name="csrf-token"]').content
                    },
                    formData: true,
                    fieldName: 'resume'
                });
                this.uppy.on('upload-success', (file, response) => {
                    file.name = (response.body.split('/'))[1];
                    this.uploadedResume = file;
                });
            },
            fetchResume() {
                fetch(this.resumeUrl)
                    .then((response) => response.blob()) // returns a Blob
                    .then((blob) => {
                        this.uppy.addFile({
                            name: this.resumeUrl.split('/').slice(-1)[0],
                            type: blob.type,
                            data: blob,
                            remote: true
                        });
                        this.uploadedResume = this.uppy.getFiles()[0];
                        Object.keys(this.uppy.state.files).forEach(file => {
                            this.uppy.setFileState(file, {
                                progress: {
                                    uploadComplete: true,
                                    uploadStarted: true
                                }
                            })
                        })
                    })
            },
            handleInputChange(event) {
                const files = Array.from(event.target.files);
                files.forEach((file) => {
                    try {
                        this.uppy.addFile({
                            source: 'file input',
                            name: file.name,
                            type: file.type,
                            data: file
                        })
                    } catch (error) {
                        error.isRestriction ? console.log('Restriction error:', error) : console.error(error);
                    }
                })
            },
            removeFile(id) {
                axios.delete(`${this.user.username}/resume`)
                    .then(function (response) {
                        console.log(response);
                    })
                    .catch(function (error) {
                        console.log(error);
                    });
                this.uppy.removeFile(id);
                this.uploadedResume = null;
            },
        }
    }
</script>

<style lang="scss">

    @import "~@uppy/core/dist/style.min.css";
    @import '~@uppy/progress-bar/dist/style.css';
    @import '~@uppy/informer/dist/style.min.css';

</style>
