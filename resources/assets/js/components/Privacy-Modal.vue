<template>
  <div class="modal fade" id="privacy-policy-modal" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">&times;</button>
          <h5 class="modal-title">Privacy policy</h5>
        </div>
        <div id="js-privacy-policy-modal-body" class="modal-body" v-html="content"></div>
        <div class="modal-footer">
          <button
            @click="setCookie"
            type="button"
            class="btn btn-primary btn-block"
            data-dismiss="modal"
          >Ok</button>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import utilities from "./../utilities/cookies";

export default {
  data() {
    return {
      endpoint: "/privacy-policy/content",
      modal: "#privacy-policy-modal",
      cookieName: "__privacy",
      content: "<div class='text-center'><i class='fa fa-circle-o-notch fa-2x fa-spin'></i></div>"
    };
  },

  mounted() {
    this.load();
  },

  methods: {
    load() {
      let isPrivacyPage = this.isPrivacyPage();
      let isCookie = this.isCookie();

      if (!isPrivacyPage) {
        if (!isCookie || isCookie == null) {
          $(`${this.modal}`).modal("show");

          axios
            .get(this.endpoint)
            .then(({ data }) => (this.content = data))
            .catch(error => console.log(error));
        }
      }
    },

    setCookie() {
      let cookie = {
        name: this.cookieName,
        value: true,
        age: 30,
        domain: `${process.env.MIX_COOKIE_DOMAIN}`,
        path: "/"
      };

      let days = cookie.age;
      let length = days * 24 * 60 * 60;

      document.cookie = `${cookie.name}=${cookie.value}; max-age=${length}; domain=${cookie.domain}; path=${cookie.path}`;
    },

    isPrivacyPage() {
      return window.location.href.includes("privacy-policy");
    },

    isCookie() {
      let cookieName = this.cookieName;
      return utilities.getCookie(cookieName);
    }
  }
};
</script>