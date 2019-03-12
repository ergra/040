<template>
    <div>
        <b-form @submit="onSubmit">
            <div class="course block">
                <div class="container">
                    <h2>Course</h2>
                    <div class="row">
                        <div class="col">
                            <label for="name">Name*</label>
                            <b-form-select id="name" name="name" v-model="selected" :options="options" />
                        </div>

                        <div class="col">
                            <label for="date">Date</label>
                            <b-form-select id="date" name="date" v-model="selected" :options="options" />
                        </div>
                    </div>
                </div>
            </div>

            <div class="company block">
                <div class="container">
                    <h2>Company</h2>
                    <div class="row">
                        <div class="col">
                            <b-form-group id="exampleInputGroup1" label="Name*" label-for="cname">
                                <b-form-input
                                id="cname"
                                type="text"
                                v-model="form.name"
                                aria-describedby="input1LiveFeedback"
                                placeholder="Enter name"
                                />

                                <b-form-invalid-feedback id="input1LiveFeedback">
                                This is a required field and must be at least 3 characters
                                </b-form-invalid-feedback>
                            </b-form-group>

                            <label for="cname">Name*</label>
                            <b-form-input v-model="text1" name="cname" id="cname" type="text" placeholder="" />
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-4">
                            <label for="cphone">Phone*</label>
                            <b-form-input v-model="text1" name="cphone" id="cphone" type="text" placeholder="" />
                        </div>

                        <div class="col-8">
                            <label for="cemail">Email*</label>
                            <b-form-input v-model="text1" name="cemail" id="cemail" type="text" placeholder="" />
                        </div>
                    </div>
                </div>
            </div>

            <div class="participants block">
                <div class="container">
                    <h2>Participants</h2>

                    <div class="pt-3" v-for="(row, index) in rows">
                        <h3>Participant #1</h3>
                        <div class="row">
                            <div class="col">
                                <label :for="'cname-' + index">Name*</label>
                                <b-form-input v-model="row.cname" name="cname" :id="'cname-' + index" type="text" placeholder="" />
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-4">
                                <label :for="'cphone-' + index">Phone</label>
                                <b-form-input v-model="row.cphone" name="cphone" :id="'cphone-' + index" type="text" placeholder="" />
                            </div>

                            <div class="col-8">
                                <label :for="'cemail-' + index">Email</label>
                                <b-form-input v-model="row.cemail" name="cemail" :id="'cemail-' + index" type="text" placeholder="" />
                            </div>
                            <a v-if="index > 0" @click="removeElement(index);" style="cursor: pointer">Remove</a>
                        </div>
                        {{ row }}
                    </div>
                    <button type="submit" class="btn btn-primary mt-4" @click.prevent="addParticipant">Add a participant</button>
                </div>
            </div>

            <div class="block">
                <div class="container">
                    <button type="submit" class="btn btn-primary btn-block">Submit application</button>
                </div>
            </div>
        </b-form>
    </div>
</template>
<script>
  export default {
    data() {
      return {
        selected: null,
        options: [
          { value: null, text: 'Please select some item' },
          { value: 'a', text: 'This is First option' },
          { value: 'b', text: 'Default Selected Option' },
          { value: 'c', text: 'This is another option' },
          { value: 'd', text: 'This one is disabled', disabled: true }
        ],
        participants: [],
        rows: [
            {
                cname: '',
                cphone: '',
                cemail: '',
            }
        ]
      }
    },
    methods: {
        addParticipant: function() {
            var elem = document.createElement('tr');
            this.rows.push({
                cname: '',
                cphone: '',
                cemail: ''
            });
        },
        removeElement: function(index) {
            this.rows.splice(index, 1);
        },
        setFilename: function(event, row) {
            var file = event.target.files[0];
            row.file = file
        }
    }

  }
</script>