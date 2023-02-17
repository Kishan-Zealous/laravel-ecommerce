import IndexField from './components/IndexField'
import DetailField from './components/DetailField'
import FormField from './components/FormField'

Nova.booting((app, store) => {
  app.component('index-profilepic', IndexField)
  app.component('detail-profilepic', DetailField)
  app.component('form-profilepic', FormField)
})
