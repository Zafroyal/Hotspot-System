import Vue from 'vue';
import Vuex from 'vuex'
import createPersistedState from 'vuex-persistedstate'

Vue.use(Vuex);

export const store = new Vuex.Store({

  state: {
    cartdata: [],
    products: [],
    orders: [],
    total: 0,
    currentuserid: 0
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
      console.log(index);
    },


    loadProducts: function(context){
      let uri = 'http://204.48.30.114/proapi/';
      Axios.get(uri).then((response) => {
        this.state.products = response.data;
      }).catch(error => {
        console.log(error.response);

      });
    },

    loadCurrentid: function(context){
      let uri = 'http://204.48.30.114/currentuserapi/';
      Axios.get(uri).then((response) => {
        this.state.currentuserid = response.data;
        console.log(this.state.currentuserid);
        //add loader for all axios and connection points
      }).catch(error => {
        console.log(error.response);

      });
    },

    totCalc: function(state){

    },

    copyArray: function(state){
      state.orders = state.cartdata.slice();
    }




  },

  actions: {
    load(context){
      context.commit('loadProducts');
    },
    loadCid(context){
      context.commit('loadCurrentid');
    }
  }

},



);
