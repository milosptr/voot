import { createStore } from 'vuex'
import product from './store/modules/product'

const store = createStore({
  namespaced: true,
	modules: {
    product,
	}
});

export default store
