<template>
    <form>
        <div class="course">
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
        <div class="company">
            <div class="container">
                <h2>Company</h2>
                <div class="row">
                    <div class="col">
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

        <div class="participants">
            <div class="container">
                <h2>Participants</h2>
                <h3>Participant #1</h3>
                <div class="row">
                    <div class="col">
                        <label for="cname">Name*</label>
                        <b-form-input v-model="text1" name="cname" id="cname" type="text" placeholder="" />
                    </div>
                </div>
                <div class="row">
                    <div class="col-4">
                        <label for="cphone">Phone</label>
                        <b-form-input v-model="text1" name="cphone" id="cphone" type="text" placeholder="" />
                    </div>

                    <div class="col-8">
                        <label for="cemail">Email</label>
                        <b-form-input v-model="text1" name="cemail" id="cemail" type="text" placeholder="" />
                    </div>
                </div>
            </div>
        </div>
        <div class="container">
            <button type="submit" class="btn btn-primary btn-block">Send message</button>
        </div>
    </form>
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
        ]
      }
    }
  }
</script>