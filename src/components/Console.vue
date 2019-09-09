<template>
  <panel name="Package Manager - Console" icon="fas fa-box" class="panel-success">
    <pre ref="pre">{{log}}</pre>
  </panel>
</template>

<script>
export default {
  path: "/pacman/console",
  mixins: [window.workflowMixin],
  data() {
    return {
      instance: this.$route.query.instance,
      token: this.$route.query.token,
      log: ""
    };
  },
  methods: {},
  mounted() {
    this.listenConsole(message => {
        window.axios({ url: message.url, baseURL: "" }).then(response => {
            this.log = response.data;
            var element = this.$refs.pre.parentElement.parentElement;
            element.scrollTop = element.scrollHeight - element.clientHeight;
        });
    });
  },
};
</script>
