<template>
  <panel name="Create Package" icon="fas fa-box" class="panel-success">
    <form class="form-horizontal">
      <fieldset>
        <!-- Text input-->
        <div class="form-group">
          <label class="col-md-4 control-label" for="package.name">Name</label>
          <div class="col-md-4">
            <input
              type="text"
              placeholder="coredump/my-package"
              class="form-control input-md"
              required
              v-model="info.name"
            >
            <span class="help-block">Name of the composer package</span>
          </div>
        </div>

        <!-- Textarea -->
        <div class="form-group">
          <label class="col-md-4 control-label" for="package.description">Description</label>
          <div class="col-md-4">
            <textarea class="form-control" v-model="info.description"></textarea>
          </div>
        </div>

        <!-- Text input-->
        <div class="form-group">
          <label class="col-md-4 control-label" for="package.icon">fa-icon</label>
          <div class="col-md-4">
            <div class="input-group">
              <input
                v-model="info.icon"
                type="text"
                placeholder="fa-icon"
                class="form-control input-md"
              >
              <div class="input-group-append">
                <div class="input-group-text">
                  <i :class="info.icon"></i>
                </div>
              </div>
            </div>
            <span class="help-block">fa-icon that represents the package</span>
          </div>
        </div>

        <!-- Text input-->
        <div class="form-group">
          <label class="col-md-4 control-label" for="package.icon">path</label>
          <div class="col-md-4">
            <input
              v-model="info.path"
              type="text"
              placeholder="/var/www/packages/my-package"
              class="form-control input-md"
            >
            <span class="help-block">If the path exists it will be emptied</span>
          </div>
        </div>
        <!-- Button (Double) -->
        <div class="form-group">
          <label class="col-md-4 control-label" for></label>
          <div class="col-md-8">
            <button
              type="submit"
              class="btn btn-success"
              @click.stop.prevent="completeTask({action:'create', info})"
            >Create</button>
            <button
              type="button"
              class="btn btn-danger"
              @click="completeTask({action:'cancel'})"
            >Cancel</button>
          </div>
        </div>
      </fieldset>
    </form>
  </panel>
</template>

<script>
export default {
  path: "/pacman/new",
  mixins: [window.workflowMixin],
  data() {
    return {
      info: {
        name: "coredump/jdd-package",
        description: "JDD package",
        icon: "fas fa-rocket",
        path: "/Users/davidcallizaya/Netbeans/jdd-package"
      }
    };
  }
};
</script>
