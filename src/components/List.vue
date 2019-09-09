<template>
  <panel name="Package Manager" icon="fas fa-box" class="panel-success">
    <div class="m-t">
      <button
        type="submit"
        class="btn btn-primary block full-width m-b"
        @click="completeTask({action:'create'})"
      >Create a new package</button>
      <button
        type="submit"
        class="btn btn-primary block full-width m-b"
        @click="completeTask({action:'rebuild'})"
      >Rebuild package</button>
      <br />
      <br />
      <grid v-model="records">
        <template slot="header">
          <row :widths="[120,200,100,150]" class="grid-header text-uppercase font-weight-bold">
            <p slot="c1">name</p>
            <p slot="c2">description</p>
            <p slot="c3">status</p>
            <p slot="c4">actions</p>
          </row>
        </template>
        <template v-slot="{row}">
          <row :widths="[120,200,100,150]" class="border-bottom">
            <p slot="c1">
              <span style="width:2em;display:inline-block;">
                <i :class="row.attributes.icon"></i>
              </span>
              <b>{{row.attributes.name}}</b>
            </p>
            <p slot="c2">{{row.attributes.description}}</p>
            <p slot="c3">{{row.attributes.status}}</p>
            <p slot="c4">
              <a
                v-if="row.attributes.status==='available'"
                class="btn btn-outline-secondary btn-sm"
                style="width:3em"
                @click="completeTask({action:'install',package:row.attributes})"
              >
                <i class="fas fa-inbox"></i>
              </a>
              <a
                v-if="row.attributes.status==='installed'"
                class="btn btn-outline-secondary btn-sm"
                style="width:3em"
                @click="completeTask({action:'remove',package:row.attributes})"
              >
                <i class="fas fa-trash-alt"></i>
              </a>
            </p>
          </row>
        </template>
      </grid>
    </div>
  </panel>
</template>

<script>
export default {
  path: "/pacman/list",
  mixins: [window.workflowMixin],
  data() {
    return {
      records: this.axiosList("../pacman/package")
    };
  },
  methods: {
    axiosList(url, params = {}) {
      const list = [];
      const config = { method: "get", url, params };
      url.substr(0, 1) === "/" ? (config.baseURL = "/") : null;
      window.axios(config).then(response => {
        list.splice(0);
        list.push(...response.data.data);
      });
      return list;
    }
  }
};
</script>
