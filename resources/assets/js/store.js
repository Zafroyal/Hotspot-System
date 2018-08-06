import Vue from 'vue';
import Vuex from 'vuex'
import createPersistedState from 'vuex-persistedstate'

Vue.use(Vuex);

export const store = new Vuex.Store({


  state: {
    cartdata: [],
    products: [],
    total: 0
  },

  getters: {


  },
  mutations: {

    addProduct: function(state, product){
          this.state.cartdata.push({
            id: product.productID,
            name: product.productName,
            price: product.productPrice,
            quant: product.productQuantity,
          })
    },

    deleteProduct: function(state, product){
      state.cartdata.splice(state.cartdata.indexOf(product), 1);
    },


    loadProducts: function(context){
      let uri = 'http://localhost:8000/proapi/';
      Axios.get(uri).then((response) => {
        this.state.products = response.data;
      });
    },




  },

  actions: {
    load(context){
      context.commit('loadProducts');
    }
  }

},



);
