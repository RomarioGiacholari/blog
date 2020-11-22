<template>
<div>
    <div class="loading" v-if="sending"><i class='fa fa-circle-o-notch fa-2x fa-spin'></i></div>
    
    <div v-if="response && response.message" class="alert alert-dismissible" :class="response.isSuccess ? 'alert-success' : 'alert-danger'" role="alert">
        <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
        <span v-text="response.message"></span>
    </div>
    
    <ul v-if="errors && Object.keys(errors).length > 0">
        <li class="errors" v-for="key of Object.keys(errors)" :key="key" v-text="errors[key][0]"></li>
    </ul>

    <form :action="endpoint" :method="method" @submit.prevent="onSubmit">
        <div class="form-group">
            <input v-model="form.name" type="text" class="form-control" name="name" id="name" value="" placeholder="What is your name?" required>
        </div>
        <div class="form-group">
            <input v-model="form.email" type="email" class="form-control" name="email" id="email" value="" placeholder="Which email should we respond to?" required>
        </div>
        <div class="form-group">
            <textarea v-model="form.message" class="form-control" name="message" id="message" rows="8" placeholder="What is your question?" required></textarea>
        </div>
        <div class="form-group">
            <input v-model="form.answer" type="number" class="form-control" name="answer" id="answer" value="" min="0" placeholder="3 + 1 = ?" required>
        </div>
      <div class="form-group">
          <input v-model="form.privacy" type="checkbox" name="privacy" id="privacy" class="pointer" value="false" required>
          <label for="privacy" class="pointer">I have read and accept the <a :href="privacyEndpoint" target="_blank"><u>privacy policy.</u></a></label>
      </div>
        <div class='form-group'>
            <button type="submit" class="btn btn-primary btn-block">send</button>
        </div>
    </form>
</div>
</template>

<script>
export default {
  
  props: ['endpoint', 'method'],

  data() {
    return {
        form: {
            name: '',
            email: '',
            message: '',
            answer: '',
            privacy: false
        },
        errors: {},
        response: {},
        sending: false,
        privacyEndpoint: '/privacy-policy'
    };
  },

  methods: {
    onSubmit() {
        this.sending = true;
        this.errors = {};
        this.response = {};

        axios.post(this.endpoint, this.form)
            .then((response) => {
                this.response = response.data;
                this.form = {};
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
    color: red;
    font-style: italic;
}
.loading {
    padding: 10px;
    margin-top: 5px;
    margin-bottom: 10px;
}
.pointer {
  cursor: pointer;
}
</style>