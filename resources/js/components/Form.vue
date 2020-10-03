<template>
  <form class="form-template" @submit.prevent="submitForm">
    <vue-tel-input
      v-model="phone"
      v-bind="settings"
      @validate="onValidate"
      @onInput="onInput"
    ></vue-tel-input>

    <button
      class="button-pulse"
      :class="{ disabled: !inputValid }"
      v-bind:disabled="!inputValid"
    >
      <span>Get Consultation and Price</span>
    </button>
  </form>
</template>

<script>
import { VueTelInput } from "vue-tel-input";
import axios from "axios";
import { mapActions, mapGetters } from "vuex";

export default {
  data: () => ({
    phone: "",
    url: "lmr.vskidke.ru",
    dialCode: "",
    isValid: false,
    onFocus: false,
    settings: {
      //enabledCountryCode: true,
      mode: "international",
      preferredCountries: ["fr", "es", "gb"],
      //validCharactersOnly: true,
      // inputOptions: {
      //   showDialCode: false,
      // },
    },
  }),
  components: { VueTelInput },
  mounted() {
    //console.log("Component mounted.");
  },
  computed: {
    ...mapGetters(["isModal", "isSuccess"]),
    inputValid: function () {
      return this.phone.length > 0 && this.isValid;
    },
  },
  methods: {
    ...mapActions(["setModal", "unsetModal", "setSuccess", "unsetSuccess"]),
    submitForm() {
      if (this.isValid) {
        axios
          .post("api/lead", {
            phone: this.phone,
            url: this.url,
          })
          .then((response) => {
            console.log(response);

            this.phone = "";
            this.setSuccess();
            this.setModal();
          });
      }
    },
    onValidate({ number, isValid, country }) {
      //console.log(number);
    },
    onInput(input) {
      this.isValid = input.isValid;
    },
  },
};
</script>
