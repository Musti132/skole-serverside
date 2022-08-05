import { createApp } from 'vue';
import App from './App.vue';
import vuetify from './plugins/vuetify';
import { loadFonts } from './plugins/webfontloader';
import ExampleComponent from './components/ExampleComponent.vue';

loadFonts()

app.component('example-component', ExampleComponent);

createApp(App)
  .use(vuetify)
  .mount('#app')
