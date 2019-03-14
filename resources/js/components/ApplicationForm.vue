<template>
    <div>
        <b-form @submit.prevent="onSubmit">
            <div class="course block">

                <div class="container">
                    <h2>Course</h2>
                    <div class="row">
                        <div class="col-sm-6">
                            <label for="course_id">Name*</label>
                            <b-form-select
                                id="course_id"
                                @change="getCourseDates(form.course_id)"
                                v-validate="'required'"
                                name="course_id"
                                v-model="form.course_id"
                                v-bind:class="{'is-invalid' :  errors.has('course_id')}"
                                >
                                <option v-for="course in courses" v-bind:value="course.id">
                                    {{ course.name }}
                                </option>
                            </b-form-select>
                            <div v-show="errors.has('course_id')" class="invalid-feedback">{{ errors.first('course_id') }}</div>

                        </div>

                        <div class="col-sm-6">
                            <label for="course_date">Date</label>
                            <b-form-select
                                id="course_date"
                                name="course_date"
                                v-validate="'required'"
                                v-model="form.course_date"
                                v-bind:class="{'is-invalid' :  errors.has('course_date')}"
                                >
                                <option v-for="(date, index) in dates" v-bind:value="index">
                                    {{ date }}
                                </option>
                            </b-form-select>
                            <div v-show="errors.has('course_date')" class="invalid-feedback">{{ errors.first('course_date') }}</div>

                        </div>
                    </div>
                </div>
            </div>

            <div class="company block">
                <div class="container">
                    <h2>Company</h2>
                    <div class="row">
                        <div class="col-sm">
                            
                            <label for="company_name">Name*</label>
                            <b-form-input
                                v-validate="'required'"
                                name="company_name"
                                id="company_name"
                                type="text"
                                v-model="form.company_name"
                                v-bind:class="{'is-invalid' :  errors.has('company_name')}"
                                />
                            <div v-show="errors.has('company_name')" class="invalid-feedback">{{ errors.first('company_name') }}</div>

                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-4">
                            <label for="company_phone">Phone*</label>
                            <b-form-input
                                v-validate="'required'"
                                name="company_phone"
                                id="company_phone"
                                type="text"
                                v-model="form.company_phone"
                                v-bind:class="{'is-invalid' :  errors.has('company_phone')}"
                                />
                            <div v-show="errors.has('company_phone')" class="invalid-feedback">{{ errors.first('company_phone') }}</div>
                        </div>

                        <div class="col-sm-8">
                            <label for="company_email">E-mail*</label>
                            <b-form-input
                                v-validate="'required|email'"
                                name="company_email"
                                id="company_email"
                                type="text"
                                v-model="form.company_email"
                                v-bind:class="{'is-invalid' :  errors.has('company_email')}"
                                />
                            <div v-show="errors.has('company_email')" class="invalid-feedback">{{ errors.first('company_email') }}</div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="participants block">
                <div class="container">
                    <h2>Participants</h2>
                    <transition-group name="slide-fade">
                        <div class="pt-3 mb-3" v-for="(row, index) in participants" :key="index">
                            <h3 style="float: left;">Participant #{{ index+1 }}</h3>
                                <button style="float: right;" v-if="index > 0" @click="removeElement(index);" type="button" class="close" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            <div class="row" style="clear: both;">
                                <div class="col-sm-12">
                                    <label :for="'name-' + index">Name*</label>
                                    <b-form-input
                                        v-validate="'required'"
                                        :name="'name['+ index +']'"
                                        type="text"
                                        :id="'name-' + index"
                                        v-model="participants[index].name"
                                        v-bind:class="{'is-invalid' :  errors.has('name['+ index +']')}"
                                        />
                                    <div v-show="errors.has('name['+ index +']')" class="invalid-feedback">{{ errors.first('name['+ index +']') }}</div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-4">
                                    <label :for="'phone-' + index">Phone</label>
                                    <b-form-input
                                        v-validate=""
                                        :name="'phone['+ index +']'"
                                        type="text"
                                        :id="'phone['+ index +']'"
                                        v-model="participants[index].phone"
                                        v-bind:class="{'is-invalid' :  errors.has('phone['+ index +']')}"
                                        />
                                    <div v-show="errors.has('phone['+ index +']')" class="invalid-feedback">{{ errors.first('phone['+ index +']') }}</div>
                                </div>

                                <div class="col-sm-8">
                                    <label :for="'email-' + index">E-mail</label>
                                    <b-form-input
                                        v-validate="'email'"
                                        name="email[]"
                                        type="text"
                                        :id="'email['+ index +']'"
                                        v-model="participants[index].email"
                                        v-bind:class="{'is-invalid' :  errors.has('email['+ index +']')}"
                                        />
                                    <div v-show="errors.has('email['+ index +']')" class="invalid-feedback">{{ errors.first('email['+ index +']') }}</div>
                                </div>
                            </div>
                        </div>
                    </transition-group>
                    <button type="submit" class="btn btn-primary mt-4" @click.prevent="addParticipant">Add a participant</button>
                </div>
            </div>

            <div class="block">
                <div class="container">
                    <b-button type="submit" class="btn btn-block" variant="primary">Submit application</b-button>
                </div>
            </div>
        </b-form>
        <b-modal ref="success" hide-footer title="Success">
        <div class="d-block">
            <h3>Form submitted successfully</h3>
            <code><pre>{{ success }}</pre></code>
        </div>
        <b-button class="mt-3" variant="outline-danger" block @click="hideModal">Close</b-button>
        </b-modal>
    </div>
</template>
<script>
  export default {
    
    data() {
      return {
        form: {},
        submitted: false,
        success: null,
        error: false,
        dates: null,
        submitErrors: null,
        courses: null,
        options: [
          { value: null, text: 'Please select some item' },
          { value: 'a', text: 'This is First option' },
          { value: 'b', text: 'Default Selected Option' },
          { value: 'c', text: 'This is another option' },
          { value: 'd', text: 'This one is disabled', disabled: true }
        ],
        participants: [
            {
                name: '',
                phone: '',
                email: '',
            }
        ]
      }
    },
    mounted() {
        axios
        .get('courses.json')
        .then(response => {
            this.courses = response.data;
        }).catch(error => {
            this.error = error.response.data.message || error.message;
        });
    },
    methods: {
        showModal() {
        this.$refs.success.show();
        },
        hideModal() {
            this.$refs.success.hide();
        },
        getCourseDates: function(id) {
            this.dates = this.courses.find(x => x.id === id).dates
        },
        addParticipant: function() {
            this.participants.push({
                name: '',
                phone: '',
                email: ''
            });
        },
        removeElement: function(index) {
            this.participants.splice(index, 1);
        },
        resetForm: function() {
            this.form = {};
            this.participants = [];
            this.addParticipant();
            this.$validator.reset()
        },
        onSubmit() {

            this.$validator.validateAll().then((result) => {
                this.submitted = true;
                if (result) {
                    // eslint-disable-next-line
                    axios.post('/submit', {form: this.form, participants: this.participants}).then(response => {
                            this.success = [{form: this.form},{participants: this.participants}];
                            this.showModal();
                            this.resetForm();
                        }).catch(error => {
                        if (error.response.status === 422) {
                            this.submitErrors = error.response.data.errors || {};
                        }
                    });
                        return;
                }
                window.scrollTo(document.querySelector('.is-invalid').offsetTop, 0);

            });
        }
    }

  }
</script>