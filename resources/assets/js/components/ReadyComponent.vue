<template>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card card-default">

                    <div class="card-header">Ready Dashboard

                      <div class="btn-group-sm" role="group" aria-label="Basic example" style="float: right;">
                        <router-link class="btn btn-dark btn-sm" :to="{ name: 'employee' }">Incoming</router-link>
                        <router-link class="btn btn-dark btn-sm" :to="{ name: 'processing' }">Processing</router-link>
                        <router-link class="btn btn-dark btn-sm" :to="{ name: 'ready' }">Ready</router-link>
                      </div>

                    </div>

                    <div class="card-body" style="min-height: 300px;">

                        <div class="card card-default" v-for="(order, index) in orders"  v-if="order.ostatus == 3">
                            <div class="card-body">
                              <h2 style="padding:0px;">Order: {{index + 1}} </h2>

                              <p style="padding:0px;"><strong> User: </strong> {{order.email}} </p>
                              <table class="table-repsonsive table-bordered ">
                                 <thead>
                                      <th scope="col">Product</th>
                                      <th scope="col">Price</th>
                                      <th scope="col">Quantity</th>
                                  </thead>
                                  <tbody v-for="product in products" >

                                      <td v-if="order.id == product.user_id">{{product.name}}</td>
                                      <td v-if="order.id == product.user_id">R{{product.price}}</td>
                                      <td v-if="order.id == product.user_id">{{product.quantity}}</td>

                                  </tbody>


                                </table>



                              <button type="submit" style="float:right;" class="btn btn-danger"  v-on:click="snackbar(), notCollected(order)">
                                  Not Collected
                              </button>

                              <button type="submit" style="float:right;" v-on:click="" class="btn btn-primary" v-on:click="snackbar(), update(order)">
                                  Collected
                              </button>
                            </div>

                        </div>
                            <div id="snackbar">{{messager}}</div>

                                                          <div class="alert alert-danger" style="position:relative; bottom: 0; width: 95%;">
                                                            <strong>Orders that are ready</strong> Be sure to click collect or uncollected once customer has completed transaction</a>.
                                                          </div>
                    </div>


                    </div>
                </div>
            </div>
        </div>

    </div>
</template>

<script>
    export default {
      computed: {
          orders(){
            console.log(this.$store.state.emporders);
            return this.$store.state.emporders;
          },
          products(){
            console.log(this.$store.state.prodorders);
            return this.$store.state.prodorders;
          },
          username(){
            return this.user;
          },

          number(){
             this.orderNum = Math.floor(Math.random() * (25 - 1 + 1)) + 1;
             return this.orderNum;
          },
          messager(){
            return this.message;
          }
      },



      data() {
        return {
          Orders: [],
          Products: [],
          user: "",
          orderNum: 0,
          message: "",
          polling: null
        }
      },
      methods: {

        pollData () {
      		this.polling = setInterval(() => {
            this.$store.dispatch('loadPo');
            this.$store.dispatch('loadEo');
      		}, 10000)
      	},

        update(o){
          this.message = "Order completed";
          axios.post('/update', {
            order_id: o.order_id, ostatus: 7
          }).then(response => {
            console.log(response);
          }).catch(error => {
            console.log(error.response);
          });
        },

        notCollected(o){
          this.message = "Order uncollected";
          axios.post('/update', {
            order_id: o.order_id, ostatus: 5
          }).then(response => {
            console.log(response);
          }).catch(error => {
            console.log(error.response);
          });
        },

        deleteO(order){
          this.$store.state.emporders.splice(this.$store.state.emporders.indexOf(order), 1);
          this.message = "Order declined";
        },

        completed(order){
          this.$store.state.emporders.splice(this.$store.state.emporders.indexOf(order), 1);
          this.message = "Order completed";
          axios.post('/collectapi', {user: order.user.name, email: order.user.email, number: this.orderNum}).then((response)=> console.log(response))
          .catch((error) => console.log(error.response));

        },

        reply(order){
          axios.post('/reply', {
              usernames: order.user
          }).then(response => {

        //  console.log(response);
          }).catch(error => {
            console.log(error.response);

          });
        },

        snackbar: function() {
          // Get the snackbar DIV
          var x = document.getElementById("snackbar");



          // Add the "show" class to DIV
          x.className = "show";

          // After 3 seconds, remove the show class from DIV
          setTimeout(function(){ x.className = x.className.replace("show", ""); }, 1500);




        },

      },

      beforeDestroy () {
        clearInterval(this.polling)
      },

      mounted(){
        this.$store.dispatch('loadUo');
        this.$store.dispatch('loadEo');
        this.$store.dispatch('loadPo');
      },

      created (){
        this.pollData()
      }
    }
</script>


<style>
  /* The snackbar - position it at the bottom and in the middle of the screen */
  #snackbar {
      visibility: hidden; /* Hidden by default. Visible on click */
      min-width: 250px; /* Set a default minimum width */
      margin-left: -125px; /* Divide value of min-width by 2 */
      background-color: #333; /* Black background color */
      color: #fff; /* White text color */
      text-align: center; /* Centered text */
      border-radius: 2px; /* Rounded borders */
      padding: 16px; /* Padding */
      position: fixed; /* Sit on top of the screen */
      z-index: 1; /* Add a z-index if needed */
      left: 50%; /* Center the snackbar */
      bottom: 30px; /* 30px from the bottom */
  }

  /* Show the snackbar when clicking on a button (class added with JavaScript) */
  #snackbar.show {
      visibility: visible; /* Show the snackbar */

  /* Add animation: Take 0.5 seconds to fade in and out the snackbar.
  However, delay the fade out process for 2.5 seconds */
      -webkit-animation: fadein 0.5s, fadeout 0.5s 2.5s;
      animation: fadein 0.5s, fadeout 0.5s 2.5s;
  }

  /* Animations to fade the snackbar in and out */
  @-webkit-keyframes fadein {
      from {bottom: 0; opacity: 0;}
      to {bottom: 30px; opacity: 1;}
  }

  @keyframes fadein {
      from {bottom: 0; opacity: 0;}
      to {bottom: 30px; opacity: 1;}
  }

  @-webkit-keyframes fadeout {
      from {bottom: 30px; opacity: 1;}
      to {bottom: 0; opacity: 0;}
  }

  @keyframes fadeout {
      from {bottom: 30px; opacity: 1;}
      to {bottom: 0; opacity: 0;}
  }
</style>
