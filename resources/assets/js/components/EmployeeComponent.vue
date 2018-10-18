<template>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card card-default">
                    <div class="card-header">Employee Dashboard</div>

                    <div class="card-body" style="min-height: 300px;">

                        <div class="card card-default" v-for="(order, index) in orders">
                            <div class="card-body">
                              <h2 style="padding:0px;">Order: {{index + 1}} </h2>

                              <p style="padding:0px;"><strong> User: </strong> {{order.user.name}} </p>
                              <table class="table-repsonsive table-bordered ">
                                 <thead>
                                      <th scope="col">Product</th>
                                      <th scope="col">Price</th>
                                      <th scope="col">Quantity</th>
                                  </thead>
                                  <tbody v-for="product in order.order">


                                      <td>{{product.name}}</td>
                                      <td>R{{product.price}}</td>
                                      <td>{{product.quant}}</td>







                                  </tbody>


                                </table>



                              <button type="submit" style="float:right;" class="btn btn-danger"  v-on:click="deleteO(order),  reply(order), snackbar()">
                                  Decline
                              </button>

                              <button type="submit" style="float:right;" v-on:click="" class="btn btn-primary" v-on:click="completed(order), reply(order), snackbar()">
                                  Complete
                              </button>
                            </div>

                        </div>
                            <div id="snackbar">{{messager}}</div>

                                                          <div class="alert alert-danger" style="position:relative; bottom: 0; width: 95%;">
                                                            <strong>Orders Incoming</strong> Be sure to accept or decline user orders as they come in</a>.
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
            return this.Orders
          },
          products(){
            return this.Products;
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
          message: ""
        }
      },
      methods: {
       /*  complete(){
          axios.post('/send', {
            complete: true
          }).then(response => {
            console.log(response);
          }).catch(error => {
            console.log(error);
          });
        }, */
        deleteO(order){
          this.Orders.splice(this.Orders.indexOf(order), 1);
          this.message = "Order declined";
        },

        completed(order){
          this.Orders.splice(this.Orders.indexOf(order), 1);
          this.message = "Order completed";
          axios.post('/collectapi', {user: order.user.name, email: order.user.email, number: this.orderNum}).then((response)=> console.log(response))
          .catch((error) => console.log(error.response));

        },
        reply(order){
          axios.post('/reply', {
              usernames: order.user
          }).then(response => {

          console.log(response);
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



      mounted(){

        Echo.private('order').listen('OrderEvent', (e) => {
            this.Orders.push(e); //call the particulars of this object in the template v-for

            console.log(e);


            this.Products = e.order;

            console.log(e.user.email);

            this.orderNum = Math.floor(Math.random() * (25 - 1 + 1)) + 1;
        });
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
