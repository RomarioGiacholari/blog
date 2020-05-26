<template>
<div>
    <div v-if="response && response.message" class="alert alert-dismissible" :class="response.isSuccess ? 'alert-success' : 'alert-danger'" role="alert">
        <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
        <span v-text="response.message"></span>
    </div>
    
    <ul v-if="errors">
        <li class="errors" v-for="key of Object.keys(errors)" :key="key" v-text="errors[key][0]"></li>
    </ul>

    <form v-if="!sending":action="endpoint" method="POST" @submit.prevent="onSubmit">
        <div class="form-group">
            <input v-model="form.name" type="text" class="form-control" name="name" id="name" value="" placeholder="Name" required>
        </div>
        <div class="form-group">
            <input v-model="form.email" type="email" class="form-control" name="email" id="email" value="" placeholder="Your email" required>
        </div>
        <div class="form-group">
            <input v-model="form.subject" type="text" class="form-control" name="subject" id="subject" value="" placeholder="Subject" required>
        </div>
        <div class="form-group">
            <textarea v-model="form.message" class="form-control" name="message" id="message" rows="8" placeholder="Message" required></textarea>
        </div>
        <div class="form-group">
            <input v-model="form.answer" type="number" class="form-control" name="answer" id="answer" value="" min="0" placeholder="3 + 1 =" required>
        </div>
        <div class='form-group'>
            <button type="submit" class="btn btn-primary btn-block">send</button>
        </div>
    </form>
    <div v-else class="text-center"><i class='fa fa-circle-o-notch fa-2x fa-spin'></i></div>
</div>
</template>

<script>
export default {
  
  props: ['endpoint'],

  data() {
    return {
        form: {
            name: '',
            email: '',
            message: '',
            subject: '',
            answer: ''
        },
        errors: {},
        response: {},
        sending: false,
    };
  },

  methods: {
    onSubmit() {
        this.sending = true;

        axios.post(this.endpoint, this.form)
            .then((response) => {
                this.response = response.data;
                this.form = {};
                this.errors = {};
                this.sending = false;
            })
            .catch((error) => { 
                this.errors = error.response.data.errors;
                this.sending = false;
            });
    },
  }
}
</script>
<style>
.errors {
    color:red;
    font-style: italic;
}
</style>