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
    currentuserid: 0,
    userorder: [],
    emporders: [],
    prodorders: [],
    oid: 0
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
      //console.log(index);
    },


    loadProducts: function(context){
      let uri = 'http://localhost:8000/proapi/';
      Axios.get(uri).then((response) => {
        this.state.products = response.data;
      }).catch(error => {
        console.log(error.response);
      });
    },

    loadCurrentid: function(context){
      let uri = 'http://localhost:8000/currentuserapi/';
      Axios.get(uri).then((response) => {
        this.state.currentuserid = response.data;
        //console.log(this.state.currentuserid);
        //add loader for all axios and connection points
      }).catch(error => {
        console.log(error.response);
      });
    },

    loadoid: function(context){
      let uri = 'http://localhost:8000/oid/';
      Axios.get(uri).then((response) => {
        this.state.oid = response.data[0].order_id;
        //console.log(this.state.oid+ "Hey its ");
        //add loader for all axios and connection points
      }).catch(error => {
        console.log(error.response);
      });
    },

    loadUserorder: function(context){
      let uri = 'http://localhost:8000/userorder/';
      Axios.get(uri).then((response) => {
        this.state.userorder = response.data;
        //console.log(this.state.userorder);
        //add loader for all axios and connection points
      }).catch(error => {
        console.log(error.response);
      });
    },

    loadEmporder: function(context){
        let uri = 'http://localhost:8000/emporders/';
        Axios.get(uri).then((response) => {
          this.state.emporders = response.data;
          //console.log(this.state.emporder);
          //add loader for all axios and connection points
        }).catch(error => {
          console.log(error.response);
        });
    },

    loadProdorder: function(context){
        let uri = 'http://localhost:8000/prodorders/';
        Axios.get(uri).then((response) => {
          this.state.prodorders = response.data;
          //console.log(this.state.prodorders);
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
    },
    loadUo(context){
      context.commit('loadUserorder');
    },
    loadEo(context){
      context.commit('loadEmporder');
    },
    loadPo(context){
      context.commit('loadProdorder');
    },
    loadOid(context){
      context.commit('loadoid');
    },
  }

},



);
