
export default {
    install: (app) => {
      // inject a globally available $can() method
      app.config.globalProperties.$can = (model, permission) => {
        const checkUserCan = (
          app.config.globalProperties.$inertia.page.props.auth.permissions.includes(`${model}.${permission}`) ||
          app.config.globalProperties.$inertia.page.props.auth.permissions.includes(`${model}.*`) ||
          app.config.globalProperties.$inertia.page.props.auth.roles.includes('superadmin')
        )
        return checkUserCan;
      }
    }
  }